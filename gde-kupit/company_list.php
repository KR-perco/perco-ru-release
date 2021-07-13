<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/idna_convert.class.php');
// CMain::IncludeFile("lang/".LANGUAGE_ID."/where-to-buy.php");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/PERCo-template/lang/".LANGUAGE_ID."/where-to-buy.php");
function output($field, $arValue, $link=false)
{
	$idn = new idna_convert(array('idn_version'=>2008));
	foreach($arValue as $val)
	{
		switch($field)
		{
			case "PHONE":
				$microdata = 'itemprop="telephone"';
				break;
			case "FAX":
				$microdata = 'itemprop="faxNumber"';
				break;
			case "EMAIL":
				$microdata = 'itemprop="email"';
				break;
			case "SITE":
				$microdata = 'itemprop="url"';
				break;
		}
		echo '<div class="'.strtolower($field).'_item" '.$microdata.'>';
		if ($field == 'EMAIL') {echo '<a href="mailto:'.$val.'">';}
		if (!$link)
			echo $val;
		else
		{
			$url = 'http://'.$idn->encode($val);
			$key = "zdT,\BfO>N";
			$hash = hash_hmac('md5', $url, $key, false);
			echo '<a rel="nofollow" href="//'.SITE_SERVER_NAME.'/redirect.php?site='.$url.'&hash='.$hash.'" target="_blank">'.$val.'</a>';
		}
		if ($field == 'EMAIL') {echo '</a>';}
		echo '</div>';
	}
}
if($_REQUEST["kit"] || $_REQUEST["city"] || $_REQUEST["region"])
{
	$real_path = parse_url($_SERVER["REQUEST_URI"]);
	$APPLICATION->AddHeadString('<link rel="canonical" href="https://'.$_SERVER["HTTP_HOST"].$real_path["path"].'" />');
}
?>
<?
if(CModule::IncludeModule("iblock"))
{
	global $statusSC;
	global $scl;
	if ($_REQUEST["sc"] == "Y")
	{
		$scl = true;
		$statusSC = array("Авторизованный дилер и сервисный центр", "Сервисный центр");
	}
	if ($_REQUEST["kit"] == "Y")
		$kit = false;
	// Подготовка фильтра ->
	$resCountry = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_CODE" => "countries", "ACTIVE"=>"Y", "CODE" => $_REQUEST["country"]), array("ID", "IBLOCK_ID", "CODE", "PROPERTY_NAME"));
	$arCountry = $resCountry->Fetch();
	if (isset($_REQUEST["city"]))
	{
		$resCity = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_CODE" => "cities", "ACTIVE"=>"Y", "CODE" => $_REQUEST["city"]), array("ID", "IBLOCK_ID", "CODE", "PROPERTY_NAME"));
		$arCity = $resCity->Fetch();
		$CityID = $arCity["ID"];
	}
	elseif (isset($_REQUEST["region"]))
	{
		$resFilterRegion = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), array("IBLOCK_CODE" => "cities", "ACTIVE"=>"Y", "SECTION_CODE" => $_REQUEST["region"]), array("ID", "IBLOCK_ID", "CODE", "NAME"));
		while($arFilterRegion = $resFilterRegion->GetNext())
		{
			$CityID[] = $arFilterRegion["ID"];
		}
	}
	// <- Подготовка фильтра
	$arSort = Array("PROPERTYSORT_STATUS"=>"ASC", "PROPERTY_CITY.SORT"=>"ASC", "PROPERTY_CITY.NAME"=>"ASC", "SORT"=>"ASC", "NAME"=>"ASC");
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
	$arFilter = Array(
		"IBLOCK_CODE" => "our_partners",
		"ACTIVE"=>"Y",
		"PROPERTY_COUNTRY" => $arCountry["ID"],
		"PROPERTY_CITY" => $CityID,
		"PROPERTY_STATUS_VALUE" => $statusSC,
		"!PROPERTY_STEND" => $kit
		
	);
	$rsResult = CIBlockElement::GetList($arSort, $arFilter, false, array("nPageSize"=>10, "iNumPage"=>$_REQUEST["PAGEN_1"]), $arSelect);
	while($arResult = $rsResult->GetNextElement())
	{
		$status = "";
		$link = false;
		$arFields = $arResult->GetFields();
		$arProps = $arResult->GetProperties();
		$resCountry = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_CODE" => "countries", "ACTIVE"=>"Y", "ID" => $arProps["COUNTRY"]["VALUE"]), array("ID", "IBLOCK_ID", "CODE", "NAME"));
		$arCountry = $resCountry->Fetch();
		if ($arCountry["CODE"] == "rossiya")
		{
			$resCity = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_CODE" => "cities", "ACTIVE"=>"Y", "ID" => $arProps["CITY"]["VALUE"]), array("ID", "IBLOCK_ID", "NAME"));
			$arCity = $resCity->Fetch();
			$arProps["CITY_COM"]["VALUE"] = $arCity["NAME"];
		}
		else
		{
			$keyNameCity = array_search(LANGUAGE_ID, $arProps["CITY_COM"]["DESCRIPTION"]);
			$arProps["CITY_COM"]["VALUE"] = $arProps["CITY_COM"]["VALUE"][$keyNameCity];
		}
		sort($arProps["SPECIALISTS"]["VALUE"]);
		sort($arProps["STUDENTS"]["VALUE"]);
		$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
		$arProps["NAME"]["VALUE"] = $arProps["NAME"]["VALUE"][$keyName];
		if (SITE_ID == "s3" && !$arProps["SCHOOL"]["VALUE"])
			continue;
?>
<div class="company_item" itemscope itemtype="http://schema.org/Organization">
<?
		if (LANGUAGE_ID == "ru")
		{
			if ($arProps["STATUS"]["VALUE"])
			{
				switch($arProps["STATUS"]["VALUE"])
				{
					case "Авторизованный дилер и сервисный центр":
						$link = true;
						$img = "adsc";
						break;
					case "Сервисный центр":
						$link = true;
						$img = "sci";
						$arProps["STATUS"]["VALUE"] .= ", авторизованный инсталлятор, торговый партнер";
						break;
					case "Авторизованный инсталлятор":
						$link = true;
						$img = "ai";
						$arProps["STATUS"]["VALUE"] .= ", торговый партнер";
						break;
					case "Сертифицированный торговый партнер":
						$link = true;
						$img = "stp";
						break;
				}
				$status = '<div class="name_status" data-id="status'.$arFields["ID"].'"><img alt="'.$arProps["STATUS"]["VALUE"].'" src="/images/icons/'.$img.'.svg" /><div class="hide" id="status'.$arFields["ID"].'">'.$arProps["STATUS"]["VALUE"].'</div></div>';
			}
		}
?>
	<?=$status;?>
	<div class="company_name">
		<div class="name" itemprop="name"><?=$arProps["NAME"]["VALUE"];?></div>
		<div class="city" itemscope itemtype="http://schema.org/PostalAddress" itemprop="address"><span itemprop="addressLocality"><?=$arProps["CITY_COM"]["VALUE"];?></span></div>
	</div>
	<div class="contacts">
<?		if ($scl) { ?>
		<div class="address">
			<div class="address_name">Адрес:</div>
			<div class="address_content" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<span itemprop="addressLocality"><?=$arCountry["NAME"];?>, <?=$arProps["CITY_COM"]["VALUE"];?></span>, 
				<span itemprop="postalCode"><?=$arProps["INDEX"]["VALUE"];?></span>, 
				<span itemprop="streetAddress"><?=$arProps["ADDRESS"]["VALUE"];?></span>
			</div>
		</div>
<?		}?>
<?		if ($arProps["PHONE"]["VALUE"]) { ?>
		<div class="phone"><div class="phone_name"><?=GetMessage("WTBPHONE");?>:</div><div class="phone_content"><?output("PHONE", $arProps["PHONE"]["VALUE"]);?></div></div>
<?		}?>
<?		if ($arProps["FAX"]["VALUE"]) { ?>
			<div class="fax"><div class="fax_name"><?=GetMessage("WTBFAX");?>:</div><div class="fax_content"><?output("FAX", $arProps["FAX"]["VALUE"]);?></div></div>
<?		}?>
<?		if ($arProps["EMAIL"]["VALUE"]) { ?>
		<div class="email"><div class="email_name">E-mail:</div><div class="email_content"><?output("EMAIL", $arProps["EMAIL"]["VALUE"]);?></div></div>
<?		}?>
<?		if ($arProps["SITE"]["VALUE"]) { ?>
		<div class="site"><div class="site_name">web:</div><div class="email_content"><?output("SITE", $arProps["SITE"]["VALUE"], $link);?></div></div>
<?		}?>
	</div>
<?		if (LANGUAGE_ID == "ru" && !$scl) { ?>
	<div class="dop_info">
<?
			if ($arProps["SKLAD"]["VALUE"])
				echo '<div class="sklad" data-id="sklad'.$arFields["ID"].'"><img alt="Региональный склад" src="/images/icons/sklad.svg" /><div class="hide" id="sklad'.$arFields["ID"].'">Региональный склад</div></div>';
			if ($arProps["STEND"]["VALUE"])
				echo '<div class="stend" data-id="stend'.$arFields["ID"].'"><img alt="Демонстрационный мини-стенд системы PERCo" src="/images/icons/stend.svg" /><div class="hide" id="stend'.$arFields["ID"].'">Демонстрационный мини-стенд системы PERCo</div></div>';
			if ($arProps["SPECIALISTS"]["VALUE"])
			{
				echo '<div class="specialists" data-id="specialists'.$arFields["ID"].'"><img alt="Специалисты, прошедшие обучение и подтвердившие квалификацию" src="/images/icons/specialists.svg" />';
				echo '<div class="hide" id="specialists'.$arFields["ID"].'"><span class="bold">Специалисты, прошедшие обучение и подтвердившие квалификацию:</span>';
				output("SPECIALISTS", $arProps["SPECIALISTS"]["VALUE"]);
				echo '</div></div>';
			}
?>
	</div>
<?		}?>
</div>
<?
	}
}
?>
<?
function new_url($page)
{
	$newPath = array();
	$arUrl = parse_url($_SERVER["REQUEST_URI"]);
	$path = $arUrl["path"];
	if(isset($arUrl["query"]))
	{
		$arQuery = explode("&", $arUrl["query"]);
		foreach($arQuery as $query)
		{
			$tmp = explode("=", $query);
			if ($tmp[0] == "PAGEN_1")
				$newPath[$tmp[0]] = $page;
			else
				$newPath[$tmp[0]] = $tmp[1];
		}
	}
	unset($newPath["PAGEN_1"]);
	if ($page == 1 && count($newPath) == 0)
		return  $path;
	elseif ($page != 1)
		$newPath["PAGEN_1"] = $page;
	return $path."?".http_build_query($newPath);
}
if($rsResult->NavPageNomer > 1)
{
	$more_url = new_url($rsResult->NavPageNomer-1);
	$APPLICATION->AddHeadString('<link rel="prev" href="'.$more_url.'" />');
}
if (($rsResult->NavPageNomer + 1) <= $rsResult->NavPageCount)
{
	$more_url = new_url($rsResult->NavPageNomer+1);
	$APPLICATION->AddHeadString('<link rel="next" href="'.$more_url.'" />');
	$more_url = str_replace('-withoutheader', '', $more_url);
?>
<a class="show-more" href="/">Показать еще</a>
<? } ?>
<script>
let ShowMoreClickHandler = async function (e) {
	let label = document.querySelector(`label[for = ${sc_id}]`);
	let country;
	e.preventDefault();
	switch(sc_id) {
		case "sc-rossii":
			country = 'rossiya';
			break;
		case "sc-belarusi":
			country = 'BY';
			break;
		case "sc-kazahstana":
			country = 'KZ';
			break;
		case "sc-ukrainy":
			country = 'UA';
			break;
	}
	let res = await fetch(`/gde-kupit/details-withoutheader.php?ajax=Y&country=${country}&sc=Y&PAGEN_1=${label.dataset.nextPage}`);
	if (res.ok) {
		let resText = await res.text();
		document.querySelector(`label[for = ${sc_id}] + div`).innerHTML += resText;
			document.querySelector('.show-more').remove();
		if (document.querySelector('.show-more') != null) {
			document.querySelector('.show-more').addEventListener('click', ShowMoreClickHandler);
		}
		label.dataset.nextPage = Number(label.dataset.nextPage) + 1;
	} else {
		colnsole.error(`Ошибка запроса. Статус ответа: ${res.status}`);
	}
	
};

document.querySelector('.show-more').addEventListener('click', ShowMoreClickHandler);
</script>