
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?  

if ($_GET["formresult"] == "addok") {?>
	<p class="text-success"><?=GetMessage("FORM_DATA_SUCCESS");?></p> 
<?	} else { ?>
	<p><?=GetMessage("REQUIRED_FIELDS_SPACE");?></p>
<? 	 }
	if ($arResult["isFormErrors"] == "Y")
		echo $arResult["FORM_ERRORS_TEXT"];

	if ($arResult["isFormNote"] != "Y") {
		echo $arResult["FORM_HEADER"];
	/***********************************************************************************
							form questions
	***********************************************************************************/
		foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
		{
			
			if ($arQuestion['STRUCTURE'][0]['FIELD_ID'] == 895) {  // merchandise 
	?>
	<div class="form_row" id="booklets-input">
		<div class="input-copy">
		</div>
		<? 
			echo $arQuestion["HTML_CODE"];    
		?>
		<script> 
			if (document.querySelector('.input-copy')) { 
				let merchInput = document.querySelector('#booklets-input > input');
				document.querySelector('.input-copy').innerHTML = merchInput.value; 
			}
		</script>
	</div>
	<?
			} else
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
				echo $arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : "";
	?>
		</div>
		
		<div><?=$arQuestion["HTML_CODE"];?></div>
	</div>
	<?
				}
			}
		} //endforeach
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