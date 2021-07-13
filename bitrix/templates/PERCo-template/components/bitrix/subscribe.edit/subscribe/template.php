<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$page = $APPLICATION->GetCurPage(); 
$part = explode("/", $page);

foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
foreach($arResult["ERROR"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));

if($arResult["ALLOW_ANONYMOUS"]=="N" && !$USER->IsAuthorized()):
	echo ShowMessage(array("MESSAGE"=>GetMessage("CT_BSE_AUTH_ERR"), "TYPE"=>"ERROR"));
else:
?>
<div class="subscription">
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
	<?echo bitrix_sessid_post();?>
	<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
	<input type="hidden" name="RUB_ID[]" value="0" />

	<div class="group">
		<input type="hidden" name="FORMAT" value="html" checked />
		<input type="text" name="EMAIL" value="<?echo $arResult["SUBSCRIPTION"]["EMAIL"]!=""? $arResult["SUBSCRIPTION"]["EMAIL"]: $arResult["REQUEST"]["EMAIL"];?>" class="subscription-email" />
		<label><?=GetMessage("CT_BSE_EMAIL")?></label>
		<span class="highlight"></span>
		<span class="bar"></span>
		<div class="subscription-rubric">
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):		
			$checked = '';
				if (($itemValue["CHECKED"]) || 
					($part[1] == 'podderzhka' && $itemValue["NAME"] == 'Новое о товарах') || 
					($part[1] == 'novosti' && $itemValue["NAME"] == 'Новости компании PERCo'))
				{
					?>
						<input type="hidden" id="RUBRIC_<?echo $itemID?>" name="RUB_ID[]" value="<?=$itemValue["ID"]?>"/>
					<?
				}
		endforeach;?>
		</div>
		<label><input type="hidden" name="FORMAT" value="html" checked /></label>
	</div>
	<button value="<?=GetMessage("CT_BSE_SUBSCRIPTION_FORM_TITLE")?>" name="Save" type="submit">
		<div>
			<img alt="<?=GetMessage("CT_BSE_SUBSCRIPTION_FORM_TITLE")?>" width="14" height="14" src="/images/icons/key.svg"><?=GetMessage("CT_BSE_SUBSCRIPTION_FORM_TITLE")?>
		</div>
	</button>
</div>
<?endif;?>