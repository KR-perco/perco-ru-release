<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "Выгрузка информации о товарах для партнеров");
$APPLICATION->SetTitle("Выгрузка информации о товарах для партнеров");

$APPLICATION->AddHeadScript("/scripts/pages/download.js");
//$APPLICATION->AddHeadString('<link href="https://'.$_SERVER["SERVER_NAME"].'/o-kompanii/video/" rel="canonical" />');
$APPLICATION->SetAdditionalCSS("/css/ostatki.css"); // подключение стилей
//$APPLICATION->SetAdditionalCSS("/css/bootstrap.min.css");
// $APPLICATION->AddHeadScript("/scripts/pages/video.js"); // подключение скриптов
?>
<script type="text/javascript" src="https://www.perco.ru/scripts/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.damnUploader.js"></script>
<script type="text/javascript" src="js/interface.js"></script>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="/scripts/lightgallery/js/lightgallery.min.js"></script>

<link rel="stylesheet" href="css/bootstrap.min.css">
<div id="main">
	<div id="banner">
		<h1>Загрузка файла с информацией об остатках</h1>
	</div>
<?
$filename = "perco.ru/podderzhka/ostatki/files/ostatki.xls";

$agent = $_SERVER['HTTP_USER_AGENT'];
preg_match("/(MSIE|Opera|Firefox|Chrome|Version)(?:\/| )([0-9.]+)/", $agent, $browser_info);
list(,$browser,$version) = $browser_info;
if ($browser == 'MSIE' && round($version) < 9)
	echo '<script language="javascript" type="text/javascript">alert("Вы используете браузер Internet Explorer версии ниже 9.0. Дальнейшая работа с сайтом не гарантируется. Рекомендуется использовать другой браузер или обновить текущий до версии 9.0 или выше");</script>';
if ($browser == 'MSIE')
{
	session_start();
	if (!isset($_SERVER['HTTP_REFERER']))
	{
		unset($_SESSION["info_files"]);
	}
	//echo"<pre>";print_r($_SESSION);echo"</pre>";
	echo '<form action="./defaultHandler.php" method="POST" enctype="multipart/form-data" onSubmit="return send();">';
	//echo '</form>';
}


if (file_exists("files/ostatki.xls")) {
?>
	<div class="copyLink">
		<p style="font-size: 18px;">Ссылка на файл для контрагентов:</p>
		<input type="text" value="<?=$filename?>" id="link">
		<button onclick="myCopytoClipboard()">Скопировать ссылку</button>
	</div>
<?
}
?>
<script>
function myCopytoClipboard() {
	var copyText = document.getElementById("link");
  
	copyText.select();

	document.execCommand("copy");
}
</script>
	<div class="span7" style="text-align: center;">
		<label for="file-field" class="btn btn-primary fileinput-button" style="height:20px;">
			<i class="icon-plus icon-white"></i>
			<span>Добавить файл</span>
			<input type="file" name="file" id="file-field" />
		</label>
		<button type="submit" class="btn btn-primary" id="upload" />
			<i class="icon-upload icon-white"></i>
			<span>Загрузить</span>
		</button>
	</div>
<?
if ($browser == 'MSIE')
{
	echo '</form>';
}
?>
	<br />
	<div class="result">
		<table class="table" id="file-list">
			<tbody class="files">
<?
			if ($browser == 'MSIE' && isset($_SESSION["info_files"]))
			{
				foreach($_SESSION["info_files"] as $value)
				{
					echo "<tr class='download'>";
					echo "<td class='name'><span>".$value["name"]."</span></td>";
					echo "<td class='size'><span>".round(($value["size"]/1024/1024), 2)." Мб</span></td>";
					echo "<td width='200'></td>";
					echo "<td width='140'>Файл загружен</td>";
					echo "</tr>";
				}
			}
?>
			</tbody>
		</table>
		<span id="complete"></span>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>