<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="gallery-menu" id="sectionBlock">
	<a class="btn-theme active" onclick="filterSelection('all');"><img src="/images/icons/gallery-all.svg"><?=GetMessage("all")?></a>
	<?
		$sections = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_CODE"=>"company_images", "CODE"=>"TYPE_OBJECT"));
		while ($element = $sections->GetNext())
		{
			$name = $element["VALUE"];
			$code = translitIt(strtolower($name));
			$url = '/images/icons/gallery-'.$code.'.svg';
			?>
				<a class="btn-theme" onclick="filterSelection('<?=$code;?>');"><img src="<?=$url;?>"><?=GetMessage($code)?></a>
			<?
		}
	?>
</div>

<?

function print_element($arProperty)
{
	$montazh = "";
	$keyTitle = array_search(LANGUAGE_ID, $arProperty["FULL_OPIS"]["DESCRIPTION"]);
	$keyAlt = array_search(LANGUAGE_ID, $arProperty["GALLERY_OPIS"]["DESCRIPTION"]);
	if ($keyTitle !== false)
	{
		$title = $arProperty["FULL_OPIS"]["VALUE"][$keyTitle];
		$alt = $arProperty["GALLERY_OPIS"]["VALUE"][$keyAlt];
	}
	if ($arProperty["WTB_LINK"]["VALUE"])
	{
		$arFilter = Array("IBLOCK_ID"=>$arProperty["WTB_LINK"], "ID" => $arProperty["WTB_LINK"]["VALUE"], "ACTIVE" => "Y");
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_NAME", "PROPERTY_CITY");
		$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
		if (intval($res->SelectedRowsCount()) > 0)
		{
			$ob = $res->GetNextElement();
			$arProps = $ob->GetProperties();
			$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
			if ($keyName !== false)
			{
				if ($arProps["CITY"]["VALUE"])
				{
					$resCity = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>$arProps["CITY"]["LINK_IBLOCK_ID"], "ID" => $arProps["CITY"]["VALUE"]), false, Array(), array("ID", "NAME", "PROPERTY_NAME"));
					$arCity = $resCity->Fetch();
					$city = $arCity["PROPERTY_NAME_VALUE"];
				}
				else
				{
					$keyCity = array_search(LANGUAGE_ID, $arProps["CITY_COM"]["DESCRIPTION"]);
					$city = $arProps["CITY_COM"]["VALUE"][$keyCity];
				}
				$montazh = " (".GetMessage("MONTAZH")." ".$arProps["NAME"]["VALUE"][$keyName].", ".$city.")";
			}
		}
	}
	$section = translitIt(strtolower($arProperty["TYPE_OBJECT"]["VALUE"]));
	if ($section){
		$result .= '<div class="item '.$section.'" itemscope itemtype="http://schema.org/ImageObject"><a src="'.$arProperty["FULL"]["VALUE"].'" data-sub-html="'.$title.$montazh.'" title="'.$title.'" itemprop="contentUrl"><img v-bx-lazyload alt="'.$alt.'" src="'.$arProperty["SCROLL"]["VALUE"].'" src="" itemprop="thumbnail"></a><meta itemprop="caption description" content="'.$title.$montazh.'"></div>';
		return $result;
	}
}


$arResult["TIMESTAMP_X"] = $arResult["ITEMS"][0]["TIMESTAMP_X"];
if (isset($_REQUEST["position"]))
{
	$currentpos = htmlspecialcharsbx(trim(strip_tags($_REQUEST["position"])));
	$current_count = $currentpos*18;
}
else
{
	$currentpos = "all";
	$current_count = 18;
}


$num = 18;
$count_start=1;
$current_page = $path . htmlspecialcharsbx($_REQUEST["TYPE_OBJECT"]) . ".php";
$posts=count($arResult["ITEMS"]);
$total = intval(($posts - 1) / $num) + 1;
$conutpages = $total;
echo '<script type="text/javascript">var end='.$total.'; var end_elem='.($posts%18-1).';</script>';
if ($currentpos > $total || (!is_numeric($currentpos) && $currentpos != "all"))
{
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
	$APPLICATION->SetTitle("404 Not Found");
}
if ($currentpos == "all")
{
	$pagenav='<div id="ShowNav"><span>'.GetMessage("ALL").'</span> | <span><a href="'.$current_page.'?position=1">'.GetMessage("PAGED").'</a></span></div>';
	if ($posts>18)
	{
		echo '<div class="navigation"><div class="navpag">'.GetMessage("PHOTOS").' <span class="numBG">';
		echo($current_count-17);
		echo '</span> - <span class="numEND">';
		echo $posts;
		echo '</span>';
		if (SITE_ID != "s3")
			echo $pagenav;
		echo '</div></div>';
	}
	echo '<div id="gallery" class="grid">';
	for($i = 0; $i < $posts; $i++)
	{
		echo print_element($arResult["ITEMS"][$i]["PROPERTIES"]);
	}
	echo '</div>';
}
else
{
	if (($currentpos+5) >= 10 && ($currentpos+5) <= $total)
		$conutpages = $currentpos+5;
	elseif (($currentpos+5) >= $total)
		$conutpages = $total;
	if(($currentpos-5) >= 1)
	{
		$count_start = $currentpos-4;
		if (($conutpages-$count_start) <= 18 && ($conutpages-18) > 0)
			$count_start = $conutpages-18;
		else
			$count_start = 1;
	}
	$pagenav='<div id="ShowNav"><span>';
	if ($currentpos != 1)
		$pagenav.='<a href="'.$current_page.'?position=1">'.GetMessage("FIRST").'</a>';
	else
		$pagenav.=GetMessage("FIRST");
	$pagenav.='</span> | ';
	for ($x=$count_start;$x<=$conutpages;$x++)
	{
		if ($x == $count_start)
		{
			$pagenav.='<span>';
			if ($currentpos != 1)
			{
				$pagenav.='<a href="'.$current_page.'?position='.($currentpos-1).'">'.GetMessage("PREV").'</a>';
			}
			else
				$pagenav.=GetMessage("PREV");
			$pagenav.='</span>';
		}
		$tmp_pos = $x;
		$tmp_count = $x*18;
		$pagenav.='<span> ';
		if ($x != $currentpos)
		{
			$pagenav.='<a href="'.$current_page.'?position='.$tmp_pos.'">'.$x.'</a>';
		}
		else
			$pagenav.= '<strong>'.$x.'</strong>';
		$pagenav.=' </span>';
		if ($x == $conutpages)
		{
			$pagenav.='<span>';
			if ($currentpos != $total)
				$pagenav.='<a href="'.$current_page.'?position='.($currentpos+1).'">'.GetMessage("NEXT").'</a>';
			else
				$pagenav.=GetMessage("NEXT");
			$pagenav.='</span>';
		}
	}
	$pagenav.=' | <span>';
	if ($currentpos != $total)
		$pagenav.='<a href="'.$current_page.'?position='.$total.'">'.GetMessage("LAST").'</a>';
	else
		$pagenav.=GetMessage("LAST");
	$pagenav.='</span>';
	$pagenav.=' | <span id="showAll"><a href="'.$current_page.'">'.GetMessage("ALL").'</a></span></div>';

	if ($posts>18)
	{
		echo '<div class="navigation"><div class="navpag">'.GetMessage("PHOTOS").' <span class="numBG">';
			echo($current_count-17);
			echo '</span>'.GetMessage("DASH").'<span class="numEND">';
			if($current_count<=$posts)
				echo $current_count;
			else
				echo $posts;
			echo '</span> ';
		echo GetMessage("OF").' <span class="numAll">'.$posts.'</span></div>';
		echo $pagenav;
		echo '</div>';
	}
	echo '<div id="gallery" class="grid">';
	for($i = ($currentpos-1)*18; $i < $current_count; $i++) 
	{
		echo print_element($arResult["ITEMS"][$i]["PROPERTIES"]);
	}
	echo '</div>';
}
?>