<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
function language($url, $flag, $flag_text)
{
	global $APPLICATION;
	$urlParsed = parse_url($url);
	?><pre style="display: none;"><?var_dump($urlParsed['path']);?></pre><?
	if (str_replace('?'.$_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']) == '/') {
		if ($flag != LANGUAGE_ID) {
			$APPLICATION->AddHeadString('<link rel="alternate" hreflang="'.$flag.'" href="'.$url.'" />', true);
		} else {
			$APPLICATION->AddHeadString('<link rel="alternate" hreflang="'.$flag.'" href="https://'.$_SERVER['HTTP_HOST'].$url.'" />', true);
		}
	} else {
		if ($urlParsed['path'] != '/' && !empty($urlParsed['path'])) {
			if ($flag != LANGUAGE_ID) {
				$APPLICATION->AddHeadString('<link rel="alternate" hreflang="'.$flag.'" href="'.$url.'" />', true);
			} else {
				$APPLICATION->AddHeadString('<link rel="alternate" hreflang="'.$flag.'" href="https://'.$_SERVER['HTTP_HOST'].$url.'" />', true);
			}
		}
	}
	if ($_SERVER["REQUEST_URI"] == $url || $_SERVER["REQUEST_URI"] == $url.$_SERVER["REQUEST_URI"])
	{
		return '<div class="flag">
				<img width="29" height="21" src="/images/icons/flag-'.$flag.'-cur.gif" alt="'.$flag_text.'">
				<img width="29" height="21" class="mask" src="/images/flags/mask_flag.svg" alt="mask">
			</div>';
	}
	else
	{
		return '<a href="'.$url.'" title="'.$flag_text.'"><div class="flag"><img width="29" height="21" style="width: 30px; height: 21px;" src="/images/icons/flag-'.$flag.'.svg" alt="'.$flag_text.'" ></div></a>';
	}
}
function getMultilang($property)
{
	$arProps = array();
	$arFilter = Array(
		"IBLOCK_CODE" => "multilang",
		"ACTIVE"=>"Y",
		$property
	);
	$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter);
	if(intval($res->SelectedRowsCount()))
	{
		$ar_fields = $res->GetNextElement();
		$arProps = $ar_fields->GetProperties();
	}
	return $arProps;
}
$host = array();
$lang = array();
$rsSite = CSite::GetList($by="sort", $order="asc", array("ACTIVE" => "Y"));
while ($arSite = $rsSite->GetNext())
{
	if ($arSite["LID"] == "s3")
		continue;
	$lang[$arSite["LID"]] = $arSite["LANGUAGE_ID"];
	$host[$arSite["LID"]] = $arSite["SITE_URL"];
}
if (SITE_ID != "s3")
{
	$key = "zdT,\BfO>N";
	$multilang = false;
	$change_lang ="";
	$lang_text = array();
	$lang_text = array("s1"=>"Русский","s5"=>"English","s6"=>"Deutsch","s7"=>"Français","s8"=>"Italiano","s9"=>"Español");
	$buy_text = array("s1"=>"/gde-kupit/","s5"=>"/where-to-buy/","s6"=>"/handler/","s7"=>"/ou-acheter/","s8"=>"/dove-comprare/","s9"=>"/donde-comprar/");
	$request_uri = pathinfo($_SERVER["REQUEST_URI"]);

	if(strtr($request_uri["dirname"], array("/"=>"")) == strtr($buy_text[SITE_ID], array("/"=>"")))
	{
		// переход в разделе Где купить
		$resCountry = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_CODE" => "countries", "ACTIVE"=>"Y", "CODE" => $request_uri["filename"]), array("ID", "IBLOCK_ID", "CODE"));
		if(intval($resCountry->SelectedRowsCount()))
		{
			$multilang = true;
			while($arCountry = $resCountry->GetNextElement())
			{
				$arFields = $arCountry->GetFields();
				foreach($lang as $key => $val)
				{
					if ($_SERVER["REQUEST_URI"] == $host[$key] || $_SERVER["REQUEST_URI"] == $host[$key].$_SERVER["REQUEST_URI"])
						$mobile_flag = '<input id="flag" type="checkbox"><label for="flag"><span>'.file_get_contents($_SERVER["DOCUMENT_ROOT"]."/images/menu/li.menu.svg").'</span><div class="flag"><img width="29" height="21" src="/images/icons/flag-'.$lang[$key].'-cur.gif" alt="'.$lang_text[$key].'"><img width="29" height="21" class="mask" src="/images/flags/mask_flag_blue.svg"></div></label>';
					if ($arFields["CODE"] == "rossiya")
						$change_lang .= language($host[$key].$buy_text[$key], $lang[$key], $lang_text[$key]);
					else
						$change_lang .= language($host[$key].$buy_text[$key].$arFields["CODE"]."/", $lang[$key], $lang_text[$key]);
				}
			}
		}
	}
	else
	{
		function compare($el1, $el2)
		{
			if ($el1["LID"] == $el2["LID"]) return 0;
				return ($el1["LID"] < $el2["LID"])? -1: 1;
		}
		// выбираем привязку к страницам - раздел каталог
		if ($request_uri["filename"])
			$arLinks = getMultilang(array("PROPERTY_LINK_PRODUCTS.CODE" => $request_uri["filename"]));
		if (count($arLinks) > 0)
		{
			$multilang = true;
			foreach($arLinks["LINK_PRODUCTS"]["VALUE"] as $val)
			{
				$resElement = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("ID"=>$val));
				$arElement = $resElement->GetNext();
				$arElements[] = $arElement;
			}
			usort($arElements, "compare"); // Вызываем пользовательскую сортировку
			foreach($arElements as $arVal)
			{
				if ($_SERVER["REQUEST_URI"] == $host[$arVal["LID"]] || $_SERVER["REQUEST_URI"] == $host[$arVal["LID"]].$_SERVER["REQUEST_URI"])
					$mobile_flag = '<input id="flag" type="checkbox"><label for="flag"><span>'.file_get_contents($_SERVER["DOCUMENT_ROOT"]."/images/menu/li.menu.svg").'</span><div class="flag"><img width="29" height="21" src="/images/icons/flag-'.$lang[$arVal["LID"]].'-cur.gif" alt="'.$lang_text[$key].'"><img width="29" height="21" class="mask" src="/images/flags/mask_flag_blue.svg"></div></label>';
				$arVal["DETAIL_PAGE_URL"] = str_replace("_com", "", $arVal["DETAIL_PAGE_URL"]);
				$change_lang .= language($host[$arVal["LID"]].$arVal["DETAIL_PAGE_URL"], $lang[$arVal["LID"]], $lang_text[$arVal["LID"]]);
			}
		}
		// выбираем статично забитые относительные адреса
		$arLinks = getMultilang(array("PROPERTY_LINKS" => $_SERVER["REQUEST_URI"]));
		if (count($arLinks) > 0)
		{
			$multilang = true;
			foreach($lang as $key => $val)
			{
				if ($_SERVER["REQUEST_URI"] == $host[$key] || $_SERVER["REQUEST_URI"] == $host[$key].$_SERVER["REQUEST_URI"])
					$mobile_flag = '<input id="flag" type="checkbox"><label for="flag"><span>'.file_get_contents($_SERVER["DOCUMENT_ROOT"]."/images/menu/li.menu.svg").'</span><div class="flag"><img width="29" height="21" src="/images/icons/flag-'.$lang[$key].'-cur.gif" alt="'.$lang_text[$key].'"><img width="29" height="21" class="mask" src="/images/flags/mask_flag_blue.svg"></div></label>';
				$keyLink = array_search($val, $arLinks["LINKS"]["DESCRIPTION"]);
				$change_lang .= language($host[$key].$arLinks["LINKS"]["VALUE"][$keyLink], $lang[$key], $lang_text[$key]);
			}
		}
		if (!$multilang)
		{
			// нет записи в базе - ссылаемся на главные страницы
			foreach($lang as $key => $val)
			{
				if ($_SERVER["REQUEST_URI"] == $host[$key] || $_SERVER["REQUEST_URI"] == $host[$key].$_SERVER["REQUEST_URI"])
					$mobile_flag = '<input id="flag" type="checkbox"><label for="flag"><span>'.file_get_contents($_SERVER["DOCUMENT_ROOT"]."/images/menu/li.menu.svg").'</span><div class="flag"><img width="29" height="21" src="/images/icons/flag-'.$lang[$key].'-cur.gif" alt="'.$lang_text[$key].'"><img width="29" height="21" class="mask" src="/images/flags/mask_flag_blue.svg"></div></label>';
				$change_lang .= language($host[$key], $lang[$key], $lang_text[$key]);
			}
		}
	}
	echo $mobile_flag."<div>".$change_lang."</div>";
}
else
	echo '<a class="school" href="'.$host["s1"].'" title="Системы безопасности PERCo">www.perco.ru</a>';
?>