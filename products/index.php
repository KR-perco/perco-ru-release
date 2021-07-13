<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CMain::IncludeFile("lang/".LANGUAGE_ID."/products.php");
$APPLICATION->SetPageProperty("title", GetMessage("TITLE"));
$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));
$APPLICATION->SetPageProperty("description", GetMessage("DESCRIPTION"));
$APPLICATION->SetTitle(GetMessage("SETTITLE"));

if (LANGUAGE_ID == "ru")
	$APPLICATION->SetAdditionalCSS("/css/katalog.css"); // подключение стилей
else
	$APPLICATION->SetAdditionalCSS("/css/products.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/products.js"); // подключение скриптов
?>
<?if (LANGUAGE_ID != "ru") { ?>
<div class="width_all">
	<div class="banner_image"></div>
</div>
<? } ?>
<div id="content">
<!--h1><?switch (LANGUAGE_ID) {
	case 'ru':
		echo 'Оборудование и системы безопасности';
		break;
	case 'en':
		echo 'Equipment and security systems';
		break;
	case 'de':
		echo 'Sicherheitssysteme';
		break;
	case 'fr':
		echo 'Systèmes de sécurité';
		break;
	case 'it':
		echo 'Sistemi di sicurezza';
		break;
	case 'es':
		echo 'Sistemas de seguridad';
		break;
}?></h1-->
<?
switch(LANGUAGE_ID)
{
	case "ru":
		$iblock_code = "products";
		break;
	case "en":
		$iblock_code = "products_com";
		break;
	default:
		$iblock_code = strtr(dirname($_SERVER["PHP_SELF"]), array("/"=>""));
		break;
}
$iblocks = GetIBlockList("structure", $iblock_code);
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$current_group = "";
$count = 0;
$group_first = true;
if (LANGUAGE_ID == "ru")
	$arSort = Array("UF_GROUP_PRODUCTS"=>"asc", "sort"=>"asc");
else
	$arSort = Array("sort"=>"asc");
$arFilter = Array("IBLOCK_ID"=>$block_id, "GLOBAL_ACTIVE"=>"Y", "<=DEPTH_LEVEL"=>1);
$rsSections = CIBlockSection::GetList($arSort, $arFilter, false, array("UF_GROUP_PRODUCTS"));
while($arSection = $rsSections->GetNext())
{
	if ($arSection["CODE"] == "prays-list")
		continue;
	if (LANGUAGE_ID == "en")
		$arSection["SECTION_PAGE_URL"] = str_replace("_com", "", $arSection["SECTION_PAGE_URL"]);
	$count++;
	if ($current_group != $arSection["UF_GROUP_PRODUCTS"])
	{
		$group_first = true;
		$current_group = $arSection["UF_GROUP_PRODUCTS"];
	}
	if ($group_first)
	{
		if ($count > 1)
			echo "</div>";
		$group_first = false;
		if (LANGUAGE_ID == "ru")
		{
			$rsEnum = CUserFieldEnum::GetList(array(), array("ID" =>$arSection["UF_GROUP_PRODUCTS"]));
			$arEnum = $rsEnum->Fetch();
?>
	<h2><?=$arEnum["VALUE"];?></h2>
<?		}?>
	<div class="product_elements <?if ($arEnum["VALUE"] == "Оборудование безопасности") echo "prod_first";?>">
<?	}?>
		<div data-check class="product_item">
			<a class="item_img" href="<?=$arSection["SECTION_PAGE_URL"];?>">
				<img alt="<?=$arSection["NAME"];?>" src="<?=$arSection["DESCRIPTION"];?>" />
				<div class="item_name"><?echo ($arSection["NAME"] == "Турникеты") ? $arSection["NAME"].", калитки, ограждения" : $arSection["NAME"];?>
				</div>
			</a>
		</div>
		<?/*if ($arSection["NAME"] == "Электронные проходные"):?>
		<div class="product_item">
			<a class="item_img" href="/products/shlagbaum-gs04.php">
				<img alt="Шлагбаум" src="/images/icons/barrier.svg" />
				<div class="item_name">Шлагбаум</div>
			</a>
		</div>
		<? endif; */?>
		<?/*
		<?if ($arSection["NAME"] == "IP-based entrance control systems"):?>
		<div class="product_item">
			<a class="item_img" href="/products/gs04-boom-barrier.php">
				<img alt="Шлагбаум" src="/images/icons/barrier.svg" />
				<div class="item_name">Boom barrier</div>
			</a>
		</div>
		<? endif; ?>
		<?if ($arSection["NAME"] == "Systèmes de contrôle d'accès sur IP"):?>
		<div class="product_item">
			<a class="item_img" href="/produits/barri-re-levante-gs04.php">
				<img alt="Шлагбаум" src="/images/icons/barrier.svg" />
				<div class="item_name">Barrière levante</div>
			</a>
		</div>
		<? endif; ?>
		<?if ($arSection["NAME"] == "Sistemi di controllo accessi basati su IP"):?>
		<div class="product_item">
			<a class="item_img" href="/prodotti/gs04-sbarra-del-passaggio-a-livello.php">
				<img alt="Шлагбаум" src="/images/icons/barrier.svg" />
				<div class="item_name">Sbarra del passaggio a livello</div>
			</a>
		</div>
		<? endif; ?>
		<?if ($arSection["NAME"] == "Pasos electrónicos"):?>
		<div class="product_item">
			<a class="item_img" href="/productos/barrera-vehicular-gs04.php">
				<img alt="Шлагбаум" src="/images/icons/barrier.svg" />
				<div class="item_name">Barrera vehicular</div>
			</a>
		</div>
		<? endif; ?>
		*/?>
<?
	if ($count == intval($rsSections->SelectedRowsCount()))
		echo "</div>";
}
if (LANGUAGE_ID == "en")
{
?>
	<div class="products-button">
		<div class="block-links">
			<div class="link m-r">
				<a href="/news/?type=new_product">
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/new.svg");?></div>
					<div class="ico new">
						<p>New products</p>
					</div>
				</a>
			</div>	
			<div class="link m-r">
				<a href="/support/catalogues-booklets.php">
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/prosmotr.svg");?></div>
					<div class="ico">
						<p>View catalogues & booklets</p>
					</div>					
				</a>
			</div>
			<div class="link">
				<a target="_blank" href="/video/en/how-to-choose-a-turnstile.mp4"><!--/about/video/kak-vybrat-turniket.php-->
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/how-choice.svg");?></div>
					<div class="ico">
						<img style="width:21px" src="/images/icons/you-icon.svg" alt="Иконка">
						<p>How to choose a turnstile</p>
					</div>
				</a>
			</div>
		</div>
	</div>
<?
}
if (LANGUAGE_ID == "fr")
{
?>
	<div class="products-button">
		<div class="block-links">
			<div class="link m-r">
				<a href="/actualites/?type=new_product">
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/new.svg");?></div>
					<div class="ico new">
						<p>Nouveaux produits</p>
					</div>
				</a>
			</div>	
			<div class="link m-r">
				<a href="/sav/catalogues-et-brochures.php">
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/prosmotr.svg");?></div>
					<div class="ico">
						<p>Voir catalogues et brochures</p>
					</div>					
				</a>
			</div>
			<div class="link">
				<a target="_blank" href="/video/fr/comment-choisir-le-tourniquet.mp4"><!--/la-societe/video/sistema-kontrolya-dostupa-perco-web.php-->
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/how-choice.svg");?></div>
					<div class="ico">
						<img style="width:21px" src="/images/icons/you-icon.svg" alt="Иконка">
						<p>Comment choisir le tourniquet</p>
					</div>
				</a>
			</div>
		</div>
	</div>
<?
}
if (LANGUAGE_ID == "es")
{
?>
	<div class="products-button">
		<div class="block-links">
			<div class="link m-r">
				<a href="/noticias/?type=new_product">
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/new.svg");?></div>
					<div class="ico new">
						<p>Nuevos productos</p>
					</div>
				</a>
			</div>	
			<div class="link m-r">
				<a href="/servicios/catalogos-y-folletos.php">
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/prosmotr.svg");?></div>
					<div class="ico">
						<p>Ver catálogos y folletos</p>
					</div>					
				</a>
			</div>
			<div class="link">
				<a target="_blank" href="/video/es/como-elegir-el-torniquete.mp4"><!--/la-empresa/video/sistema-kontrolya-dostupa-perco-web.php-->
					<div class="svg"><?include($_SERVER["DOCUMENT_ROOT"]."/images/other/how-choice.svg");?></div>
					<div class="ico">
						<img style="width:21px" src="/images/icons/you-icon.svg" alt="Иконка">
						<p>Como eligir el torniquete</p>
					</div>
				</a>
			</div>
		</div>
	</div>
<?
}
if (LANGUAGE_ID == "ru")
{
?>
	<div id="price">
		<div class="price_text">
			<a onclick="ga('send', 'event', {'eventCategory': 'ПРАЙС', 'eventAction': 'download', 'eventLabel': '/download/price/price_PERCo.pdf'});" target="_blank" href="/download/price/price_PERCo.pdf" download>
				<div class="icon">
					<img src="/images/icons/price.svg" alt="Прайс-лист"><span class="icon_text">Скачать прайс-лист</span>
				</div>
			</a>
			<a href="/products/video/">
				<div class="icon">
					<img src="/images/icons/video-catalog.svg" alt="Технический каталог"><span class="icon_text">Посмотреть видео</span>
				</div>
			</a>
			<a href="/podderzhka/katalogi-i-buklety.php">
				<div class="icon">
					<img src="/images/icons/reclame.svg" alt="Каталоги и буклеты"><span class="icon_text">Посмотреть каталоги и буклеты</span>
				</div>
			</a>
			<a href="/podderzhka/zakaz-kataloga.php">
				<div class="icon">
					<img src="/images/icons/catalog.svg" alt="Технический каталог"><span class="icon_text">Заказать технический каталог</span>
				</div>
			</a>
			<a href="/download/other/sravnenie-sistem.pdf" target="_blank">
				<div class="icon">
					<img src="/images/icons/sravnenie.svg" alt="Технический каталог"><span class="icon_text">Сравнительная таблица систем безопасности PERCo</span>
				</div>
			</a>
		</div>
	</div>
<? } ?>
</div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>