<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
?>
<div id="section_list_main">
<?
global $device;
foreach($arResult["SECTIONS"] as $arValue)
{
	if (stripos($arValue["NAME"], "ПО ") !== false || $arValue["CODE"] == "prays-list")
		continue;
	if (LANGUAGE_ID == "en")
		$arValue["SECTION_PAGE_URL"] = str_replace("_com", "", $arValue["SECTION_PAGE_URL"]);
	if ($device != "desktop")
		$arValue["NAME"] = str_replace("Электромеханические замки", "Замки", $arValue["NAME"]);
?>
	<div class="section_element">
		<a href="<?=$arValue["SECTION_PAGE_URL"];?>">
			<div><img alt="<?=$arValue["NAME"];?>" src="<?=$arValue["DESCRIPTION"];?>" /></div>
			<p><?=$arValue["NAME"];?></p>
		</a>
	</div>
	<?/*if ($arValue["NAME"] == "Электронные проходные"):?>
	<div class="section_element">
		<a href="/products/shlagbaum-gs04.php">
			<div><img alt="Шлагбаум" src="/images/icons/barrier.svg" /></div>
			<p>Шлагбаум</p>
		</a>
	</div>
	<? endif; */?>
<? }?>
</div>