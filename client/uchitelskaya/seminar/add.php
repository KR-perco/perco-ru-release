<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Добавление семинара", "");
$APPLICATION->SetPageProperty("title", "Добавление семинара");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Добавление семинара");

if (stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/seminar/") === false)
	Header("Location: /client/uchitelskaya/seminar/", true, 301);

$arFilter = array("ID"=>$ID, "IBLOCK_ID"=>62);
$arSelect = array("ID", "IBLOCK_ID", "DETAIL_TEXT", "PROPERTY_TOPIC", "PROPERTY_TYPE_SEMINAR");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
$arRes = $res->Fetch();

$ID_EXT = "";
switch($arRes["PROPERTY_TYPE_SEMINAR_VALUE"])
{
	case "Вебинар":
		$SECTION_ID = 1532;
		$ID_EXT = "";
		break;
	case "В учебном центре":
		$SECTION_ID = 1533;
		break;
	case "Выездной":
		$SECTION_ID = 1531;
		break;
}
?>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p><a href="./">Вернуться к списку семинаров</a></p>
<?
if (isset($_POST) && count($_POST) > 0 && $ID > 0)
{
	// Проверка от дурака, чтобы не подавали заявку 2й раз на эту же дату, проверка по e-mail
	$rs = CIBlockElement::GetList(
		array(), 
		array(
		"IBLOCK_ID" => 46,
		"DATE_ACTIVE_TO" => $_POST["DATE"],
		"PROPERTY_SEMINAR" => $ID,
		),
		false, 
		false,
		array("ID")
	);
	if (intval($rs->SelectedRowsCount()) == 0)
	{
		// Обращение к webinar.ru и создание семинара
		/*if ($arRes["PROPERTY_TYPE_SEMINAR_VALUE"] == "Вебинар")
		{
			$datetime = strtotime($_POST["DATE"]);
			//$datetime = mktime(date("H", $tmpDate)+3, date("i", $tmpDate), 0, date("m", $tmpDate), date("d", $tmpDate), date("Y",$tmpDate));
			$apiKey = "339a894d615ea324b47af4e7e3991a3b";
			$data = array(
				"name" => $arRes["PROPERTY_TOPIC_VALUE"],
				"description" => $arRes["DETAIL_TEXT"],
				"access" => "6",
				"status" => "ACTIVE",
				"startsAt" => array(
					"date" => array(
						"year" => (int)date("Y",$datetime),
						"month" => (int)date("m", $datetime),
						"day" => (int)date("d", $datetime),
					),
					"time" => array(
						"hour" => (int)date("H", $datetime),
						"minute" => (int)date("i", $datetime),
					)
				)
			);
			$headers = array(
				'Content-Type: application/x-www-form-urlencoded',
				'x-auth-token: '.$apiKey,
			);
			$ch = curl_init("https://userapi.webinar.ru/v3/events");
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$res_webinar = curl_exec($ch);
			curl_close($ch);
			$res_webinar = json_decode($res_webinar);
			$ID_EXT = $res_webinar->eventId;

			// сессия на семинар
			$ch = curl_init("https://userapi.webinar.ru/v3/events/".$ID_EXT."/sessions");
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			$res_webinar = curl_exec($ch);
			curl_close($ch);
			$res_webinar = json_decode($res_webinar);
			echo $res_webinar->link;
		}*/
		$arFields = array(
			"ACTIVE" => "Y", 
			"IBLOCK_ID" => 46,
			"NAME" => $arRes["PROPERTY_TOPIC_VALUE"],
			"DATE_ACTIVE_TO" => $_POST["DATE"],
			"IBLOCK_SECTION_ID" => $SECTION_ID,
			"PROPERTY_VALUES" => array(
				"SEMINAR" => $ID,
				"ID_EXT" => $ID_EXT,
				"YOUTUBE" => $YOUTUBE
			)
		);
		$oElement = new CIBlockElement();
		if ($idElement = $oElement->Add($arFields))
			echo '<p style="color: green;">Семинар установлен</p>';
	}
	else
		echo '<p style="color: red;">Семинар на эту дату уже установлен</p>';
}
?>
	<form name="seminar_form" method="post" action="<?=$_SERVER["REQUEST_URI"];?>">
		<table>
			<tr>
				<td width="170">Название</td>
				<td><?=$arRes["PROPERTY_TOPIC_VALUE"];?></td>
			</tr>
			<tr>
				<td width="170">Дата начала</td>
				<td>
<?$APPLICATION->IncludeComponent("bitrix:main.calendar","",Array(
	"SHOW_INPUT" => "Y",
	"FORM_NAME" => "",
	"INPUT_NAME" => "DATE",
	"INPUT_VALUE" => "",
	"SHOW_TIME" => "Y",
	)
);?>
				</td>
			</tr>
			<tr>
				<td width="170">Ссылка на youtube</td>
				<td><input type="text" id="YOUTUBE" name="YOUTUBE" value=""></td>
			</tr>
		</table>
		<input type="submit" value="Сохранить" name="save">
	</form>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>