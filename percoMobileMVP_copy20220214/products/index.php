<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$page = $APPLICATION->GetCurUri();
?>
<script>
	app.setPageTitle({
         title: "Производитель оборудования безопасности"
      });
</script>
<div>
<?
$managerBlock = '<div class="workers-block">
                  <a style="display: none;" href="solution/">
                    <div class="">
                      <img src="/percoMobileMVP/img/section-reshenia.png" alt="solution">
                      <p>Решения</p>
                    </div>
                  </a>
                  <a href="/percoMobileMVP/manager/gallery">
                    <div class="">
                      <img src="/percoMobileMVP/img/section-galery.png" alt="photogallery">
                      <p>Фотогалерея</p>
                    </div>
                  </a>
                  <a href="/percoMobileMVP/manager/booklets">
                    <div class="">
                      <img src="/percoMobileMVP/img/section-booklets.png" alt="booklets">
                      <p>Каталоги и буклеты</p>
                    </div>
                  </a>
                  <a href="/percoMobileMVP/video/?worker=manager">
                    <div class="">
                      <img src="/percoMobileMVP/img/section-video.png" alt="video">
                      <p>Видео</p>
                    </div>
                  </a>		
                </div>';

$installerBlock = '<div class="workers-block">
                <a href="/percoMobileMVP/new/">
                  <div class="">
                    <img src="/percoMobileMVP/img/section-new.png" alt="new" />
                    <p>Новое</p>
                  </div>
                </a>
                <a href="/percoMobileMVP/video/?worker=installer">
                  <div class="">
                    <img src="/percoMobileMVP/img/section-video.png" alt="video" />
                    <p>Видео</p>
                  </div>
                </a>
                <a href="/percoMobileMVP/installer/faq">
                  <div class="">
                    <img src="/percoMobileMVP/img/section-faq.png" alt="faq" />
                    <p>FAQ</p>
                  </div>
                </a>
                <a href="/percoMobileMVP/documentation/">
                  <div class="">
                    <img src="/percoMobileMVP/img/section-documentation.png" alt="documentation" />
                    <p>Документация</p>
                  </div>
                </a>			
              </div>';

$url = parse_url($page);

switch ($url["query"]){
  case "manager":
    echo $managerBlock;
    break;

  case "installer":
    echo $installerBlock;
    break;
}

?>
  <div class="catalog">
    <h2>Каталог</h2> 
<?
$iblock_code = "products";
$iblocks = GetIBlockList("structure", $iblock_code);
if($arIBlock = $iblocks->Fetch())
  $block_id = $arIBlock["ID"];
$current_group = "";
$count = 0;
$group_first = true;
$arSort = Array("UF_GROUP_PRODUCTS"=>"asc", "sort"=>"asc");

$arFilter = Array("IBLOCK_ID"=>$block_id, "GLOBAL_ACTIVE"=>"Y", "<=DEPTH_LEVEL"=>1);
$rsSections = CIBlockSection::GetList($arSort, $arFilter, false, array("UF_GROUP_PRODUCTS"));
while($arSection = $rsSections->GetNext())
{
  $count++;
  if ($current_group != $arSection["UF_GROUP_PRODUCTS"])
  {
    $group_first = true;
    $current_group = $arSection["UF_GROUP_PRODUCTS"];
  }

  $img = substr($arSection["DESCRIPTION"], 14, -3); 
  if ($arSection["ID"] != 1836 && $arSection["ID"] != 2307) {
    # убираем "комплекты ПО" и "Доп оборудование"
?>

    <div class="item">
      <a href="/percoMobileMVP/products/<?=$arSection["CODE"];?>/?<?=$url["query"]?>">
         <img alt="<?=$arSection["NAME"];?>" src="/percoMobileMVP/img/catalog-<?=$img?>png" /> 
        <p class="item_name"><?echo ($arSection["NAME"] == "Турникеты") ? $arSection["NAME"].", калитки, ограждения" : $arSection["NAME"];?></p>
      </a>
    </div>
<?
  }
  if ($count == intval($rsSections->SelectedRowsCount()))
    echo "</div>";
}
?>  
  </div>

</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?> 