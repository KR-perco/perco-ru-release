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
<div class="left">
	<?$rsParentSection = CIBlockSection::GetByID($val["ID"]);
		if ($arParentSection = $rsParentSection->GetNext())
			
		{
			$arFilter = array(
				'IBLOCK_ID' => $arParentSection['IBLOCK_ID'],
				'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
				'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
				'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
			);
			$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
			$arSect = $rsSect->GetNext();
		}
	?>
	<div class="questions">
		<ul>
			<h3><a href="/podderzhka/faq/<?=$arSect["ID"];?>/"><?=$arSect["NAME"];?></a></h3>
			<li class="que">
				<ul>
					<?foreach ($arResult['ITEMS'] as $key=>$val):?>
						<li class="point-faq"><a href="#<?=$val["ID"]?>"><?=$val['NAME']?></a><br/></li>
					<?endforeach;?>
				</ul>
			</li>
		</ul>
	</div>
</div>