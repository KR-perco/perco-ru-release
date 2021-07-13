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
<?foreach ($arResult['ITEMS'] as $key=>$val):?>
	<div class="element-question <?=$val['IBLOCK_SECTION_ID']?>" id="<?=$val['IBLOCK_SECTION_ID']?>" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
		<div class="question">
			<p itemprop="name">
				<?=$val['NAME']?>
			</p>
		</div>
		<div class="answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
			<p itemprop="text">
				<?=$val['PREVIEW_TEXT']?>
			</p>
			<p>
				<?=$val['DETAIL_TEXT']?>
			</p>
		</div>
	</div>
<?endforeach;?>