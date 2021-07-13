<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Сотрудники", "");
$APPLICATION->SetPageProperty("title", "Сотрудники");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Сотрудники");
?>
<div id="textBlcok"> 
	<h1> <?$APPLICATION->ShowTitle(false, false)?></h1>
<?
$COMPANY_ID = htmlspecialcharsbx(strip_tags(trim($_GET["COMPANY_ID"])));
$rsCompany = CUser::GetByID($COMPANY_ID);
$arCompany = $rsCompany->Fetch();
echo '<p><a href="/client/uchitelskaya/company/">Вернуться к выбору компании</a></p>';
echo '<p>Компания: '.$arCompany["WORK_COMPANY"].'</p>';
?>
	<table class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td>ФИО</td>
				<td>E-mail</td>
				<td>Очное обучение</td>
				<td>Дата обучения</td>
				<td>Подтверждение очного обучения</td>
			</tr>
		</thead>
		<tbody>
<?
$filter = Array
(
	"ACTIVE" => "Y",
	"WORK_COMPANY" => $COMPANY_ID,
	"WORK_COMPANY_EXACT_MATCH" => "Y"
);
$arParameters = Array
(
	"SELECT" => array("UF_DATA_OBUCH")
);
$rsUsers = CUser::GetList($by="id", $order="desc", $filter, $arParameters); // выбираем пользователей

while($arUser = $rsUsers->Fetch())
{
	echo "<tr><td>".$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]."</td>";
	echo "<td>".$arUser["EMAIL"]."</td>";
	echo "<td>".$arUser["PERSONAL_NOTES"]."</td><td>".$arUser["UF_DATA_OBUCH"]."</td><td>";
	if ($arUser["UF_DATA_OBUCH"])
	{
		if($_GET["obuch"] == 1 && $_GET["USER_ID"] == $arUser["ID"])
		{
			$user = new CUser;
			$user->Update($arUser["ID"], array("WORK_NOTES" => "Подтверждено"));
			echo "Подтверждено";
			// Проверка от дурака, чтобы не подавали заявку 2й раз на эту же дату, проверка по e-mail
			$rs = CIBlockElement::GetList(
				array(), 
				array(
				"IBLOCK_ID" => 54,
				"PROPERTY_UID" => $arUser["ID"]
				),
				false, 
				false,
				array("ID", "PROPERTY_UID", "PROPERTY_SEMINAR_DATE")
			);
			$seminar = false;
			while($ar = $rs->GetNext())
			{
				if ($ar["PROPERTY_SEMINAR_DATE_VALUE"] == $arUser["UF_DATA_OBUCH"])
				{
					$seminar = true;
					break;
				}
			}
			if (!$seminar)
			{
				$masFields = array(
					"ACTIVE" => "Y", 
					"IBLOCK_ID" => 54,
					"NAME" => $arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"],
					"PROPERTY_VALUES" => array(
						"UID" => $arUser["ID"],
						"LAST_NAME" => $arUser["LAST_NAME"],
						"NAME" => $arUser["NAME"],
						"PATRONYMIC_NAME" => $arUser["SECOND_NAME"],
						"WORK_POSITION" => $arUser["WORK_POSITION"],
						"EMAIL" => $arUser["EMAIL"],
						"COMPANY" => $arCompany["WORK_COMPANY"],
						"CITY" => $arCompany["WORK_CITY"],
						"SEMINAR" => "",
						"SEMINAR_DATE" => $arUser["UF_DATA_OBUCH"],
						"APPLICANT" => "Партнер",
						"CONFIRM_TRAINING" => array("VALUE" => 85)
					)
				);
				$oElement = new CIBlockElement();
				$idElement = $oElement->Add($masFields);
			}
		}
		else
		{
			if ($arUser["WORK_NOTES"] == "Подтверждено")
				echo "Подтверждено";
			else
				echo '<a href="?COMPANY_ID='.$COMPANY_ID.'&USER_ID='.$arUser["ID"].'&obuch=1">Подтвердить</a>';
		}
	}
	echo "</td></tr>";
}
?>
		</tbody>
	</table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>