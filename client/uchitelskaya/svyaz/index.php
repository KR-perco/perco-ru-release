<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Связь");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Связь");
?> 
<div class="dop_menu">
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_dop_menu", 
	array(
		"ROOT_MENU_TYPE" => "podmenu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
</div>
<div id="content"> 
  <h1>
  <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:support.ticket",
	"",
	Array(
		"SEF_MODE" => "N",
		"TICKETS_PER_PAGE" => "50",
		"MESSAGES_PER_PAGE" => "20",
		"MESSAGE_MAX_LENGTH" => "70",
		"MESSAGE_SORT_ORDER" => "asc",
		"SET_PAGE_TITLE" => "N",
		"SHOW_COUPON_FIELD" => "N",
		"VARIABLE_ALIASES" => Array(
			"ID" => "ID"
		)
	),
false
);?>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>