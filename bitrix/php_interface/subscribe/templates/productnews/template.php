<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
global $APPLICATION;
$locale_time = setlocale (LC_TIME, 'ru_RU.UTF-8', 'Rus');
$date = strftime("%B %Y", time());
?>

<center>
	<div style="max-width:660px; font-family: Helvetica, Arial, sans-serif; font-size:14px; color:#4D4D4C; text-align:justify;">
		<div style="text-align:center">
			<img style="margin: 5px;" src="https://perco.ru/images/subscribe/new/logo-blue.png" alt="PERCo" width="90" border="0" />
			<p style="margin: 0px;font-size: 11px;">Производитель оборудования безопасности</p>
		</div>
		<div style="position: relative; background-image: url(https://perco.ru/images/subscribe/new/header-products.jpg); height: 115px; padding: 20px; margin: 20px 0; color: #fff; ">
			<h1 style="position: absolute; bottom: 0px;">Новое в товарах</h1>
			<span style="position: absolute; bottom: 0px; right: 0; margin: 20px; font-size: 20px;"><?=$date?></span>
		</div>

		<div>
			<?$SUBSCRIBE_TEMPLATE_RESULT = $APPLICATION->IncludeComponent(
				"perco:subscribe.productnews",
				"",
				Array(
					"SITE_ID" => "s1",
					"IBLOCK_TYPE" => "news",
					"ID" => "55",
					"SORT_BY" => "ACTIVE_FROM",
					"SORT_ORDER" => "DESC",
				),
				null,
				array(
					"HIDE_ICONS" => "Y",
				)
			);?>
		</div>

		<div style="text-align: center; margin:10px 0 40px;">
			<a href="https://www.perco.ru/podderzhka/proektirovshchikam-i-installyatoram/novoe.php" style="background-color: #0b76d6; color: #fff; padding: 20px; text-decoration: none;">Подробнее о новом в товарах</a>
		</div>

		<div style="height:40px; background:#214288; clear: both">
			<div style="float:left; width: 20%; text-align:center; margin-top: 7px;">
				<a href="mailto:mail@perco.ru" target="_blank" style="text-decoration: none">
					<img src="https://www.perco.ru/images/subscribe/new/mail.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 7px;">
				<a href="https://www.perco.ru/" target="_blank" style="text-decoration: none">
					<img src="https://www.perco.ru/images/subscribe/new/globus.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 7px;">
				<a href="https://www.youtube.com/percoru" target="_blank" style="text-decoration: none">
					<img src="https://www.perco.ru/images/subscribe/new/utube.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 7px;">
				<a href="https://www.perco.ru/podderzhka/katalogi-i-buklety.php" target="_blank" style="text-decoration: none">
					<img src="https://www.perco.ru/images/subscribe/new/buklets.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 7px;">
				<a href="https://www.perco.ru/o-kompanii/video/" target="_blank" style="text-decoration: none">
					<img src="https://www.perco.ru/images/subscribe/new/video.png" width="25px"/>
				</a>
			</div>
		</div>
		<p style="font-size:11px;margin-top:7px;margin-bottom:7px;text-align:center">
			<a href="https://www.perco.ru/podderzhka/proektirovshchikam-i-installyatoram/novoe-test.php?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#&action=unsubscribe" style="color:#1a3b9c;">Отписаться от рассылки</a>.
		</p>
	</div>
</center>
<?
if($SUBSCRIBE_TEMPLATE_RESULT)
	return array(
		"SUBJECT"=>$SUBSCRIBE_TEMPLATE_RUBRIC["NAME"],
		"BODY_TYPE"=>"html",
		"CHARSET"=>"UTF-8",
		"DIRECT_SEND"=>"Y",
		"FROM_FIELD"=>$SUBSCRIBE_TEMPLATE_RUBRIC["FROM_FIELD"],
	);
else
	return false;
?>