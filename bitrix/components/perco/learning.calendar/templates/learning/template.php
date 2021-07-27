<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
	allSeminars = true;
</script>
<div class="news-calendar">
<?
$first_issvuc = 0;	//первый семинар в уч. центре с вебинаром
$CountWeek = 0;	//счетчик количества недель
$CountEventsAll = 0;	// счетчик всех событий
$viewButton = true;	// кнопка для показа всех семинаров
$tmpURL = parse_url($_SERVER["REQUEST_URI"]);
$parMonth = $tmpURL["query"];
$page = ""; // флаг страницы "all" - для всех пользователей
$CountWDay = 0;	// счетчик дней недели
$CountEvents = 0;	// счетчик событий за день
$seminar = "";	// класс для семинара
$seminarsType = array();	// массив классов для семинаров, если несколько в 1 день, используется для комбинирования фонов ячейки
$id = array();	// массив идентификаторов блоков для визуализации и упрощения управления
$info = [];	// массив с идентификаторами семинаров, нужен для установки идентификатора первого события в день
$arWDay = array();	// массив с короткими названиями дней недели
$arCity = array();	// массив с названиями городов для каждого из дней недели
$arSeminars = array();	// массив идентификаторами семинаров для передачи скрипту выборки
$arSeminarsDiv = array(); // массив с идентификаторами блоков для передачи скрипту выборки
$seminarEndMessage = "МЕРОПРИЯТИЕ ЗАВЕРШЕНО";
$combEventSpb = array();
$combEventPscov = array();
$array_comb = array();

if (stripos($_SERVER['REQUEST_URI'], '/polzovateley/')!== false)
{
	$kto = "пользователи";
	$tema = "администратор";
	$kto_let = "U";
}
elseif (stripos($_SERVER['REQUEST_URI'], '/installyatorov/')!== false)
{
	$kto = "инсталляторы";
	$tema = "инсталлятор";
	$kto_let = "P";
}

if ($parMonth)
	$APPLICATION->AddHeadString('<link rel="canonical" href="https://'.$_SERVER["HTTP_HOST"].$tmpURL["path"].'" />');
?>
	<div class="event-calendar">
	<table cellspacing='1' cellpadding='4' class='NewsCalTable'>
		<thead>
			<tr>
				<td colspan="7">
					<?if(!$arResult["NEXT_MONTH"]){?>
						<a class="noDecor" href="<?=$arResult["PREV_MONTH_URL"];?>">
							<span><?=$arResult["PREV_MONTH_URL_TITLE"];?></span>
						</a>
						<a href="<?=$arResult["PREV_MONTH_URL"];?>">
							<img border="0" src="/images/calendar/bg-calendar-prev.png" />
						</a>
					<?}?>
					<span id="current_month"><?=$arResult["TITLE"];?></span>
					<?if($arResult["NEXT_MONTH_URL"]) { ?>
						<a href="<?=$arResult["NEXT_MONTH_URL"];?>">
							<img border="0" src="/images/calendar/bg-calendar-next.png" />
						</a>
						<a class="noDecor" href="<?=$arResult["NEXT_MONTH_URL"];?>">
							<span><?=$arResult["NEXT_MONTH_URL_TITLE"];?></span>
						</a>
					<?}?>
				</td>
			</tr>
			<tr>
				<td>Пн</td>
				<td>Вт</td>
				<td>Ср</td>
				<td>Чт</td>
				<td>Пт</td>
				<td>Сб</td>
				<td>Вс</td>
			</tr>
		</thead>
	</table>
<?
foreach($arResult["WEEK_DAYS"] as $WDay)
{
	$arWDay[] = $WDay["SHORT"];
}
foreach($arResult["MONTH"] as $MWeek)	// проходимся по месяцу
{
	$CountWeek++;
}
foreach($arResult["MONTH"] as $arWeek)	// проходимся по месяцу выбирая недели
{
?>
	<div class="week-row">
	<table class="days">
		<tbody>
			<tr>
				<?foreach($arWeek as $arDay){?><td><div class="day"><? echo $arDay["day"]; ?></div></td><?}?>
			</tr>
		</tbody>
	</table>

	<table class="seminars">
		<tbody>
			<tr>

<?
	$seminarFirstCell = false;
	foreach($arWeek as $arDay)	// проходимся по неделе выбирая дни
	{
		//два семинара
		$eventsNumber = count($arDay["events"]);
		//два семинара
		foreach($arDay["events"] as $arEvent)	// проходимся по дню выбирая события
		{
			$CountEvents++;
			$seminar_date = $arEvent["DATE_ACTIVE_TO"];	// дата семинара
			if (strtotime($seminar_date) > strtotime(date("d.m.Y H:i")) && $CountEvents == 1)
				$CountEventsAll++;
			if ($arEvent["city"])
				$arCity[$arDay["day"]] = $arEvent["city"];
			switch($arEvent["seminar"])
			{
				case 1532:
					$seminar = 'vebinar';
					$imageInf = '<img class="inf" alt="Информация" src="/images/icons/inform-blue.svg">';
					$id[$arEvent["seminarID"]][0] = "vebinar_id" . $arEvent["seminarID"];
					$id[$arEvent["seminarID"]][1] = "vebinar_div" . $arEvent["seminarID"];
					$info[] = $arEvent["seminarID"];
					$seminarsType[] = $seminar;
					$seminarName[0]  = "Интернет-семинар";
					$seminarName[1] = 'style="list-style-image:url(/images/e-learning/schedule-list-02.png);"';
					break;
				case 1533:
					$seminar = 'seminarvucentre';
					$imageInf = '<img class="inf" alt="Информация" src="/images/icons/inform.svg">'; 
					$id[$arEvent["seminarID"]][0] = "seminarvucentre_id" . $arEvent["seminarID"];
					$id[$arEvent["seminarID"]][1] = "seminarvucentre_div" . $arEvent["seminarID"];
					$info[] = $arEvent["seminarID"];
					$seminarsType[] = $seminar;
					$seminarName[0] = "Семинар в онлайн формате"; //"Очный семинар в учебном центре Санкт-Петербурга";
					$seminarName[1] = 'style="list-style-image:url(/images/e-learning/schedule-list-01.png);"';
					foreach($arEvent["combined"] as $arComb){
						for ($i=0; $i<5; $i++){ 
							for ($j=0; $j<7; $j++){ 
								if ( ($arComb == ($arWeek[$i]["events"][$j]["seminarID"]) ) && ( $arComb != NULL ) ){
									array_push($combEventPscov, $arWeek[$i]["events"][$j]["title"]);
								}
							}
						}
					}
					break;
				default:
					$seminar = "";
					break;
			}
			$seminar_title[$id[$arEvent["seminarID"]][0]] = "<li " . $seminarName[1] . ">" . $seminarName[0] . " «" . $arEvent["title"] . "»</li>";
			if ( ( $seminar == "seminarvucentre" ) or ( $seminar == "seminarvucentreNoA" ) ){
					$seminar_city = "Город: " . $arEvent["city"] . ".";
			} else {
					$seminar_city = "";
			}
			$seminar_title_city[$id[$arEvent["seminarID"]][0]] = "<li " . $seminarName[1] . ">" . $seminarName[0] . " «" . $arEvent["title"] . "» ". $seminar_city . "</li>";
			$arSeminars[] = $id[$arEvent["seminarID"]][0];
			$arSeminarsDiv[] = "div" . $info[0];
			if(in_array("all", $arEvent["kto"]))
				$page = "all";
		}
		/*if(strtotime($seminar_date) < strtotime(date("d.m.Y H:i")))
		{
			switch ($seminar)
			{
				case "seminarvucentre":
					$seminar = "seminarvucentreNoA";
					break;
				case "vebinar":
					$seminar = "vebinarNoA";
					break;
			}
		}*/
		
		/*if ($type == 'seminar' && $eventsNumber == 2 && $seminarFirstCell) {
			echo 'first seminar';
		} else if ($type == 'seminar' && $eventsNumber == 2 && !$seminarFirstCell) {
			echo 'next seminar';
		} else {
			echo 'other';
		}*/
		/*if ($arEvent['DATE_ACTIVE_TO'] == '16.06.2020 10:00:00') {
			echo '456';
		}*/
		if ($eventsNumber <2) {
			if (($seminar == "vebinar") or ($arEvent["title"] == "Обзор систем и оборудования PERCo")) {?>
			<td 
				<?if($info != NULL) { ?>
					id="div<?=$info[0];?>" 
					onmouseover="seminarsView('info<?=$info[0];?>');" 
					onmouseout="seminarsHide('info<?=$info[0];?>');" <?if(strtotime($seminar_date) > strtotime(date("d.m.Y H:i"))) { ?> 
					onclick="<?if ( stripos($_SERVER['REQUEST_URI'], 'schedule')!== false) { 
									foreach($id as $value) {?>
										viewEvents('<?=$value[0];?>', 'div<?=$info[0];?>', '<?=$seminar;?>');<?
									} 
								} else { ?>goPage('<?=$info[0];?>', '<?=$parMonth;?>');<? } ?>" <? } 
							} elseif ($seminar != NULL) { echo 'class="' . $seminar . '"'; }?>
					class="event" 
					colspan="<?if($arEvent["title"] == "Обзор систем и оборудования PERCo"){echo "4";} ?>"
					style="overflow: hidden;"
			>
				<table>
					<?foreach($arDay["events"] as $arEvent){
						if (($seminar == "vebinar") or ($arEvent["title"] == "Обзор систем и оборудования PERCo")) {	?>
						<tr>
							<td colspan="<?if($arEvent["title"] == "Обзор систем и оборудования PERCo"){echo "4";} ?>"
								style="border: none; padding: 0 0 5px 0;"
							>
								<div style="width: 100%;" 
									class="<?=$seminar;?>">
									<p style="line-height: 21px; padding: 0 0 0 5px; margin: 0px; font-weight: 600;  display:block; cursor: pointer;"><?=$imageInf;?>
										
									<?if ($seminar == "vebinar"){
										?>
											Вебинар
										<?
									}else{
										?>Семинар в онлайн формате <?/*Семинар в <?echo $arEvent["city"];?>е*/?><?
									}
									?>
									</p>
								</div>
							</td>
						</tr>
					<?}
					}?>
				</table>
				<?
				if($info != NULL){
				?>
					<div id="info<?=$info[0];?>" class="viewEvents">
				<?
					ksort($seminar_title);
					reset($seminar_title);
					ksort($seminar_title_city);
					reset($seminar_title_city);
					if ($seminar_title)
					{
						foreach($arDay["events"] as $arEvent){
							$tmpDate = explode(" ", $seminar_date);
							if ($seminar_title)
							{
								if ( $arEvent["city"] == "Санкт-Петербург" )
								{?>
									<span class="spanBlock">
										<b class="head_b">
										<? echo "Семинар в онлайн формате"; //"Очный семинар в учебном центре Санкт-Петербурга";?>
										<ul>
											<li>«Обзор систем и оборудования PERCo»</li>
											<li>«Практические навыки по работе в системах PERCo»</li>
											<li>«Получение практических навыков в работе с системой PERCo-Web»</li>
											<li>«Сертификация «Авторизованный <?=$tema?>»»</li>
										</ul>
										</b>
									</span>
								<?}
								else
								{?>
									<span class="spanBlock"><b class="head_b"><ul><li style="list-style-image:url(/images/e-learning/schedule-list-02.png);"><? 
										echo "Вебинар «";
										echo $arEvent["title"];
										echo "»";
										?> </li></ul></b></span>
								<?}
							}
						}
					}
				?>
					</div>
				<?}?>
			</td><?
			}elseif($seminar == "") { ?> <td class="event"></td> <? }
		}
			$arEvent["title"] = "";


		$tmp = "";
		$CountEvents = 0;
		$seminar_title = array();
		$seminar_title_city = array();
		$seminar_date = "";
		$info = [];
		$seminarsType = array();
		$id = array();
		$kto = "";
		$seminar = "";
		$arCity = array();
		$combined ="";
		$add="";
		$CountWDay++;
		$combEvent = array();
	}
	$CountWDay = 0;

?>
				</tr>
			</tbody>
		</table>
	</div>
<?
}

if ($CountEventsAll < 2)
	$viewButton = false;
else
	$viewButton = true;
$CountEventsAll = 0;
$CountWeek = 0;
?>
	</div>

<script language="javascript" type="text/javascript">
CountSel = 0;
arSeminars = [];
arSeminars = [<?php echo "'" . implode("','", $arSeminars) . "'"; ?>];
arSeminarsDiv = [];
arSeminarsDiv = [<?php echo "'" . implode("','", $arSeminarsDiv) . "'"; ?>];
</script>
<?
if ($page == "all")
{
?>
	<div class="info_block">
		<div style="float: left;">
			<p>
				<img border="0" src="/images/calendar/bg-calendar-user-info.png" align="left"/>
				<span>- пользователям</span>
			</p>
		</div>
		<div style="float: left;">
			<p>
				<img border="0" src="/images/calendar/bg-calendar-instal-info.png" align="left"/>
				<span>- инсталляторам</span>
			</p>
		</div>
	</div>
<?
}
?>
	<div class="description_block">
		<div class="description_item">
			<div style="width: 40px; height: 30px; background-color: #49639b" ></div>
			<div class="text_block">Семинары в учебном центре в Санкт-Петербурга</div>
		</div>
		<div class="description_item">
			<div style="width: 40px; height: 30px; background-color: #d5d9dd" ></div>
			<div class="text_block">Интернет-семинары</div>
		</div>
	</div>
<?
if (stripos($_SERVER['REQUEST_URI'], 'schedule')!== false && $viewButton == true)
{
?>
	<div class="viewAll">
		<a href="javascript:void(0);" onclick="viewAll();">Показать все семинары</a>
	</div>
<?
}
?>
</div>