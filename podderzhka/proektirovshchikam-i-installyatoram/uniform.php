<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Спецодежда для инсталляторов", "");
$APPLICATION->SetPageProperty("title", "Спецодежда для инсталляторов | PERCo");
$APPLICATION->SetPageProperty("description", "Для удобства проектировщиков и инсталляторов PERCo предлагает полный комплект инструментов: библиотека моделей ArchiCAD, библиотека моделей AutoCAD, схемы подключения оборудования и программа 3D-визуализации проходных");
$APPLICATION->SetPageProperty("keywords", "проектировщики, инсталляторы");
$APPLICATION->SetTitle("Спецодежда для инсталляторов");

$APPLICATION->AddHeadScript("/scripts/jquery-ui/jquery-ui.js");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей

?>

<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Спецодежда для инсталляторов" src="/images/icons/uniform.svg" />
	</div>

	<div class="t-shirt">
		<img alt="Футболка 1" src="/images/support/uniform1.jpg">
		<img alt="Футболка 2" src="/images/support/uniform2.jpg">
		<img alt="Футболка 3" src="/images/support/uniform3.jpg">
	</div>

	<select id="company">
	<?
		$arSort = Array("PROPERTYSORT_STATUS"=>"ASC", "PROPERTY_CITY.NAME"=>"ASC", "SORT"=>"ASC", "NAME"=>"ASC");
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
		$arFilter = Array(
			"IBLOCK_CODE" => "our_partners",
			"ACTIVE"=>"Y",
			"SECTION_ID"=>"289"		
		);
		$rsResult = CIBlockElement::GetList($arSort, $arFilter, false, array(), $arSelect);
		while($arResult = $rsResult->GetNextElement())
		{
			$arFields = $arResult->GetFields();
			?><option value="<?=$arFields["PROPERTY_STATUS_VALUE"]?>"><?=$arFields["NAME"]?>, <?=$arFields["PROPERTY_CITY_NAME"];?></option><?
		}
	?>
	</select>
	<div>
		<h3>Доступны для заказа фирменные поло PERCo. Авторизованные дилеры и сервисные центры могут получить для своих сотрудников четыре поло, другие компании-партнеры – два поло. Для оформления заказа заполните форму обратной связи, указав необходимое количество поло и их размеры.</h3>
		<div class="request-uniform">
			<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "konkurs", array(
				"WEB_FORM_ID" => "55",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"USE_EXTENDED_ERRORS" => "N",
				"SEF_MODE" => "N",
				"SEF_FOLDER" => "",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"LIST_URL" => "",
				"EDIT_URL" => "",
				"SUCCESS_URL" => "",
				"CHAIN_ITEM_TEXT" => "",
				"CHAIN_ITEM_LINK" => "",
				"VARIABLE_ALIASES" => array(
					"WEB_FORM_ID" => "WEB_FORM_ID",
					"RESULT_ID" => "RESULT_ID",
				)
				),
				false
			);?>
		</div>
		<p>*Стоимость каждого дополнительного поло составляет 1000 рублей.</p>
	</div>
</div>

<script src="/scripts/pages/uniform.js"></script>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>