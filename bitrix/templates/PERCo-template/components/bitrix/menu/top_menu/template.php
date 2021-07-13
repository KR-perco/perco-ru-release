<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<nav role="navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
<?
if (!empty($arResult))
{
?>
<input id="top_menu" type="checkbox">
<label for="top_menu"><div class="burger"></div></label>
<ul id="horizontal-multilevel-menu">
<?
	$previousLevel = 0;
	foreach($arResult as $arItem)
	{
		if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel)
			echo str_repeat("</ul></div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		if ($arItem["IS_PARENT"])
		{
			$cur_item = 0;
			$rs = CIBlockSection::GetList(array("sort"=>"ASC"), array("IBLOCK_CODE" => str_replace("/", "", $arItem["LINK"]), "SECTION_ID" => 0, "ACTIVE"=>"Y"));
			$es = CIBlockElement::GetList(array("sort"=>"ASC"), array("IBLOCK_CODE" => str_replace("/", "", $arItem["LINK"]), "SECTION_ID" => 0, "ACTIVE"=>"Y"));
			$count_items = intval($rs->SelectedRowsCount())+intval($es->SelectedRowsCount());
			if ($arItem["LINK"] == "/products/" && LANGUAGE_ID == "ru")
				$count_items += 3; //прибавляем 1 за каждую дополнительную ссылку, которой нет в структуре
			if ($arItem["LINK"] == "/resheniya/" && LANGUAGE_ID == "ru")
				$count_items = 16; //прибавляем 1 за каждую дополнительную ссылку, которой нет в структуре
			if ($arItem["LINK"] == "/solutions/" && LANGUAGE_ID == "en") {
				$count_items += 8;
			}
			if ($arItem["LINK"] == "/solutions/" && LANGUAGE_ID == "fr") {
				$count_items += 8;
			}
			if ($arItem["LINK"] == "/soluciones/" && LANGUAGE_ID == "es") {
				$count_items += 10;
			}

			if ($arItem["DEPTH_LEVEL"] == 1)
			{
?>
			<li><a href="<?=$arItem["LINK"]?>" itemprop="url" class="<?if ($arItem["SELECTED"]) {?>root-item-selected<? } else {?>root-item<?}?>"><span></span><?=$arItem["TEXT"]?><meta itemprop="name" content="<?=$arItem["TEXT"]?>"></a>
				<div class="podmenu"><div class="podlozhka"></div><ul>
				<p class="root-name"><a href="<?=$arItem["LINK"]?>"><span></span><?=$arItem["TEXT"]?></a><p>
<?
			}
			else
			{
?>
			<li <?if ($arItem["SELECTED"]) {?> class="item-selected"<? }?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?><meta itemprop="name" content="<?=$arItem["TEXT"]?>"></a>
				<div class="podmenu"><div class="podlozhka"></div><ul>
				<p class="root-name"><a href="<?=$arItem["LINK"]?>"><span></span><?=$arItem["TEXT"]?></a><p>
<?
			}
		}
		else
		{
			if ($arItem["PERMISSION"] > "D")
			{
				if ($arItem["DEPTH_LEVEL"] == 1)
				{
?>
				<li><a href="<?=$arItem["LINK"];?>" itemprop="url" class="<?if ($arItem["SELECTED"]){?>root-item-selected<?} else {?>root-item<?}?>"><span></span><?=$arItem["TEXT"];?><meta itemprop="name" content="<?=$arItem["TEXT"]?>"></a></li>
<?
				}
				else
				{
					if ($count_items == 0)
						$count_items = $arItem["PARAMS"]["COUNT"];
					if ($cur_item == 0)
						echo '<div class="column">';
					elseif ($count_items >= 6 && $cur_item == ceil($count_items/2) && $arItem["LINK"] != '/resheniya/biznes-tsentry/')
						echo '</div><div class="column">';
					elseif ($arItem["LINK"] == '/resheniya/predpriyatiya/')
						echo '</div><div class="column">';
?>
					<li <? if ($arItem["SELECTED"]) {?> class="item-selected"<?}?>>
				<span <?$link = substr($arItem["LINK"], 0, 9); if (($link == "/podderzh" && empty($arItem["PARAMS"]) )||($link == "/products")||($link == "/produkte")||($link == "/produits")||($link == "/prodotti")||($link == "/producto")){?>style="width:20px; background-image: none; height: 20px; vertical-align: middle;"<?}?>>
					<?
						if ($link == "/podderzh" && !empty($arItem["PARAMS"])){
						}else{
						switch ($arItem["LINK"]) {
							case "/products/turnikety/":
							case "/products/turnstiles-gates-railing-systems/":
							case "/produkte/drehsperren-schwenkturen-gelandersysteme/":
							case "/produits/tourniquets-portillons-pivotants-barrieres/":
							case "/prodotti/tornelli-portelli-transenne/":
							case "/productos/torniquetes-puertas-barreras/":
								?><img width="20" height="20" src="/images/icons/menu/turnikety-menu.svg" alt=""/><?
								break;
							case "/products/elektronnye-prokhodnye/":
							case "/products/ip-based-entrance-control-systems/":
							case "/produkte/elektronisches-eingangsportal/":
							case "/produits/systemes-de-controle-dacces-sur-ip/":
							case "/prodotti/sistemi-di-controllo-accessi-basati-su-ip/":
							case "/productos/pasos-electronicos/":
								?><img width="20" height="20" src="/images/icons/menu/ip-menu.svg" alt=""/><?
								break;
							case "/products/elektromekhanicheskie-zamki/":
							case "/products/electromechanical-locks/":
							case "/produkte/elektromechanische-schlosser/":
							case "/produits/serrures-electromecaniques/":
							case "/prodotti/serrature-elettromeccaniche/":
							case "/productos/cerraduras-electromecanicas/":
								?><img width="20" height="20" src="/images/icons/menu/locks-menu.svg" alt=""/><?
								break;	
							case "/products/kontrollery-schityvateli/":
							case "/products/card-readers-and-card-capture-readers/":
							case "/products/readers-controllers/":
							case "/produkte/ableser-und-kartenaufnehmer/":
							case "/produits/lecteurs-et-controleurs/":
							case "/prodotti/lettori-card/":
							case "/productos/lectores-y-receptores-de-tarjetas/":
								?><img width="20" height="20" src="/images/icons/menu/control-menu.svg" alt=""/><?
								break;
							case "/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/":
								?><img width="20" height="20" src="/images/icons/menu/camera-menu.svg" alt=""/><?
								break;
							case "/products/sistema-kontrolya-dostupa-perco-web/":
							case "/products/perco-web-access-control-system/":
							case "/produits/systeme-de-controle-d-acces-perco-web/":
							case "/prodotti/sistema-di-controllo-accessi-perco-web/":
								?><img width="20" height="20" src="/images/icons/menu/percoweb-menu.svg" alt=""/><?
								break;
							case "/products/sistema-bezopasnosti-perco-s-20-shkola/":
								?><img width="20" height="20" src="/images/icons/menu/school-menu.svg" alt=""/><?
								break;
							case "/products/sistema-dlya-bankomatov-perco-s-800/":
								?><img width="20" height="20" src="/images/icons/menu/banks-menu.svg" alt=""/><?
								break;
							case "/products/prays-list.php":
								?><img width="20" height="20" src="/images/icons/menu/price-menu.svg" alt=""/><?
								break;
							case "/products/video/":
								?><img width="20" height="20" src="/images/icons/menu/video-menu.svg" alt=""/><?
								break;
							case "/podderzhka/katalogi-i-buklety.php":
								?><img width="20" height="20" src="/images/icons/menu/catalog-menu.svg" alt=""/><?
								break;
							case "/products/koren-dopolnitelnoe-oborudovanie/":
							?><img width="20" height="20" src="/images/icons/menu/dop-oborudovanie-menu.svg" /><?
								break;
							case "/products/sistemy-platnogo-dostupa/":
								?><img src="/images/icons/menu/payment-system-menu.svg" alt="Платёжные системы" /><?
									break;
							case "/products/shlagbaum-gs04.php":
							case "/products/gs04-boom-barrier.php":
							case "/produits/barri-re-levante-gs04.php":
							case "/prodotti/gs04-sbarra-del-passaggio-a-livello.php":
							case "/productos/barrera-vehicular-gs04.php":
							case "/products/shlagbaum/":
							?><img width="20" height="20" src="/images/icons/menu/shlagbaum-menu.svg" /><?
								break;
						}
					}
					?>
					</span>
					<a href="<?=$arItem["LINK"]?>" itemprop="url"><?=$arItem["TEXT"]?><meta itemprop="name" content="<?=$arItem["TEXT"]?>"></a></li>
<?
					if ($cur_item == $count_items && $count_items >= 6){
						echo '</div>';
					}
						
						
					$cur_item++;
				}
			}
			else
			{
				if ($arItem["DEPTH_LEVEL"] == 1)
				{
?>
				<li><a href="" class="<?if ($arItem["SELECTED"]) {?>root-item-selected<?} else {?>root-item<?}?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
<?
				}
				else
				{
?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
<?
				}
			}
		}
		$previousLevel = $arItem["DEPTH_LEVEL"];
	}
	if ($previousLevel > 1)//close last item tags
		echo str_repeat("</ul></div></li>", ($previousLevel-1) );
?>
</ul>
<?}?>
</nav>