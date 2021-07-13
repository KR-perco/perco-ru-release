<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CJSCore::Init(array("jquery"));
$this->addExternalJS("/scripts/mobil/catalog.js");
$page = $APPLICATION->GetCurUri();
$url = parse_url($page);
?>
<div style="display: none;"><?echo 'cur template: "NewMobileTemplate > catalog > perco_structure > bitrix > catalog.section.list"'?></div>
<script>
	app.setPageTitle({
         title: "Каталог"
      });
</script>
<?
$arFilter = Array("IBLOCK_CODE"=>"pages_".LANGUAGE_ID, "ACTIVE"=>"Y", "CODE" => $arResult["SECTION"]["CODE"]);
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_BANNER");
$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
$ar_props = $res->Fetch();
if ($ar_props["PROPERTY_BANNER_VALUE"])
	echo '<div class="width_all">
			<div class="banner_image" style="background-image: url('.$ar_props["PROPERTY_BANNER_VALUE"].');"></div>
		</div>';
?>
<div id="main_block">
	<div id="content">
		<?
		$curUrl = $_SERVER['REQUEST_URI'];
		$curUrl = explode('?', $curUrl);
		$curUrl = $curUrl[0];
		if ($curUrl == '/percoMobile/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/' || $curUrl == '/percoDemo/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/') {
		?>
			<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<? } ?>
	<?
	if ($arResult['SECTION']['NAME'] != 'Дополнительное оборудование' && $arResult['SECTION']['NAME'] != 'Система контроля доступа PERCo-Web' && $arResult['SECTION']['NAME'] != 'ПО комплексной системы безопасности PERCo-S-20' && $arResult['SECTION']['NAME'] != 'Система безопасности PERCo-S-20 Школа' && $arResult['SECTION']['NAME'] != 'Система для банкоматов PERCo-S-800') {
		if ($arResult["SECTIONS_COUNT"] > 0) {
			if ($arResult["SECTIONS_COUNT"] > 1) {
				echo '<div class="menu-wrapper"><div class="scrollmenu" id="scrollmenu">';
			
				foreach($arResult["SECTIONS"] as $section)
				{
					$rsSection = CIBlockElement::GetList(
						array(),
						array(
						"ACTIVE" => "Y",
						"CODE" => $section["CODE"]
						),
						false,
						false,
						array()
					);
					$arSection = $rsSection->Fetch();

					switch ($section["NAME"]) {
						case 'ПО комплексной системы безопасности PERCo-S-20':
							$section["NAME"] = 'Комплексная система безопасности PERCo-S-20';
							break;
						case 'ПО системы безопасности для школ PERCo-S-20 Школа':
							$section["NAME"] = 'Система безопасности PERCo-S-20 Школа';
							break;
						case 'ПО системы контроля доступа PERCo-Web':
							$section["NAME"] = 'Система контроля доступа PERCo-Web';
							break;
					}
				?>		
					<a class="item <?if (($section["NAME"] == "Турникеты-триподы") || ($section["NAME"] == "Контроллеры") || ($section["NAME"] == "Система контроля доступа PERCo-Web") || ($section["NAME"] == "Комплексная система безопасности PERCo-S-20") || ($section["NAME"] == "Система безопасности PERCo-S-20 Школа")) echo "active";?>" data-filter="<?=$section["CODE"]?>"><?=$section["NAME"];?></a>
				<?
					
				}
			}

			if ($arResult["ELEMENTS"]){
				foreach($arResult["ELEMENTS"] as $element)
				{
					?>
					<a class="item" data-filter="<?=$element["CODE"]?>"><?=$element["NAME"];?></a>
					<?
				}
			}
			
			if ($curUrl != '/percoMobile/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/' && $curUrl != '/percoDemo/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/') {
			
				echo '</div></div><div class="section-list">';

				foreach($arResult["SECTIONS"] as $section)
				{
					$arr = Array("IBLOCK_ID"=> "60", "SECTION_ID"=> $section["ID"]);
					$sectionCount = CIBlockSection::GetCount($arr);
					if($sectionCount > 0 && $section["CODE"] != "identifikatory"){
						?><div class="section <?if (($section["NAME"] == "ПО системы контроля доступа PERCo-Web") || ($section["NAME"] == "ПО комплексной системы безопасности PERCo-S-20") || ($section["NAME"] == "ПО системы безопасности для школ PERCo-S-20 Школа")) echo "active";?>" id="<?=$section["CODE"]?>" data-cat="<?=$section["CODE"]?>"><?
						
						$rsParentSection = CIBlockSection::GetByID($section["ID"]);
						if ($arParentSection = $rsParentSection->GetNext())
						{
							$arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],
											  '>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
											  '<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
											  '>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
							$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
							while ($arSect = $rsSect->GetNext())
							{
								
								?>
								
									<div class="element">
										<a href="/percoDemo/products/<?=$arSect["CODE"]?>/">
											<img src="/images/products/po/<?=$arSect["CODE"]?>.jpg" alt="<?=$arSect["NAME"]?>">
											<h3>333<?=$arSect["NAME"]?></h3>
										</a>
									</div>
								
								<?
							}
						}
						if ($arResult["SECTION"]["CODE"] == "kompleksnaya-sistema-bezopasnosti-perco-s-20")
						{
							?>
								
								<div class="element">
									<a href="/percoDemo/products/kontrollery-schityvateli/">
										<img alt="Контроллеры" src="/images/products/controllers/controllers.jpg">
										<h3>Оборудование</h3>
									</a>
								</div>
							
							<?
						}
						?></div><?
					}else{
						?><div class="section <?if (($section["NAME"] == "Турникеты-триподы") || ($section["NAME"] == "Контроллеры") || ($section["NAME"] == "ПО системы контроля доступа PERCo-Web") || ($section["NAME"] == "ПО системы безопасности для школ PERCo-S-20 Школа")) echo "active";?>" id="<?=$section["CODE"]?>" data-cat="<?=$section["CODE"]?>"><?
						$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "PREVIEW_TEXT", "PROPERTY_IMAGE_PREVIEW", "PROPERTY_IMAGE", "PROPERTY_IMAGE_SPECIFICATIONS", "PROPERTY_TEXT");
						$arFilter = Array("IBLOCK_ID" => "60", 
										"SECTION_ID"=> $section[ID], 
										"ACTIVE_DATE"=>"Y", 
										"ACTIVE"=>"Y");
						$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array(), $arSelect);
						
						while($ob = $res->GetNextElement())
						{

							$arFields = $ob->GetFields();
							$arPropFields = $ob->GetProperties();
							?>
							
								<div class="element">
									<a href="/percoDemo/products/<?=$arFields["CODE"];?>.php#<?=$url["query"]?>">
										<img src="<?=$arFields["PROPERTY_IMAGE_PREVIEW_VALUE"]?>" alt="<?=$arFields["NAME"]?>">
										<h3><?=$arFields["NAME"]?></h3>
										<p><?=$arPropFields["DOP_NAME"]["VALUE"]?></p>
									</a>
								</div>
							
							<?
						}
						if ($arResult["SECTION"]["CODE"] == "sistema-kontrolya-dostupa-perco-web")
						{
							?>
								
								<div class="element">
									<a href="/percoDemo/products/kontrollery-schityvateli/">
										<img alt="Контроллеры" src="/images/products/controllers/controllers.jpg">
										<h3>Оборудование</h3>
									</a>
								</div>
							
							<?
						}
						if ($section["CODE"] == "identifikatory")
						{
							?>
								
								<div class="element">
									<a href="/percoDemo/products/karty-dostupa/">
										<img alt="Бесконтактные карты доступа" src="/images/products/controllers/card_small.jpg">
										<h3>Бесконтактные карты доступа</h3>
									</a>
								</div>
							
							<?
						}
						if ($arResult["SECTION"]["CODE"] == "kontrollery-schityvateli")
						{
							$content = '';
							$arFilter = Array("IBLOCK_CODE"=>"pages_".LANGUAGE_ID, "ACTIVE"=>"Y", "CODE" => $section["CODE"]);
							$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "TIMESTAMP_X", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_*");
							$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
							if (intval($res->SelectedRowsCount()) > 0)
							{
								$ob = $res->GetNextElement();
								$arFields = $ob->GetFields();

								if ($arFields["PREVIEW_TEXT"])
									$content .= '<div class="preview_text">'.$arFields["PREVIEW_TEXT"].'</div>';

								if (($arFields["DETAIL_TEXT"]) && ($url['query'] != "installer"))
									$content .= '<div  class="detail_text">'.$arFields["DETAIL_TEXT"].'</div>';
							

								echo $content;
							}
						}
						?></div><?
					}

					
				
				}
				if ($arResult["ELEMENTS"]){
					foreach($arResult["ELEMENTS"] as $element)
					{
						
						$rsImage = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"IMAGE_PREVIEW"));
						$arImage = $rsImage->Fetch();
						$rsDopname = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"DOP_NAME"));
						$arDopname = $rsDopname->Fetch();
					?>
						<div class="section" id="<?=$element["CODE"]?>" data-cat="<?=$element["CODE"]?>">
							<div class="element">
								<a href="/percoDemo/products/<?=$element["CODE"];?>.php">
								
									<img alt="<?=$element["NAME"];?>" src="<?=$arImage["VALUE"];?>" />
									<h3><?=$element["NAME"]?></h3>
									<p><?=$arDopname["VALUE"];?></p>
								</a>
							</div>
						</div>
					<?
					}
				}


				echo '</div>';
			}

		}else{
			if($arResult["SECTION"]["NAME"] == "Система для банкоматов PERCo-S-800"){
				?>
				<?/*<div class="menu-wrapper">
					<div class="scrollmenu" id="scrollmenu">
						<a class="item active" data-filter="<?=$arResult["SECTION"]["CODE"]?>"><?=$arResult["SECTION"]["NAME"];?></a>
					</div>
				</div>*/?>
				<?
			}
			echo '<div class="section">';
			foreach($arResult["ELEMENTS"] as $element)
			{
				
				$rsImage = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"IMAGE_PREVIEW"));
				$arImage = $rsImage->Fetch();
				$rsDopname = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"DOP_NAME"));
				$arDopname = $rsDopname->Fetch();
			?>
				<div class="element">
					<a href="/percoDemo/products/<?=$element["CODE"];?>.php">
					
						<img alt="<?=$element["NAME"];?>" src="<?=$arImage["VALUE"];?>" />
						<h3><?=$element["NAME"]?></h3>
						<p><?=$arDopname["VALUE"];?></p>
					</a>
				</div>
			<?
			}
			echo "</div>";
		}
	} else if ($arResult['SECTION']['NAME'] == 'Дополнительное оборудование') { ?>
		<div class="section active">
			<div class="element">
				<a href="<?= $arResult["SECTIONS"][0]["SECTION_PAGE_URL"] ?>">
					<img src="/images/products/beskontaktnye-karty-dostupa/cards.jpg" alt="<?= $arResult["SECTIONS"][0]["NAME"] ?>">
					<h3><?= $arResult["SECTIONS"][0]["NAME"] ?></h3>
					<p></p>
				</a>
			</div>
			<div class="element">
				<a href="<?= $arResult["SECTIONS"][1]["SECTION_PAGE_URL"] ?>">
					<img src="/images/products/bloki-pitaniya/all.jpg" alt="<?= $arResult["SECTIONS"][1]["NAME"] ?>">
					<h3><?= $arResult["SECTIONS"][1]["NAME"] ?></h3>
					<p></p>
				</a>
			</div>
			<?foreach($arResult['ELEMENTS'] as $elem) { ?>
				<div class="element">
				<?
				$rsImage = CIBlockElement::GetProperty($arResult['SECTION']['IBLOCK_ID'], $elem['ID'], array("sort" => "asc"), Array("CODE"=>"IMAGE_PREVIEW"));
				$arImage = $rsImage->Fetch();
				?>
					<a href="/percoDemo<?= $elem["DETAIL_PAGE_URL"] ?>">
						<img src="<?= $arImage['VALUE'] ?>" alt="<?= $elem["NAME"] ?>">
						<h3><?= $elem["NAME"] ?></h3>
						<p></p>
					</a>
				</div>
			<? } ?>
		</div>
	<? }/* else if ($arResult['SECTION']['NAME'] == 'Система контроля доступа PERCo-Web') { ?>
		<h2 class="perco-web">Система контроля доступа<br><b>PERCo-Web</b></h2>
		<div class="width_all">
			<div class="banner_image" style="background-image: url(/images/banners/perco-web-new.jpg);"></div>
		</div>
	<? }*/ else if ($arResult['SECTION']['NAME'] == 'ПО комплексной системы безопасности PERCo-S-20') { ?>
		<div class="section active">
			<div class="element">
				<a href="<?= $arResult["SECTIONS"][0]["SECTION_PAGE_URL"] ?>">
					<img src="bxlocal://lokalnoe-po.jpg" alt="<?= $arResult["SECTIONS"][0]["NAME"] ?>">
					<h3><?= $arResult["SECTIONS"][0]["NAME"] ?></h3>
					<p></p>
				</a>
			</div>
			<div class="element">
				<a href="<?= $arResult["SECTIONS"][1]["SECTION_PAGE_URL"] ?>">
					<img src="bxlocal://setevoe-po.jpg" alt="<?= $arResult["SECTIONS"][1]["NAME"] ?>">
					<h3><?= $arResult["SECTIONS"][1]["NAME"] ?></h3>
					<p></p>
				</a>
			</div>
			<div class="element">
				<a href="<?= $arResult["SECTIONS"][2]["SECTION_PAGE_URL"] ?>">
					<img src="bxlocal://komplekty-po.jpg" alt="<?= $arResult["SECTIONS"][2]["NAME"] ?>">
					<h3><?= $arResult["SECTIONS"][2]["NAME"] ?></h3>
					<p></p>
				</a>
			</div>
		</div>
	<? } else if ($arResult['SECTION']['NAME'] == 'Система безопасности PERCo-S-20 Школа') { ?>
		<h1>Система безопасности PERCo-S-20 Школа</h1>
	<? } else if ($arResult['SECTION']['NAME'] == 'Система для банкоматов PERCo-S-800') { ?>
		<h1>Система для банкоматов PERCo-S-800</h1>
	<? } ?>