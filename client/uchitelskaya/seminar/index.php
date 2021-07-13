<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Список семинаров");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Список семинаров");
?>

<div class="dop_menu">
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_dop_menu", 
	array(
		"ROOT_MENU_TYPE" => "podmenu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
</div>

<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?
$rs = CIBlockElement::GetList(array("NAME"=>"ASC"), array("IBLOCK_ID"=>62),false, false, array("ID", "PROPERTY_TOPIC", "PROPERTY_TYPE_SEMINAR"));
?>
<p><a href="/client/uchitelskaya/seminar/create.php">Создать семинар</a></p>
<table  class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead align="center">
		<tr>
			<td>Название семинара</td><td>Тип семинара</td><td></td>
		</tr>
	</thead>
	<tbody>
<?
while($ar = $rs->Fetch())
{
?>
		<tr>
			<td><a href="edit.php?ID=<?=$ar["ID"]?>"><?=$ar["PROPERTY_TOPIC_VALUE"];?></a></td>
			<td><?=$ar["PROPERTY_TYPE_SEMINAR_VALUE"];?></td>
			<td><a href="add.php?ID=<?=$ar["ID"];?>">Запланировать</a> | <a href="del.php?ID=<?=$ar["ID"];?>">Удалить</a></td>
		</tr>
<?}?>
	</tbody>
</table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>