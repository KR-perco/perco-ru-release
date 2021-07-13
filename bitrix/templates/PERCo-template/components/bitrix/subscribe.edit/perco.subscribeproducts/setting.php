<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
//***********************************
//setting section
//***********************************
?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="post">
<?echo bitrix_sessid_post();?>
<div id="head_subscribe" style="display: none;"><?=GetMessage("subscr_title_settings")?></div>
<div class="group">
	
	<input required type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255"  />
<?
	echo '<input type="hidden" name="RUB_ID[]" value="27">';
?>
	<label><input type="hidden" name="FORMAT" value="html" checked /></label>
	<label><?=GetMessage("subscr_auth_email")?></label>
	<span class="highlight"></span>
    <span class="bar"></span>
</div>
<button value="<?=GetMessage("subscr_add")?>" name="Save" type="submit"><div><img alt="<?=GetMessage("subscr_add")?>" width="14" height="14" src="/images/icons/key.svg"><?=GetMessage("subscr_add")?></div></button>
<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<?if($_REQUEST["register"] == "YES"):?>
	<input type="hidden" name="register" value="YES" />
<?endif;?>
<?if($_REQUEST["authorize"]=="YES"):?>
	<input type="hidden" name="authorize" value="YES" />
<?endif;?>
</form>