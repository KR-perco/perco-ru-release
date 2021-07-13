<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="bx-auth-profile">
  <?=ShowError($arResult["strProfileError"]);?>
  <?
if ($arResult['DATA_SAVED'] == 'Y')
{
	$sert = $arResult["arUser"]["UF_TIP_SERT"];
	$tip_sert = "";
	switch($_REQUEST["STATUS"])
	{
		case "AI":
			$sert[] = 18;
			$tip_sert = "UF_PAI";
			echo ShowNote("Заявка на статус Авторизованного инсталлятора успешно подана");
			break;
		case "TP":
			$sert[] = 19;
			$tip_sert = "UF_PTP";
			echo ShowNote("Заявка на статус Торгового партнера успешно подана");
			break;
		case "AS":
			$sert[] = 21;
			$tip_sert = "UF_PAS";
			echo ShowNote("Заявка на подтверждение квалификации сотрудников успешно подана");
			break;
		case "TPF":
		case "FS":
			echo ShowNote("Файл сохранен");
			break;
		default:
			echo ShowNote(GetMessage('PROFILE_DATA_SAVED'));
			break;
	}
	if ($tip_sert)
	{
		$user = new CUser;
		$fields = Array(
			$tip_sert => "Ожидает подтверждения",
			"UF_TIP_SERT" => $sert,
		); 
		$user->Update($arResult["ID"], $fields);
	}
}
?>
<script type="text/javascript" src="/scripts/validate.js"></script>
	<link type="text/css" href="/scripts/jquery-ui/jquery-ui.css" rel="stylesheet" />
	<script src="/scripts/jquery-ui/jquery-ui.js"></script>
	<form id="status-form" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" >
		<?=$arResult["BX_SESSION_CHECK"]?>
		<input type="hidden" name="lang" value="<?=LANG?>" />
		<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
		<input type="hidden" name="EMAIL" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
		<input type="hidden" name="LOGIN" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
		<input type="hidden" name="STATUS" value="<?=$_REQUEST["STATUS"];?>"/>
		<table class="profile-table">
			<tbody>
<?// ********************* User properties ***************************************************?>
<?
			if($arResult["USER_PROPERTIES"]["SHOW"] == "Y")
			{
				foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField)
				{
?>
				<tr id="<?=$arUserField["FIELD_NAME"];?>">
					<td class="field-name"><?if ($arUserField["MANDATORY"]=="Y" || $arUserField["FIELD_NAME"] == "UF_ZAKUPKI") { ?>
						<span class="starrequired">*</span>
					<? } ?>
<?
					if ($arUserField["FIELD_NAME"] == "UF_SCAN_ZAPROS_TP")
						echo str_ireplace(" (ТП)", "", $arUserField["EDIT_FORM_LABEL"]);
					else
						echo $arUserField["EDIT_FORM_LABEL"];
?>
				:</td>
				<td class="field-value">
				<? $APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
<?
					if($arUserField["FIELD_NAME"] == "UF_NAL_OBORUD_PERCO")
						echo '<span id="kit_dogovor" style="float:right;"><a href="/download/examples/dogovor-na-kit-nabor.doc" target="_blank" download>Договор на КИТ набор</a></span>';
					if($arUserField["FIELD_NAME"] == "UF_SCAN_ZAPROS")
						echo '<span id="zapros_a" style="float:right;"><a href="/download/examples/zapros_AS.pdf" target="_blank" download>Образец запроса</a></span>';
					if($arUserField["FIELD_NAME"] == "UF_SCAN_ZAPROS_TP")
						echo '<span id="zapros_stp" style="float:right;"><a href="/download/examples/zapros_STP.pdf" target="_blank" download>Образец запроса</a></span>';
?>
					</td>
				</tr>
<?
					if ($arUserField["FIELD_NAME"] == "UF_ZAKUPKA")
						echo '<tr id="NAKLADNAYA"><td>Загрузить файл:</td><td><label><input type="radio" name="NAKLADNAYA" value="1">Сейчас</label><br /><label><input type="radio" name="NAKLADNAYA" value="2">Потом</label><p style="color: red;">Без загрузки файла, подтверждающего объем закупок, заявка не будет рассмотрена</p></td></tr>';
				}
			}
?>
			</tbody>
		</table>
<?
			if (isset($arResult["USER_PROPERTIES"]["DATA"]["UF_TIP_SERT"]))
			{
				$color = "#CCC";
				$onclick = "";
			}
			else
			{
				$color = "#0000EE";
				$onclick = 'onclick="$(\'#dialog-form\').dialog(\'open\')"';
			}
?>
		<p id="sogbut" style="text-decoration:underline; color:<?=$color;?>; cursor:pointer" <?=$onclick;?>>Условия</p>
		<input type="submit" name="save" value="Подать заявку" disabled="disabled">
	</form>
	<div id="dialog-form" title="Условия">
		<p style="text-transform:uppercase; text-align:center; font-size: 14px;"><strong>Требования к Андминистраторам системы</strong></p>
		<ol style="font-size: 12px;">
			<li>На Вашем предприятии установлена система PERCo-S-20</li>
		</ol>
	</div>
</div>