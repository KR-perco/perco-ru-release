<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<div class="sidebar" style="min-width: 300px;">	
	<?/*
	$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM");
	$arFilter = Array("IBLOCK_ID"=>86, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	while($ob = $res->GetNextElement())
	{
	$arFields = $ob->GetFields();
	?>
		<div><a href="/podderzhka/proektirovshchikam-i-installyatoram/novoe.php?<?=$arFields["ID"]?>"><?=$arFields["NAME"]?></a></div>
	<?
	}
	*/?>
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
		<table class="data-table" cellspacing="0" cellpadding="2">
		<thead>
			<tr>
				<td colspan="2" align="center"><?=GetMessage("IBLOCK_FILTER_TITLE")?></td>
			</tr>
		</thead>
		<tbody>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?//var_dump($arItem);?>
				<?if(!array_key_exists("HIDDEN", $arItem)):?>
					<tr>
						<td valign="top"><?=$arItem["NAME"]?>:</td>
						<td id="target" valign="top"><?=$arItem["INPUT"]?></td>
					</tr>
				<?endif?>
			<?endforeach;?>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?if(!array_key_exists("HIDDEN", $arItem)):?>
					<ul>
						<li><?=$arItem["INPUT"]?></li>
					</ul>
				<?endif?>
			<?endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2">
					<input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" />
					<input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;
					<input id="sub" type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" />
				</td>
			</tr>
		</tfoot>
		</table>
		<input type="submit" name="set_filter" value="Фильтр" />
	</form>
	


</div>


<script>
/*$( "#target select" )
  .change(function () {
    var str = "";
    $( "select option:selected" ).each(function() {
	  alert('fsdfds');
	  document.getElementById("sub").click();
	  //$("#sub").click();
	 //this.form.submit();
    });

  })
  .change();*/
</script>
