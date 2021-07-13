<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Редактирование сотрудника", "");
$APPLICATION->SetPageProperty("title", "Редактирование сотрудника");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Редактирование сотрудника");
?>
<script type="text/javascript">
$(document).ready(function() {
	if ($("#form_obuchenie_1").prop("checked"))
		$("#data_obuch").css("display", "none");
	$("[name=form_radio_obuchenie]").change(function() {
	if ($("#form_obuchenie_2").prop("checked"))
		$("#data_obuch").fadeIn('slow');
	else
		$("#data_obuch").fadeOut('slow');
	});
});
</script>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
<?
parse_str($_SERVER["QUERY_STRING"]);
$rsUser = CUser::GetByID($USER_ID);
$arUser = $rsUser->Fetch();
if ($arUser["WORK_COMPANY"] != $USER->GetID())
	echo "<p>Данный сотрудник не является сотрудником Вашей компании.</p>";
else
{
?>
	<p><a href="/client/company/">Вернуться в профиль</a></p>
	<p>Поля, отмеченные <span class="starrequired">*</span>, обязательны для заполнения.</p>
	<p>После нажатия на кнопку «Сохранить» к Вам на e-mail придет уведомление с данными по редактируемому сотруднику.</p>
<?
	if ($_POST)
	{
		if ($_POST["form_radio_obuchenie"] == 551)
			$obuchenie = "Да";
		else
		{
			$obuchenie = "Нет";
			$_POST["form_date"] = "";
		}
		$user = new CUser;
		$fields = Array(
			"NAME" => $_POST["form_imya"],
			"LAST_NAME" => $_POST["form_familiya"],
			"SECOND_NAME" => $_POST["form_otchestvo"],
			"PERSONAL_NOTES" => $obuchenie,
			"UF_DATA_OBUCH" => $_POST["form_date"],
			"WORK_POSITION" => $_POST["form_dolzhnost"],
			"WORK_COMPANY" => $_POST["ID"],
			"EMAIL" => $_POST["form_email"],
			"LOGIN" => $_POST["form_email"],
		);
		$user->Update($USER_ID, $fields);
		$strError .= $user->LAST_ERROR;
		if ($strError)
			echo '<p><font class="errortext">'.$strError.'</font></p>';
		else
		{
			$rsUserCompany = CUser::GetByID($USER->GetID());
			$arUserCompany = $rsUserCompany->Fetch();
			// отправляем данные компании
			$arEventFields = array(
				"NAME" => $_POST["form_imya"],
				"LAST_NAME" => $_POST["form_familiya"],
				"SECOND_NAME" => $_POST["form_otchestvo"],
				"PERSONAL_NOTES" => $obuchenie,
				"UF_DATA_OBUCH" => $_POST["form_date"],
				"WORK_POSITION" => $_POST["form_dolzhnost"],
				"EMAIL" => $_POST["form_email"],
				"EMAIL_TO" => $arUserCompany["EMAIL"],
				);
			CEvent::Send("EDIT_SPECIALIST", $arUserCompany["LID"], $arEventFields);
			// отправляем данные сотруднику если ФИО были изменены
			if ($arUser["LAST_NAME"] != $_POST["form_familiya"] || $arUser["NAME"] != $_POST["form_imya"] || $arUser["SECOND_NAME"] != $_POST["form_otchestvo"])
			{
				SetUserField ("USER", $arUser["ID"], "UF_SOGLASIE", "0");
				$arEventFields = array(
					"LAST_NAME" => $_POST["form_familiya"],
					"NAME" => $_POST["form_imya"],
					"SECOND_NAME" => $_POST["form_otchestvo"],
					"LOGIN" => $_POST["form_email"],
					"EMAIL_TO" => $_POST["form_email"],
					"WORK_COMPANY" => $arUserCompany["WORK_COMPANY"],
					"PASSWORD" => "не менялся"
					);
				CEvent::Send("ADD_USER_INFO", "s1", $arEventFields);
			}
			Header("Location: /client/company/", true, 301);
		}
	}
?>
	<form enctype="multipart/form-data" method="POST" action="<?$_SERVER["PHP_SELF"]?>" name="PRAVKA_SPECIALISTA">
		<table cellspacing="1" cellpadding="1" border="0"> 
			<tbody>
				<tr>
					<td>Фамилия <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td><input type="text" size="45" value="<?=$arUser["LAST_NAME"];?>" name="form_familiya" class="inputtext"></td>
				</tr>
				<tr>
					<td>Имя <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td><input type="text" size="45" value="<?=$arUser["NAME"];?>" name="form_imya" class="inputtext"></td>
				</tr>
				<tr>
					<td>Отчество <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td><input type="text" size="45" value="<?=$arUser["SECOND_NAME"];?>" name="form_otchestvo" class="inputtext"></td>
				</tr>
				<tr>
					<td>Должность <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td><input type="text" size="45" value="<?=$arUser["WORK_POSITION"];?>" name="form_dolzhnost" class="inputtext"></td>
				</tr>
				<tr>
					<td>E-mail <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td><input type="text" size="45" value="<?=$arUser["EMAIL"];?>" name="form_email" class="inputtext"></td>
				</tr>
				<tr>
					<td>Проходил очное обучение в учебном центре PERCo <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td>
						<label><input type="radio" value="550" name="form_radio_obuchenie" id="form_obuchenie_1" <?if ($arUser["PERSONAL_NOTES"] != "Да") echo 'checked';?>></label>
						<label for="form_obuchenie_1"><span class="">&nbsp;Нет</span></label><br>
						<label><input type="radio" value="551" name="form_radio_obuchenie" id="form_obuchenie_2" <?if ($arUser["PERSONAL_NOTES"] == "Да") echo 'checked';?>></label>
						<label for="form_obuchenie_2"><span class="">&nbsp;Да</span></label></td>
				</tr>
				<tr id="data_obuch" <?if ($arUser["PERSONAL_NOTES"] == "Нет") echo 'style="display: none;"'?>>
					<td>Дата обучения </td>
					<td>
<?$APPLICATION->IncludeComponent(
	'bitrix:main.calendar',
	'',
	array(
	'SHOW_INPUT' => 'Y',
	'FORM_NAME' => 'PRAVKA_SPECIALISTA',
	'INPUT_NAME' => 'form_date',
	'INPUT_VALUE' => $arUser["UF_DATA_OBUCH"],
	'SHOW_TIME' => 'N'
	),
	null,
	array('HIDE_ICONS' => 'Y')
);
?>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="submit" value="Сохранить">
	</form>
<?}?>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>