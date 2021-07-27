<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $SUBSCRIBE_TEMPLATE_RUBRIC;
$SUBSCRIBE_TEMPLATE_RUBRIC=$arRubric;
global $APPLICATION;
$locale_time = setlocale (LC_TIME, 'es_ES.UTF-8', 'Es');
?>

<center>
	<div style="max-width:700px; font-family: Helvetica, Arial, sans-serif; font-size:14px; color:#4D4D4C; text-align:justify;">
		<div style="height:50px; font-size:14px; background:#214288; color:#fff;">
			<div style="float: left">
				<img style="margin: 10px 0 0 7px;" src="https://perco.ru/images/subscribe/new/logo.png" alt="Torniquetes y entradas de control electrónicas" width="105" height="34" border="0" />
			</div>
			<div style="float: left">
				<p style="margin: 25px 7px 0 6px; font-size: 12px;">Torniquetes y entradas de control electrónicas</p>
			</div>
		</div>
		<div>
			<img src="https://perco.ru/images/subscribe/new/header.jpg" alt="Torniquetes y entradas de control electrónicas" width="100%" height="auto" border="0" />
		</div>

		<div style="padding-left:20px; padding-right:20px;">
			<?$SUBSCRIBE_TEMPLATE_RESULT = $APPLICATION->IncludeComponent(
				"perco:subscribe.news",
				"",
				Array(
					"SITE_ID" => "s9",
					"IBLOCK_TYPE" => "news ",
					"ID" => "52",
					"SORT_BY" => "ACTIVE_FROM",
					"SORT_ORDER" => "DESC",
				),
				null,
				array(
					"HIDE_ICONS" => "Y",
				)
			);?>
		</div>
		<div style="height:50px; background:#214288;">
			<div style="float:left; width: 20%; text-align:center; margin-top: 10px;">
				<a href="mailto:export@perco.com" target="_blank" style="text-decoration: none">
					<img src="https://perco.ru/images/subscribe/new/mail.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 10px;">
				<a href="https://es.perco.com/" target="_blank" style="text-decoration: none">
					<img src="https://perco.ru/images/subscribe/new/globus.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 10px;">
				<a href="https://www.youtube.com/user/percoweb" target="_blank" style="text-decoration: none">
					<img src="https://perco.ru/images/subscribe/new/utube.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 10px;">
				<a href="https://es.perco.com/servicios/catalogos-y-folletos.php" target="_blank" style="text-decoration: none">
					<img src="https://perco.ru/images/subscribe/new/buklets.png" width="25px"/>
				</a>
			</div>
			<div style="float:left; width: 20%; text-align:center; margin-top: 10px;">
				<a href="https://es.perco.com/la-empresa/video/" target="_blank" style="text-decoration: none">
					<img src="https://perco.ru/images/subscribe/new/video.png" width="25px"/>
				</a>
			</div>
		</div>
		<p style="font-size:11px;margin-top:7px;margin-bottom:7px;">
			<a href="https://es.perco.com/noticias/?ID=#ID#&CONFIRM_CODE=#CONFIRM_CODE#&action=unsubscribe" style="color:#1a3b9c;">Darse de baja del boletín</a>.
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