<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$arResult["FORM_ACTION"]?>">
<?
if($arParams["USE_SUGGEST"] === "Y")
{
	$APPLICATION->IncludeComponent(
		"bitrix:search.suggest.input",
		"",
		array(
			"NAME" => "q",
			"VALUE" => "",
			"INPUT_SIZE" => 15,
			"DROPDOWN_SIZE" => 10,
		),
		$component, array("HIDE_ICONS" => "Y")
	);
}
else
{
?>
	<input id="searchlabel" type="checkbox" />
	<label for="searchlabel"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/loup.svg");?></label>
	<div id="searchForm">
		<input id="searchText" type="text" name="q" value="" size="15" maxlength="50" placeholder="<?=GetMessage("SEARCH_TEXT");?>" />
<? } ?>
		<input id="searchbutton" class="png" name="s" type="submit" value="" />
	</div>
</form>