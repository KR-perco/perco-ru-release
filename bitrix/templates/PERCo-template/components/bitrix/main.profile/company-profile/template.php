<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="bx-auth-profile">
  <?=ShowError($arResult["strProfileError"]);?>
  <?
if ($arResult['DATA_SAVED'] == 'Y')
	echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<script type="text/javascript">
<!--
var opened_sections = [<?
$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
if (strlen($arResult["opened"]) > 0)
{
	echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
}
else
{
	$arResult["opened"] = "reg";
	echo "'reg'";
}
?>];
//-->
var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
</script>
<script type="text/javascript" src="/scripts/validate.js"></script>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" >
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="lang" value="<?=LANG?>" />
	<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
	<div class="profile-link profile-user-div-link">
		<h3><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" OnClick="javascript: SectionClick('work')">
		Информация о компании
		</a></h3>
	</div>
	<div id="user_div_work" class="profile-block-<?=strpos($arResult["opened"], "work") === false ? "hidden" : "shown"?>">
		<table class="data-table profile-table">
			<tbody>
			<tr>
				<td><?=GetMessage('USER_COMPANY')?>
				<span class="starrequired">*</span></td>
				<td><input type="text" name="WORK_COMPANY" maxlength="255" value="<?=$arResult["arUser"]["WORK_COMPANY"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_WWW')?>
				<span class="starrequired">*</span></td>
				<td><input type="text" name="WORK_WWW" maxlength="255" value="<?=$arResult["arUser"]["WORK_WWW"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage("USER_WORK_PROFILE")?></td>
				<td><textarea cols="30" rows="5" name="WORK_PROFILE"><?=$arResult["arUser"]["WORK_PROFILE"]?>
				</textarea></td>
			</tr>
			<tr>
				<td colspan="2" class="profile-header"><strong><?=GetMessage("USER_PHONES")?></strong></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_PHONE')?></td>
				<td><input type="text" name="WORK_PHONE" maxlength="255" value="<?=$arResult["arUser"]["WORK_PHONE"]?>" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_FAX')?>
				</font></td>
				<td><input type="text" name="WORK_FAX" maxlength="255" value="<?=$arResult["arUser"]["WORK_FAX"]?>" /></td>
			</tr>
			<tr>
				<td colspan="2" class="profile-header"><strong><?=GetMessage("USER_POST_ADDRESS")?></strong></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_COUNTRY')?></td>
				<td><?=$arResult["COUNTRY_SELECT_WORK"]?></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_STATE')?></td>
				<td><input type="text" name="WORK_STATE" maxlength="255" value="<?=$arResult["arUser"]["WORK_STATE"]?>" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_CITY')?>
				<span class="starrequired">*</span></td>
				<td><input type="text" name="WORK_CITY" maxlength="255" value="<?=$arResult["arUser"]["WORK_CITY"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_ZIP')?></td>
				<td><input type="text" name="WORK_ZIP" maxlength="255" value="<?=$arResult["arUser"]["WORK_ZIP"]?>" /></td>
			</tr>
			<tr>
				<td><?=GetMessage("USER_STREET")?></td>
				<td><textarea cols="30" rows="5" name="WORK_STREET"><?=$arResult["arUser"]["WORK_STREET"]?>
				</textarea></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_MAILBOX')?></td>
				<td><input type="text" name="WORK_MAILBOX" maxlength="255" value="<?=$arResult["arUser"]["WORK_MAILBOX"]?>" /></td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="profile-link profile-user-div-link">
		<h3><a title="<?=GetMessage("CONTACT_SHOW_HIDE")?>" href="javascript:void(0)" OnClick="javascript: SectionClick('contact')">
		<?=GetMessage("CONTACT_SHOW_HIDE")?>
	</a></h3>
	</div>
	<div class="profile-block-<?=strpos($arResult["opened"], "contact") === false ? "hidden" : "shown"?>" id="user_div_contact">
		<table class="profile-table data-table">
			<tbody>
			<tr>
				<td><?=GetMessage('NAME')?>
				<span class="starrequired">*</span></td>
				<td><input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('LAST_NAME')?>
				<span class="starrequired">*</span></td>
				<td><input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('SECOND_NAME')?></td>
				<td><input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('USER_PHONE')?></td>
				<td><input type="text" name="PERSONAL_PHONE" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" required="required" /></td>
			</tr>
			</tbody>
		</table>
	</div>
	<div class="profile-link profile-user-div-link">
		<h3><a title="<?=GetMessage("REG_SHOW_HIDE")?>" href="javascript:void(0)" OnClick="javascript: SectionClick('reg')">
		<?=GetMessage("REG_SHOW_HIDE")?>
	</a></h3>
	</div>
	<div class="profile-block-<?=strpos($arResult["opened"], "reg") === false ? "hidden" : "shown"?>" id="user_div_reg">
		<table class="profile-table data-table">
			<tbody>
			<tr>
				<td><?=GetMessage('EMAIL')?>
				<span class="starrequired">*</span></td>
				<td><input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('LOGIN')?>
				<span class="starrequired">*</span></td>
				<td><input type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" required="required" /></td>
			</tr>
			<tr>
				<td><?=GetMessage('NEW_PASSWORD_REQ')?></td>
				<td><input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
			<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
				<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
				<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
			<?endif?>
				<br />
			<?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></td>
			</tr>
			<tr>
				<td><?=GetMessage('NEW_PASSWORD_CONFIRM')?></td>
				<td><input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" /></td>
			</tr>
			<?if($arResult["TIME_ZONE_ENABLED"] == true):?>
			<tr>
				<td colspan="2" class="profile-header"><?echo GetMessage("main_profile_time_zones")?></td>
			</tr>
			<tr>
				<td><?echo GetMessage("main_profile_time_zones_auto")?></td>
				<td><select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
				<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
				<option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
				<option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
				</select></td>
			</tr>
			<tr>
				<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
				<td><select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
				<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
				<option value="<?=htmlspecialchars($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>>
				<?=htmlspecialchars($tz_name)?>
				</option>
				<?endforeach?>
				</select></td>
			</tr>
			<?endif?>
			</tbody>
		</table>
	</div>
		<p>
			<input type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
			&nbsp;&nbsp;
			<input type="reset" value="<?=GetMessage('MAIN_RESET');?>">
			&nbsp;&nbsp;
			<input type="button" value="Выход" onclick="javascript:window.location='?logout=yes'">
		</p>
	</form>
</div>
