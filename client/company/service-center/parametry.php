<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Параметры сервисного обслуживания, согласуемые между СЦ и PERCo", "");
$APPLICATION->SetPageProperty("title", "Параметры сервисного обслуживания, согласуемые между СЦ и PERCo");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "Параметры сервисного обслуживания, согласуемые между СЦ и PERCo");
$APPLICATION->SetTitle("Параметры сервисного обслуживания, согласуемые между СЦ и PERCo");
?>

<div id="content">
	<?require($_SERVER["DOCUMENT_ROOT"]."/client/company/service-center/menu.php");?>
	<h1>
		<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?
$ID = $USER->GetID();
$rsCompany = CUser::GetByID($ID);
$arCompany = $rsCompany->Fetch();
$id_elem = "";
$vrnpo = "";
$vvno = "";
$vun = "";
$svno = "";
$snchrno = "";
$rs = CIBlockElement::GetList(
	array(), 
	array(
	"IBLOCK_ID" => 57,
	"PROPERTY_CID" => $ID	// пользовательское свойство, фильтр
	),
	false, 
	false,
	array("ID", "PROPERTY_CID", "PROPERTY_VRNOP", "PROPERTY_VVNO", "PROPERTY_VUN", "PROPERTY_SVNO", "PROPERTY_SNCHRNO")	// перечень полей необходимых в результате выборки
);
if($ar = $rs->Fetch())
{
	$id_elem = $ar["ID"];
	$vrnpo = $ar["PROPERTY_VRNOP_VALUE"];
	$vvno = $ar["PROPERTY_VVNO_VALUE"];
	$vun = $ar["PROPERTY_VUN_VALUE"];
	$svno = $ar["PROPERTY_SVNO_VALUE"];
	$snchrno = $ar["PROPERTY_SNCHRNO_VALUE"];
}
if ($_POST)
{
	$vrnpo = htmlspecialcharsbx(strip_tags(trim($_POST["form_vrnpo"])));
	$vvno = htmlspecialcharsbx(strip_tags(trim($_POST["form_vvno"])));
	$vun = htmlspecialcharsbx(strip_tags(trim($_POST["form_vun"])));
	$svno = htmlspecialcharsbx(strip_tags(trim($_POST["form_svno"])));
	$snchrno = htmlspecialcharsbx(strip_tags(trim($_POST["form_snchrno"])));
	$cnzip = htmlspecialcharsbx(strip_tags(trim($_POST["form_cnzip"])));
	$oElement = new CIBlockElement();
	$masFields = array(
		"ACTIVE" => "Y", 
		"IBLOCK_ID" => 57,
		"NAME" => $arCompany["WORK_COMPANY"],
		"PROPERTY_VALUES" => array(
			"CID" => $ID,
			"VRNOP" => $vrnpo,
			"VVNO" => $vvno,
			"VUN" => $vun,
			"SVNO" => $svno,
			"SNCHRNO" => $snchrno,
		)
	);
	if ($id_elem)
		$idElement = $oElement->Update($id_elem,$masFields);
	else
		$idElement = $oElement->Add($masFields);
	echo '<p style="color: green;">Данные сохранены</p>';
}
?>
	<form enctype="multipart/form-data" method="POST" action="<?$_SERVER["PHP_SELF"]?>" name="PSO">
		<table> 
			<tr>
				<th>№</th>
				<th>Наименование услуги</th>
				<th>Ед. изм.</th>
				<th>Значение</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Время реакции на обращение покупателя</td>
				<td>час</td>
				<td><input type="text" size="18" value="<?=$vrnpo;?>" name="form_vrnpo" class="inputtext"></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Время выезда на объект</td>
				<td>час</td>
				<td><input type="text" size="18" value="<?=$vvno;?>" name="form_vvno" class="inputtext"></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Время устранения неисправности</td>
				<td>час</td>
				<td><input type="text" size="18" value="<?=$vun;?>" name="form_vun" class="inputtext"></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Стоимость выезда на объект</td>
				<td>рублей</td>
				<td><input type="text" size="18" value="<?=$svno;?>" name="form_svno" class="inputtext"></td>
			</tr>
			<tr>
				<td>5</td>
				<td>Стоимость нормочаса работы на объекте</td>
				<td>рублей</td>
				<td><input type="text" size="18" value="<?=$snchrno;?>" name="form_snchrno" class="inputtext"></td>
			</tr>
		</table>
		<input type="submit" value="Сохранить">
	</form>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
