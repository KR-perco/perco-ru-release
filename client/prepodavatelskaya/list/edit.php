<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Редактирование специалиста", "");
$APPLICATION->SetPageProperty("title", "Редактирование специалиста");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Редактирование специалиста");
?>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
<?
parse_str($_SERVER["QUERY_STRING"]);
$rsUser = CUser::GetByID($USER_ID);
$arUser = $rsUser->Fetch();
if ($arUser["WORK_COMPANY"] != $USER->GetID())
	echo "Данный студент не обучается в Вашем ВУЗе.";
else
{
?>
	<p><a href="/client/prepodavatelskaya/list/">Вернуться к списку студентов</a></p>
	<p>Поля, отмеченные <span class="starrequired">*</span>, обязательны для заполнения.</p>
	<p>После нажатия на кнопку «Сохранить» к Вам на e-mail придет уведомление с данными по редактируемому студенту.</p>
<?
	if ($_POST)
	{
		$pasw = gen_pasw();
		$user = new CUser;
		$fields = Array(
			"NAME" => $_POST["form_imya"],
			"LAST_NAME" => $_POST["form_familiya"],
			"SECOND_NAME" => $_POST["form_otchestvo"],
			"UF_N_GROUP" => $_POST["form_n_group"],
			"WORK_COMPANY" => $_POST["ID"],
			"EMAIL" => $_POST["form_email"],
			"LOGIN" => $_POST["form_email"],
			"PASSWORD" => $pasw,
		);
		$user->Update($USER_ID, $fields);
		$strError .= $user->LAST_ERROR;
		if ($strError)
			echo '<p><font class="errortext">'.$strError.'</font></p>';
		else
		{
			$rsUserPrepod = CUser::GetByID($USER->GetID());
			$arUserPrepod = $rsUserPrepod->Fetch();
			$arEventFields = array(
				"NAME" => $_POST["form_imya"],
				"LAST_NAME" => $_POST["form_familiya"],
				"SECOND_NAME" => $_POST["form_otchestvo"],
				"UF_N_GROUP" => $_POST["form_n_group"],
				"EMAIL" => $_POST["form_email"],
				"PASSWORD" => $pasw,
				"EMAIL_TO" => $arUserPrepod["EMAIL"],
				);
			CEvent::Send("EDIT_STUDENT", $arUserPrepod["LID"], $arEventFields);
			Header("Location: /client/prepodavatelskaya/list/", true, 301);
		}
	}
?>
	<form enctype="multipart/form-data" method="POST" action="<?$_SERVER["PHP_SELF"]?>" name="PRAVKA_STUDENTA">
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
					<td>№ группы <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td><input type="text" size="45" value="<?=$arUser["UF_N_GROUP"];?>" name="form_n_group" class="inputtext"></td>
				</tr>
				<tr>
					<td>E-mail <font color="red"><span class="form-required starrequired">*</span></font></td>
					<td><input type="text" size="45" value="<?=$arUser["EMAIL"];?>" name="form_email" class="inputtext"></td>
				</tr>
			</tbody>
		</table>
		<input type="submit" value="Сохранить">
	</form>
<?}?>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>