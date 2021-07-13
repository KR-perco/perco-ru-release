<p><?=GetMessage("REQUIRED_FIELDS_SPACE");?></p>
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
if ($arResult["isFormErrors"] == "Y")
	echo $arResult["FORM_ERRORS_TEXT"];

if ($arResult["isFormNote"] != "Y")
{
	echo $arResult["FORM_HEADER"];
/***********************************************************************************
						form questions
***********************************************************************************/
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
			echo $arQuestion["HTML_CODE"];
		else
		{
?>
<div class="form_row">
	<div>
<?
			if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS']))
			{
?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
<?			}
			echo $arQuestion["CAPTION"];
			if ($arQuestion["REQUIRED"] == "Y")
				echo $arResult["REQUIRED_SIGN"];
			echo $arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? " ".$arQuestion["IMAGE"]["HTML_CODE"] : "";
?>
	</div>
	<div><?=$arQuestion["HTML_CODE"];?></div>
</div>
<?
		}
	} //endwhile
	if($arResult["isUseCaptcha"] == "Y")
	{
?>
<div><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?></div>
<div class="form_row">
	<div><input type="text" name="captcha_word" size="20" maxlength="50" value="" class="inputtext" /></div>
	<div><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" height="40" /></div>
</div>
<?
} // isUseCaptcha
?>
<div>
	<input type="submit" name="web_form_submit" value="<?=GetMessage("SUBMIT");?>" />
</div>
<?
	echo $arResult["FORM_FOOTER"];
} //endif (isFormNote)
?>