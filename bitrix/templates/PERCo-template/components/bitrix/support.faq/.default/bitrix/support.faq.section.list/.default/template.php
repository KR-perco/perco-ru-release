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
<?//display sections?>
<div class="faq">
	<?foreach ($arResult['SECTIONS'] as $val):?>
	<?if($arParams["SECTION_ID"]==$val["ID"]) $SELECTED_ITEM = $val?>
	<?if ( $val['REAL_DEPTH'] == '0'){?>
		<div class="faq-block">
			<div class="head" >
				<a class="item_img" href="/podderzhka/faq/<?=$val["ID"];?>/" style="text-decoration: none;">
					<img alt="<?=$val["NAME"];?>" src="<?=$val["DESCRIPTION"];?>"  style="float: left"/>
					<h3 style="float: left"><?=$val["NAME"];?></h3>
				</a>
			</div>
			<ul>
				<?
				$rsParentSection = CIBlockSection::GetByID($val["ID"]);
					if ($arParentSection = $rsParentSection->GetNext())
					{
						$arFilter = array(
							'IBLOCK_ID' => $arParentSection['IBLOCK_ID'],
							'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],
							'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],
							'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']
						); // выберет потомков без учета активности
						$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
							while ($arSect = $rsSect->GetNext())
							{
								?><a href="/podderzhka/faq/<?=$val["ID"];?>/#<?=$arSect["ID"];?>"><li><?=$arSect["NAME"];?></li></a><?
							}
					}
				?>
			</ul>
		</div>
	<?}?>
	<?endforeach;?>
</div>
<!--table cellspacing="0" cellpadding="0" class="data-table" width="100%"> 	
	<tr> 		
		<td class="border-gray-body">
		< ?foreach ($arResult['SECTIONS'] as $val):?>
		< ?if($arParams["SECTION_ID"]==$val["ID"]) $SELECTED_ITEM = $val?>
			<nobr>
				<div style="padding: 2px 2px 2px < ?=17*$val['REAL_DEPTH'].'px'?>;">
					<div class="< ?=($arParams["SECTION_ID"]==$val["ID"])?'':'un'?>selected-arrow-faq"></div>
					< ?='<a href="'.$val['SECTION_PAGE_URL'].'" class="'.($arParams["SECTION_ID"]==$val["ID"]?'':'un').'selected-faq-item">'.$val['NAME'].'</a> ('.$val['ELEMENT_CNT'].')'?>
					<br clear="all">
				</div>
			</nobr>
		< ?endforeach;?>
		</td>
	</tr>
</table-->
<?if(isset($SELECTED_ITEM)):?>
<h2><?=$SELECTED_ITEM["NAME"]?></h2>
<?endif;?>