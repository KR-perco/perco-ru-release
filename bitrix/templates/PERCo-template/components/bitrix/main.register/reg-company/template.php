<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<div class="bx-auth-reg">
<?
if($USER->IsAuthorized())
	Header("Location: /client/company/", true, 301);
else
{
	if (count($arResult["ERRORS"]) > 0)
	{
		foreach ($arResult["ERRORS"] as $key => $error)
			if (intval($key) == 0 && $key !== 0) 
				$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

		ShowError(implode("<br />", $arResult["ERRORS"]));
	}
?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" id="regform" enctype="multipart/form-data" >
<?
if($arResult["BACKURL"] <> '') {
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<? } ?>
<table>
	<thead>
		<tr>
			<td colspan="2"><b><?=GetMessage("AUTH_REGISTER")?></b></td>
		</tr>
	</thead>
	<tbody>
<?
array_unshift($arResult["SHOW_FIELDS"], "EMAIL");
$arResult["SHOW_FIELDS"] = array_unique($arResult["SHOW_FIELDS"]);
foreach ($arResult["SHOW_FIELDS"] as $FIELD)
{
	if ($FIELD != "LOGIN")
	{
?>
		<tr>
			<td><?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y") { ?><span class="starrequired">*</span><? } ?></td>
			<td>
<?
	}
	switch ($FIELD)
	{
		case "LOGIN":
?>
			<input size="20" type="hidden" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>">
<?
			break;
		case "PASSWORD":
?>
			<input size="20" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
<?
			if($arResult["SECURE_AUTH"])
			{
?>
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
<?
			}
			break;
		case "CONFIRM_PASSWORD":
?>
			<input size="20" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" />
<?
			break;
		case "PERSONAL_GENDER":
?>
			<select name="REGISTER[<?=$FIELD?>]">
				<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
				<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
				<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
			</select>
<?
			break;
		case "PERSONAL_COUNTRY":
		case "WORK_COUNTRY":
?>
			<select name="REGISTER[<?=$FIELD?>]"><?
			foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
			{
			?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]) { ?> selected="selected"<? } ?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
			<? } ?>
			</select>
<?
			break;
		case "PERSONAL_PHOTO":
		case "WORK_LOGO":
?>
			<input size="20" type="file" name="REGISTER_FILES_<?=$FIELD?>" />
<?
			break;
		case "PERSONAL_NOTES":
		case "WORK_NOTES":
?>
			<textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea>
<?
			break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY") {?><small><?=$arResult["DATE_FORMAT"]?></small><br /><? } ?>
			<input size="20" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /><?
			if ($FIELD == "PERSONAL_BIRTHDAY")
				$APPLICATION->IncludeComponent(
					'bitrix:main.calendar',
					'',
					array(
						'SHOW_INPUT' => 'N',
						'FORM_NAME' => 'regform',
						'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
						'SHOW_TIME' => 'N'
					),
					null,
					array("HIDE_ICONS"=>"Y")
				);
	}
?>
			</td>
<?
	if ($FIELD == "PASSWORD")
		echo '<td>не менее 6 символов</td>';
	if ($FIELD == "CONFIRM_PASSWORD")
		echo '<tr><td><b>Данные о компании</b></td></tr>';
	if ($FIELD == "WORK_COMPANY")
		echo '<td style="color:red;">Внимание! Данное наименование компании будет указано в сертификате.</td>';
	if ($FIELD == "WORK_CITY")
	{
		echo '<tr><td>'.$arResult["USER_PROPERTIES"]["DATA"]["UF_INN"]["EDIT_FORM_LABEL"].':';
		if ($arResult["USER_PROPERTIES"]["DATA"]["UF_INN"]["MANDATORY"]=="Y")
			echo '<span class="required">*</span>';
		echo '</td><td>';
		$APPLICATION->IncludeComponent(
			"bitrix:system.field.edit",
			$arResult["USER_PROPERTIES"]["DATA"]["UF_INN"]["USER_TYPE"]["USER_TYPE_ID"],
			array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arResult["USER_PROPERTIES"]["DATA"]["UF_INN"], "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));
		echo '</td></tr>';
		echo '<tr><td><b>Контактные данные</b></td></tr>';
	}
?>
		</tr>
<? } ?>
		<tr>
			<td colspan="2"><b>Указание статуса компании: *</b></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">
				<input type="hidden" name="UF_TIP_SERT[]" value="">
				<label><input type="checkbox" value="21" name="UF_TIP_SERT[]" <? if(in_array(21, $arResult["VALUES"]["UF_TIP_SERT"])) echo 'checked="checked"'?>>Пользователи системы PERCo-S-20</label><br />
				<label><input type="checkbox" value="18a" name="UF_TIP_SERT[]" <? if(in_array("18a", $arResult["VALUES"]["UF_TIP_SERT"])) echo 'checked="checked"'?>>Компания-инсталлятор систем безопасности</label><br />
				<label><input type="checkbox" value="18b" name="UF_TIP_SERT[]" <? if(in_array("18b", $arResult["VALUES"]["UF_TIP_SERT"])) echo 'checked="checked"'?>>Торговая компания</label><br />
				<label><input type="checkbox" value="18c" name="UF_TIP_SERT[]" <? if(in_array("18c", $arResult["VALUES"]["UF_TIP_SERT"])) echo 'checked="checked"'?>>Проектная компания</label>
			</td>
		</tr>
<?// ******************** /User properties ***************************************************?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<tr>
			<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></td>
			<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
	<?
}
/* !CAPTCHA */
?>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<link type="text/css" href="/scripts/jquery-ui/jquery-ui.css" rel="stylesheet" />
				<script src="/scripts/jquery-ui/jquery-ui.js"></script>
				<div id="dialog-form" title="Согласие">
				<p style="text-align:center"><strong>СОГЛАСИЕ</strong><br />на обработку персональных данных</p><p>Я, <span id="fio"></span>, в соответствии с п. 4 ст. 9 Федерального закона от 27.07.2006 №152-ФЗ "О персональных данных" даю согласие ООО «ПЭРКО», ОРГН 1107847252611, находящемуся по адресу: 194021, г. Санкт-Петербург, ул. Политехническая, д. 4, корпус 2, строение 1, на обработку моих персональных данных, а именно: размещение и хранение моих фамилии, имени и отчества в закрытом доступе на сайте perco.ru, то есть на совершение действий, предусмотренных п. 3 ст. 3 Федерального закона от 27.07.2006 №152-ФЗ "О персональных данных", в целях возможности взаимодействия со мной по вопросам получения информации о специалистах, владеющих навыками работы с системами PERCo.<br />Настоящее согласие действует со дня прочтения и подтверждения.</p>
				</div>
				<span  id="sogbut" style=" text-decoration:underline; color:#CCC; cursor:pointer" >Cогласие</span>
			</td>
			<td>
				<label><input type="checkbox" name="soglasie" id="soglasie" value="0">Согласен</label>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" disabled="disabled"/></td>
		</tr>
	</tfoot>
</table>
<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

</form>
<?}?>
</div>