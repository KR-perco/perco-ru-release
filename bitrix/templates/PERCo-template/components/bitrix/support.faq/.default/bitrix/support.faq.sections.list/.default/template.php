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
#$APPLICATION->SetPageProperty('title', $APPLICATION->GetTitle().' '.$val["NAME"]);
#$APPLICATION->SetTitle($APPLICATION->GetPageProperty('title').' '.$val["NAME"]);
$this->setFrameMode(true);
?>
<?//display sections?>
<div class="faq">
	<?foreach ($arResult['SECTIONS'] as $val):?>

	<?if($arParams["SECTION_ID"]==$val["ID"]) $SELECTED_ITEM = $val?>
	<?if ( $val['REAL_DEPTH'] == '0'){?>
	<?
	$APPLICATION->SetPageProperty('title', $APPLICATION->GetTitle().' '.$val["NAME"]);
	?>
		<div style="display: flex; width: 100%">
			<div class="left">
				<div class="head">
					<img alt="<?=$val["NAME"];?>" src="<?=$val["DESCRIPTION"];?>" />
					<h2><?=$val["NAME"];?></h2>
				</div>
				<div>
					<?$rsParentSection = CIBlockSection::GetByID($val["ID"]);
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
								?>
								<div class="plus">
									<a href="#<?=$arSect["ID"]?>">
										<h3 id="theme_<?=$arSect["ID"]?>" onclick="openbox(<?=$arSect["ID"]?>); addActive(this);">
											<?=$arSect["NAME"]?>
										</h3>
									</a>
								</div>
								<?
							}
						}?>
				</div>
			</div>
			<div class="right">
				<?
				if (($val["ID"] == '2230') || ($val["ID"] == '2229')){
					$APPLICATION->IncludeComponent(
						"bitrix:support.faq.element.list",
						"",
						Array(
							"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"AJAX_MODE" => "N",
							"SECTION" => $arParams["SECTION"],
							"EXPAND_LIST" => $arParams["EXPAND_LIST"],
							"LINK_ELEMENTS" => "",
							"AJAX_OPTION_SHADOW" => "Y",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"SHOW_RATING" => $arParams["SHOW_RATING"],
							"RATING_TYPE" => $arParams["RATING_TYPE"],
							"PATH_TO_USER" => $arParams["PATH_TO_USER"],
							"SECTION_ID" => $val["ID"],
							"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
							"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
						),
						false
					);
				}else{
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
							$APPLICATION->IncludeComponent(
								"bitrix:support.faq.element.list",
								"",
								Array(
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"AJAX_MODE" => "N",
									"SECTION" => $arParams["SECTION"],
									"EXPAND_LIST" => $arParams["EXPAND_LIST"],
									"LINK_ELEMENTS" => "",
									"AJAX_OPTION_SHADOW" => "Y",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"SHOW_RATING" => $arParams["SHOW_RATING"],
									"RATING_TYPE" => $arParams["RATING_TYPE"],
									"PATH_TO_USER" => $arParams["PATH_TO_USER"],
									"SECTION_ID" => $arSect["ID"],
									"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
									"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
								),
								false
							);
						}
					}
				}
				?>
			</div>
		</div>
		<div class="contacts">
			<p>
				По дополнительным вопросам сервисного обслуживания Вы можете обратиться в <a href="/podderzhka/spisok-servisnykh-tsentrov.php">Техническую поддержку</a> компании PERCo или в один из <a href="/kontakty/">Сервисных центров</a>.
			</p>
		</div>
	<?}?>
	<?endforeach;?>
</div>


<script type="text/javascript">
	var faq_url = window.location.hash.slice(1);
	var faq_pathname = window.location.pathname.slice(16,-1);

	isemptyUrl(faq_url);

	function addActive(element){
		var el = document.getElementsByClassName('active');

		for (var i = 0 ; i < el.length; i++){
			el[i].classList.remove('active');
		}

		element.className = 'active';
	}
	function openbox(id){
	    var divs = document.getElementsByClassName('element-question');

	    for (var i = 0 ; i < divs.length; i++){
			divs[i].style.display = 'none'
		}

	    var divs = document.getElementsByClassName(id);
		for (var i = 0 ; i < divs.length; i++){
			display = divs[i].style.display;
			if( display == 'none' ){
		       divs[i].style.display = 'block';
		    }else{
		       divs[i].style.display = 'none';
		    }
		}
	}
	function isemptyUrl(url){
		if (url == ''){
			if ((faq_pathname != '2230') & (faq_pathname != '2229')){
				var div = $( ".right .element-question:first" );
				for (var i = 0 ; i < div.length; i++){
					var show_id = div[i].id;
					addActive(document.getElementById('theme_' + show_id));
					openbox(show_id);
				}
			}else{
				openbox(faq_pathname);
			}
		}else{
			addActive(document.getElementById('theme_' + faq_url));
			openbox(faq_url);
		}
	}
</script>