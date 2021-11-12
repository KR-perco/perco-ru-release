<style>
    div.scrollbar {
        overflow: auto;
        width: calc(100% - 20px);
    }
	.select-kronshtein {margin-block-start: 32px;}
	.image-icon {background: transparent;}
	.image_icon img {background: #e2ebfa;}
	.kronshteiny-options {display: flex; flex-wrap: wrap;}
	.kronshteiny-option {display: flex; flex-wrap: wrap; margin-block-start: 64px; margin-inline-end: 24px; max-inline-size: 820px;}
	.kronshteiny-option-name {margin-block-end: 16px; inline-size: 100%; font-size: 22px;}
	.kronshteiny-option-combination-img {margin-block-end: 16px; max-inline-size: 246px;}
	#container .kronshteiny_docs .catalog-section-list ul li.icon-style__pdf:before { 
		background-image: url("/images/icons/pdf.svg");
		/* case "pdf":
			$ico = "/images/icons/pdf.svg";
			break;
		case "dwf":
			if (LANGUAGE_ID == "ru")
				$AutoCadtitle = 'для просмотра должна быть установлена программа Autodesk DWF Viewer<br />';
			$ico = "/images/icons/dwf.svg";
			break;
		case "dwg":
			$ico = "/images/icons/dwg.svg";
			break;
		default:
			$ico = "/images/icons/download.svg";
			break; */

	}
</style>

<?
	$APPLICATION->SetAdditionalCSS('/css/kronshteiny.css');
	$APPLICATION->AddHeadScript('/scripts/pages/kronshteiny.js');
?>
<script>
	window.euro = <?= round(getCurrency("EUR")) ?>;
	window.date = '<?= date('d.m.y'); ?>';
</script>

<div class="scrollbar">
	<p>На этой странице вы можете подобрать стойки и кронштейны для крепления дополнительного оборудования, например, терминалов распознавания лиц, пирометров, алкотестеров и т.д. Для выбора воспользуйтесь фильтром.</p>
	<div class="select-kronshtein">
		<select class="select-kronshtein__turniket">
			<option>Выбрать</option>
			<option>Скоростной проход ST-01</option>
			<option>Тумбовый турникет TTD-03.1</option>
			<option>Тумбовый турникет TTD-03.2</option>
			<option>Ограждение BH02</option>
			<option>Тумбовый турникет TTD-10A</option>
			<!-- <option>Турникет-трипод TTR-11A</option> -->
			<option>Тумбовые турникеты TB01A, TBC01A</option>
			<option>Тумбовый турникет TTD-08A</option>
			<option>Электронная проходная, KT02.9, KT02.9B, KT02.9Q</option>
			<option>Электронная проходная KT05.9A, KTC01.9A</option>
			<!--option>Электронная проходная KTC01.9A</option-->
		</select>
		<select class="select-kronshtein__kronshtein">
			<option>Выбрать</option>
			<?/*<option>Контроллер Suprema BioEntry W2 (P2)</option>
			<option>Контроллер PERCo-CL15</option>
			<option>Терминал распознавания лиц “ZKTeco-FaceDepot-7A”</option>
			<option>Терминал распознавания лиц “ZKTeco-FaceDepot-7B”</option>
			<option>Терминал распознавания лиц “ZKTeco-ProFaceX”</option>
			<option>Терминал распознавания лиц “ZKTeco-SpeedFace-V5”</option>
			<option>Терминал распознавания лиц “Suprema-Face-Station2”</option>
			<option>Терминал распознавания лиц “Suprema-FaceLite”</option>
			<option>Алкотестер “Алкобарьер”</option>
			<option>Алкотестер “Динго В-02”</option>
			<option>Другое оборудование (вертикальная. площадка)</option>
			<option>Другое оборудование (горизонтальная площадка)</option>*/?>
		</select>
	</div>
	<div class="kronshteiny"></div>
	<div class="kronshteiny_docs">
	<?
		$iblocks = GetIBlockList("download", "files");
		if($arIBlock = $iblocks->Fetch())
			$block_id = $arIBlock["ID"];

		$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
				"IBLOCK_TYPE" => "download",	// Тип инфоблока
				"IBLOCK_ID" => $block_id,	// Инфоблок
				"SECTION_ID" => "",	// ID раздела
				"SECTION_CODE" => "kronshteyny",	// Код раздела
				"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
				"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
				"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
				"SECTION_FIELDS" => "",	// Поля разделов
				"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
				"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
				"CACHE_TYPE" => "A",	// Тип кеширования
				"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
				"CACHE_GROUPS" => "Y",	// Учитывать права доступа
			),
			false
		);
		?>
	</div>
</div>