<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div id="download_zip">
<form id="getExport" name="Tree" action="ziped_data.php" method="POST">
	<div class="blocks">
		<div>
		<h3>Seleccionar productos:</h3>
		<fieldset class="head">
		<?
		$arFilter = array('ACTIVE'=>'Y', 'IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'GLOBAL_ACTIVE'=>'Y');
		$arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'CODE', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID');
		$arOrder = array('DEPTH_LEVEL'=>'ASC', 'SORT'=>'ASC');
		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
		$sectionLinc = array();
		$arResult['ROOT'] = array();
		$sectionLinc[0] = &$arResult['ROOT'];
		while($arSection = $rsSections->GetNext()) {
			$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
			$sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
		}
		unset($sectionLinc);

		function outTrees($arr) {
			foreach ($arr as $item){
				$indent = " style='margin-left:" . ($item['DEPTH_LEVEL']  * 25) . "px'";
				echo "<label ". $indent ." class='container'>" . $item["NAME"] . "
							<input type='checkbox' name='product[]' value='". $item["CODE"] ."'>
							<span class='checkmark'></span>
					</label>";
				if (count($item['CHILD']) > 0){
					echo "<fieldset>";
					outTrees($item['CHILD']);
					echo "</fieldset>";
				}
			}
		}

		outTrees($arResult['ROOT']['CHILD']);
		?>
		</fieldset>
		</div>
		<div>
			<h3>Seleccionar los campos requeridos:</h3>
			<label class="container">Anuncio
				<input type="checkbox" name="fields[]" value="anouns" checked="checked">
				<span class="checkmark"></span>
			</label>
			<label class="container">Descripción
				<input type="checkbox" name="fields[]" value="description">
				<span class="checkmark"></span>
			</label>

			<?/*<label class="container">Price
				<input type="checkbox" name="fields[]" value="cost">
				<span class="checkmark"></span>
			</label>*/?>

			<label class="container">Características
				<input type="checkbox" name="fields[]" value="characteristics">
				<span class="checkmark"></span>
			</label>

			<label class="container">Foto
				<input type="checkbox" name="fields[]" value="photo">
				<span class="checkmark"></span>
			</label>

			<label class="container">Esquema
				<input type="checkbox" name="fields[]" value="sheme">
				<span class="checkmark"></span>
			</label>

			<label class="container">Documentos
				<input type="checkbox" name="fields[]" value="docs">
				<span class="checkmark"></span>
			</label>
			<div class="xls-check">	
				<label class="container">Es necesario archivo xls para MS Excel
					<input type="checkbox" name="excel" value="true">
					<span class="checkmark"></span>
				</label>
			</div>
			<div class="act">
				<input type="submit" value="Recoger datos">
				<div id="loader-text">Please wait. Data collection may take some time.</div>
				<div id="loader"></div>
			</div>
			<div id="form_back"></div>
		</div>	
	</div>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$('#getExport').submit(function() {
			$('#loader').show();
			$('#loader-text').show();
			$('#loader-error').hide();
			$('#form_result').hide();
			return true;
		});
	});
  </script>
</form>
</div>
