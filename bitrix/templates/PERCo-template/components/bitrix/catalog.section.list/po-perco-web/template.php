<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<!--div class="box-for-buttons">
	<div class="block-btn block-btn-po">
		<a class="btn" href="/download/soft/rus/SetupPERCoWeb.zip"
			onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/SetupPERCoWeb.zip-ga'});"><i
				class="download-icon"
				style="background-image: url(/images/icons/windows-04-01-01.svg);"></i>СКАЧАТЬ ПО
			Windows</a>
		<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (297,04&nbsp;MB)&nbsp; —
				03.02.2020</span></p>
	</div>
	<div class="block-btn block-btn-po">
		<a class="btn" href="/download/soft/rus/debian_packages.zip"
			onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/debian_packages.zip-ga'});">
			<i class="download-icon"
				style="background-image: url(/images/icons/Logo-ubuntu_cof-orange-hex.svg);"></i>СКАЧАТЬ ПО
			Debian linux</a>
		<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (313,6&nbsp;MB)&nbsp; —
				03.02.2020</span></p>
	</div>
	<div class="block-btn block-btn-po">
		<a class="btn" href="/download/soft/rus/fedora_packages.zip"
			onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/fedora_packages.zip-ga'});"><i
				class="download-icon"
				style="background-image: url(/images/icons/Fedora-logo_20x20-01.svg);"></i>СКАЧАТЬ ПО Fedora
			linux</a>
		<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (359,92&nbsp;MB)&nbsp; —
				03.02.2020</span></p>
	</div>
	<div class="block-btn block-btn-po">
		<a class="btn" href="/download/soft/rus/altlinux_packages.zip"
			onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/altlinux_packages.zip-ga'});"><i
				class="download-icon"
				style="background-image: url(/images/icons/alt_linux-01_20x20.svg);"></i>СКАЧАТЬ ПО Alt
			linux</a>
		<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (318,37&nbsp;MB)&nbsp; —
				03.02.2020</span></p>
	</div>
</div-->
<div class="box-for-buttons">
<?
$names = [
	'СКАЧАТЬ ПО Windows',
	'СКАЧАТЬ ПО Debian linux',
	'СКАЧАТЬ ПО Fedora linux',
	'СКАЧАТЬ ПО Alt linux',
	'СКАЧАТЬ ПО ROSA Enterprise Linux Server',
	'СКАЧАТЬ ПО ROSA Enterprise Desktop'
];
$iconLinks = [
	'/images/icons/windows-04-01-01.svg',
	'/images/icons/Logo-ubuntu_cof-orange-hex.svg',
	'/images/icons/Fedora-logo_20x20-01.svg',
	'/images/icons/alt_linux-01_20x20.svg',
	'/images/icons/rosa.svg',
	'/images/icons/rosa.svg'
];
$rs = CIBlockElement::GetList(
	["SORT"=>"ASC"], 
	[
		"ACTIVE" => "Y",
		"IBLOCK_ID" => $arResult['SECTION']["IBLOCK_ID"],
		"SECTION_ID" => $arResult['SECTION']['ID']
	]
);
if (intval($rs->SelectedRowsCount()) > 0) {
	$i = 0;
	while($item = $rs->GetNextElement()) {
		$fields = $item->GetFields();
		$props = $item->GetProperties();
		?>
		<div class="block-btn block-btn-po">
			<a class="btn" href="<?= $props['FILE']['VALUE'][0] ?>" onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '<?= $props['FILE']['VALUE'][0] ?>'});">
				<i class="download-icon" style="background-image: url(<?= $iconLinks[$i] ?>);"></i>
				<?= $names[$i] ?>
			</a>
			<p>
				<span class="color" style="font-size:15px;">версия <?= $props['INSTAL_VERSION']['VALUE'] ?> (<?= round(filesize('/home/d/dc178435/public_html'.$props['FILE']['VALUE'][0]) / 1048576, 2) ?>&nbsp;MB)&nbsp; — <?=date('d.m.Y', filemtime('/home/d/dc178435/public_html'.$props['FILE']['VALUE'][0]));?></span>
			</p>
		</div>
		<?
		$i++;
	}
}
?>
</div>

<?/*switch(LANGUAGE_ID)
{
	case "en":
		$alt_lang = "_ENG";
		break;
	case "de":
		$alt_lang = "_DEU";
		break;
	case "fr":
		$alt_lang = "_FRA";
		break;
	case "it":
		$alt_lang = "_ITA";
		break;
	case "es":
		$alt_lang = "_ESP";
		break;
}
if (!function_exists("getElements"))
{
	function getElements($iblock_id, $section_id, $archive, $with_image)
	{
		if ($archive)
			$archive = "!PROPERTY_ARCHIVE";
		else
			$archive = "PROPERTY_ARCHIVE";
		$rs = CIBlockElement::GetList(
			array("SORT"=>"ASC"), 
			array(
				"ACTIVE" => "Y",
				"IBLOCK_ID" => $iblock_id,
				"SECTION_ID" => $section_id,
				$archive => false
			)
		);
		if (intval($rs->SelectedRowsCount()) > 0)
		{
			$version = "";
			$list_files = "";
			while($ar = $rs->GetNextElement())
			{
				$arFields = $ar->GetFields();
				$arProps = $ar->GetProperties();
				if (is_array($arProps["FILE"]["DESCRIPTION"]))
				{
					$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
					$keyFile = array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]);
					$keyImage = array_search(LANGUAGE_ID, $arProps["IMAGE"]["DESCRIPTION"]);
					$name = $arProps["NAME"]["VALUE"][$keyName];
					$file = $arProps["FILE"]["VALUE"][$keyFile];
					$image = $arProps["IMAGE"]["VALUE"][$keyImage];
					if ($keyFile === false)
						continue;
				}
				else
				{
					$name = $arProps["NAME"]["VALUE"];
					$file = $arProps["FILE"]["VALUE"];
				}
				$fSize = '('.printFileInfo($file, "size").')&nbsp;';
				if ($arPropDown["INSTAL_TIME"]["VALUE"])
					$date = $arPropDown["INSTAL_TIME"]["VALUE"];
				else
					$date = printFileInfo($file, "date");
				if ($arProps["INSTAL_VERSION"]["VALUE"] && LANGUAGE_ID == "ru")
					$version = ", версия ".$arProps["INSTAL_VERSION"]["VALUE"];
				$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
				if ($with_image == "Y")
					$list_files .= '<div class="element_item"><div><img alt="'.$name.'" src="'.$image.'"></div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.'</a><div class="color">'.$fSize.' — '.$date.'</div></div>';
				else
					$list_files .= '<li><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.$version.'</a> <span class="color">'.$fSize.' — '.$date.'</span></li>';
			}
			if(!empty($list_files)){
				if ($with_image == "Y")
					echo '<div class="elements_list">'.$list_files.'</div>';
				else
					echo "<ul>".$list_files."</ul>";
			}
		}
	}
}
?>
<div class="catalog-section-list">
<?
$name = "";
$archive = $_REQUEST["archive"];
if ($arResult["SECTIONS_COUNT"] > 0)
{
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;
	foreach($arResult["SECTIONS"] as $arSection)
	{
		$name = "";
		if (LANGUAGE_ID == "ru")
			$name = $arSection["NAME"];
		if (LANGUAGE_ID == "en" && ($arSection["NAME"] == "Примеры реализованных проектов" || $arSection["NAME"] == "Каталоги"))
			$name = $arSection["UF_LANG".$alt_lang];
		if ((!$arSection["UF_ARCHIVE"] && !$archive) || ($arSection["UF_ARCHIVE"] && $archive))
		{
			if($name != "Примеры реализованных проектов"){
				if (($arParams["WITH_IMAGE"] == "Y") && ($name))
					echo "<h2>".$name."</h2>";
				else
				{
					if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
						echo "<dl>";
					elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
						echo "</dt>";
					else
					{
						while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
						{
							echo "</dt>";
							echo "</dl>";
							$CURRENT_DEPTH--;
						}
						echo "</dt>";
					}
					echo "<dt>".$name;
				}
			}
			getElements($arSection["IBLOCK_ID"], $arSection["ID"], $archive, $arParams["WITH_IMAGE"]);
			$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
		}
	}
	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</dt></dl>";
		$CURRENT_DEPTH--;
	}
}
elseif ($arResult["SECTION"]["ID"] != 0)
{
	if (LANGUAGE_ID == "ru")
		$name = $arSection["SECTION"]["NAME"];
	else
		$name = $arResult["SECTION"]["UF_LANG".$alt_lang];
	if ($arParams["PARENT_NAME"] != "N")
	{
		if ($arParams["WITH_IMAGE"] == "Y")
			echo "<h2>".$name."</h2>";
		else
			echo $name;
	}
	getElements($arResult["SECTION"]["IBLOCK_ID"], $arResult["SECTION"]["ID"], $archive, $arParams["WITH_IMAGE"]);
}
?>
</div>*/?>
