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
	<ul style="margin-top: 0px;">
		<?foreach ($arResult['ITEMS'] as $key=>$val):?>
			<li id="que_<?=$val["ID"]?>" class="point-faq"><a href="#ans_<?=$val["ID"]?>"><?=$val['NAME']?></a><br/></li>
		<?endforeach;?>
	</ul>
</div>