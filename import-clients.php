<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (!$USER->IsAdmin()) {
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
}

$ibId = 18;
$sId = 1777;
$i = 0;
?>

<script>
	window.addEventListener(`load`, () => {
		document.querySelectorAll(`td`).forEach(td => {
			if (getComputedStyle(td).backgroundColor == `rgb(255, 255, 0)`) {
				console.log(td.innerText);
				console.log(`Будет добавлено название: ${td.innerText}, описание: ${td.previousSibling}`);
			}
		});
	});
</script>

<style>
tr
	{mso-height-source:auto;}
col
	{mso-width-source:auto;}
br
	{mso-data-placement:same-cell;}
.style0
	{mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	white-space:nowrap;
	mso-rotate:0;
	mso-background-source:auto;
	mso-pattern:auto;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	border:none;
	mso-protection:locked visible;
	mso-style-name:ќбычный;
	mso-style-id:0;}
td
	{mso-style-parent:style0;
	padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:none;
	mso-background-source:auto;
	mso-pattern:auto;
	mso-protection:locked visible;
	white-space:nowrap;
	mso-rotate:0;}
.xl65
	{mso-style-parent:style0;
	font-weight:700;
	font-family:Calibri, sans-serif;
	mso-font-charset:204;}
.xl66
	{mso-style-parent:style0;
	white-space:normal;}
.xl67
	{mso-style-parent:style0;
	text-align:center;
	white-space:normal;}
.xl68
	{mso-style-parent:style0;
	font-weight:700;
	font-family:Calibri, sans-serif;
	mso-font-charset:204;
	white-space:normal;}
.xl69
	{mso-style-parent:style0;
	color:windowtext;
	white-space:normal;}
.xl70
	{mso-style-parent:style0;
	font-weight:700;
	font-family:Calibri, sans-serif;
	mso-font-charset:204;
	text-align:left;
	white-space:normal;}
.xl71
	{mso-style-parent:style0;
	background:yellow;
	mso-pattern:black none;
	white-space:normal;}
.xl72
	{mso-style-parent:style0;
	text-align:center;
	background:#00B050;
	mso-pattern:black none;
	white-space:normal;}

</style>

<table border="0" cellpadding="0" cellspacing="0" width="1385" style="border-collapse:
 collapse;table-layout:fixed;width:1039pt">
 <colgroup><col class="xl66" width="776" style="mso-width-source:userset;mso-width-alt:27089;
 width:582pt">
 <col class="xl66" width="609" style="mso-width-source:userset;mso-width-alt:21248;
 width:457pt">
 </colgroup><tbody><tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Армения</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Тумбовые
  турникеты-триподы TBC01.1, турникет-трипод TTR-08А, автоматическая калитка
  WMD-06, Физкультурно-оздоровительный комплекс Газпрома, Армения</td>
  <td class="xl66" width="609" style="width:457pt">Gazprom Health and Fitness
  Center</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Беларусь</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Электронные
  проходные TBC01, Минский тракторный завод, Беларусь</td>
  <td class="xl66" width="609" style="width:457pt">Minsk tractor plant</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-03.1, Завод МАЗ, Минск, Беларусь</td>
  <td class="xl71" width="609" style="width:457pt">MAZ plant, Minsk</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-03.1S, бизнес-центр «Площадь Мясникова», Беларусь</td>
  <td class="xl66" width="609" style="width:457pt">Myasnikova Square Business
  center</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты-триподы TB01.1, бизнес-центр Покровский, Минск, Беларусь</td>
  <td class="xl66" width="609" style="width:457pt">Pokrovsky Business Center, Minsk</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Электронные
  проходные KT02 и ограждения BH02, школа, Фаниполь, Беларусь</td>
  <td class="xl66" width="609" style="width:457pt">School, Fanipol</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Электронные
  проходные KT02, гимназия №8, Витебск, Беларусь</td>
  <td class="xl66" width="609" style="width:457pt">Gymnasium №8, Vitebsk</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовые
  турникеты RTD-15, футбольный клуб БАТЭ, стадион Борисов-Арена, Беларусь</td>
  <td class="xl66" width="609" style="width:457pt">Borisov Arena Stadium, Borisov</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Governmental Institutions and
  Local Administrations</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Роторные
  электромеханические турникеты RTD-03S, административное здание компании
  Беларуснефть, Гомель</td>
  <td class="xl66" width="609" style="width:457pt">Administrative building of
  Belarusneft company, Gomel</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Болгария</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитки
  WHD-04. Метрополитен София</td>
  <td class="xl66" width="609" style="width:457pt"><span style="mso-spacerun:yes">&nbsp;</span>Subway, Sofia</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Колумбия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-07A, бизнес-центр Castellana Forum, Богота, Колумбия</td>
  <td class="xl66" width="609" style="width:457pt">Castellana Forum Business
  Center, Bogota</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Чехия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  T-5, Икеа, Брно</td>
  <td class="xl66" width="609" style="width:457pt">Ikea, Brno</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, бизнес-центр «Hadovka Office Park», Прага</td>
  <td class="xl66" width="609" style="width:457pt">Hadovka Office Park Business
  Center, Prague</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Бизнес
  центр Trianon. Прага</td>
  <td class="xl71" width="609" style="width:457pt">Trianon Business Center, Prague</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Стадион
  Karviná, Карвина</td>
  <td class="xl66" width="609" style="width:457pt">Karviná Stadium,
  Karvina<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Эстония</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Cultural institutions and mass
  media enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, Центр Fotografiska, Эстония</td>
  <td class="xl66" width="609" style="width:457pt">Fotografiska Art Сenter, Tallinn</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, Морскиой Музей Эстонии, Таллинн, Эстония</td>
  <td class="xl71" width="609" style="width:457pt">The Estonian Maritime Museum,
  Tallinn</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитки
  WMD-06 в СПА центре Elasmus Spa, Таллинн</td>
  <td class="xl71" width="609" style="width:457pt">Elamus Spa, Tallinn</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитки
  WMD-06 в СПА центре V Spa, Тарту</td>
  <td class="xl71" width="609" style="width:457pt">V Spa, Tartu</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитки
  WMD-06 в развлекательном центре Super Skypark, Таллинн</td>
  <td class="xl71" width="609" style="width:457pt">Super Skypark entertainment
  center, Tallinn</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, кинотеатр Cinamon Kosmos, Эстония</td>
  <td class="xl66" width="609" style="width:457pt">Cinamon Kosmos Cinema, Tallinn</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Бизнес
  квартал Fahle, Таллинн</td>
  <td class="xl71" width="609" style="width:457pt">Fahle Business quarter, Tallinn</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, логистический центр COOP, Эстония</td>
  <td class="xl66" width="609" style="width:457pt">COOP Logistics Center</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl69" width="776" style="height:14.5pt;width:582pt">Полноростовый
  турникет RTD-15, порт Muuga, Таллин, Эстония</td>
  <td class="xl66" width="609" style="width:457pt">Muuga port, Tallinn</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl69" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl69" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl69" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Тумбовые
  турникеты-триподы TTD-03.2S на проходной завода металлоконструкций Kohimo,
  Таллинн, Эстония (Установка Hansab Group, Таллин)</td>
  <td class="xl66" width="609" style="width:457pt">Kohimo metalwork plant,
  Tallinn<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Франция</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Cкоростные
  проходы ST-01, SBE France, Франция</td>
  <td class="xl66" width="609" style="width:457pt">SBE France Office</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Автоматическая
  калитка WMD-06, Офис страховой компании, Франция</td>
  <td class="xl66" width="609" style="width:457pt">Insurance Company</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Автоматическая
  калитка WMD-06 в страховой компании APRIL PARTENAIRES, Франция</td>
  <td class="xl71" width="609" style="width:457pt">APRIL PARTENAIRES Insurance
  Company</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-08A и калитка WMD-06, Amec Foster Wheeler, Шарантон-ле-Пон, Франция</td>
  <td class="xl66" width="609" style="width:457pt">Amec Foster Wheeler,
  Charenton-le-Pont</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, фитнес-клуб L'Appart Fitness, Франция</td>
  <td class="xl66" width="609" style="width:457pt">L'Appart Fitness Fitness Center</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитка
  WMD-06 и тумбовый турникет TTD-03.2, фитнес-центр Megafit, Форбак, Франция</td>
  <td class="xl66" width="609" style="width:457pt">Megafit Fitness Center, Forbach</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  T-5, фитнес-центр, Париж, Франция</td>
  <td class="xl66" width="609" style="width:457pt">Houilles Fitness Center, Paris</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Уличная
  калитка WMD-05SW в парке дикой природы La Montagne des Singes, Париж, Франция</td>
  <td class="xl71" width="609" style="width:457pt">Animal park La Montagne des
  Singes, Kintzheim</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-04CW, Parc Astérix парк развлечений, Франция</td>
  <td class="xl71" width="609" style="width:457pt">Parc Astérix amusement
  park, Paris</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Cultural institutions and mass
  media enterprises</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  T-5, Park Floral, Париж, Франция</td>
  <td class="xl66" width="609" style="width:457pt">Parc Floral, Paris</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  TTR-07, Музей сидра, Франция</td>
  <td class="xl66" width="609" style="width:457pt">Cider Museum</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-08A, замок Шамбор, Луар и Шер, Франция</td>
  <td class="xl71" width="609" style="width:457pt">Chambord Castle, Loir-et-Cher
  Region</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Всепогодные
  турникеты TTR-04, колледж</td>
  <td class="xl66" width="609" style="width:457pt">College, France</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовый
  турникет RTD-15, Университет Париж II – Пантеон-Ассас, Париж</td>
  <td class="xl66" width="609" style="width:457pt">University Paris II
  Panthéon-Assas, Paris</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовый
  турникет RTD-15 и калитка WHD-15, фитнес-зал Gigagym, Париж</td>
  <td class="xl66" width="609" style="width:457pt">Gigagym, Paris</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01 в бизнес школе EMLYON в Сент-Этьене / Париже</td>
  <td class="xl66" width="609" style="width:457pt">EMLYON Business School,
  Saint-Étienne/Paris</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Германия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  T-5 и ограждения BH02, фитнесс-студия, Германия</td>
  <td class="xl66" width="609" style="width:457pt">Fitness Center</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  T-5, фитнес-центр, Германия</td>
  <td class="xl66" width="609" style="width:457pt">Fitness Studio, Sulzbach</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Gym10 Fitness Centers chain</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Греция</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-08А, спортивный клуб Bodyfit, Греция</td>
  <td class="xl66" width="609" style="width:457pt">Bodyfit gym</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитки
  WHD-04R. Порт Корфу, Греция</td>
  <td class="xl66" width="609" style="width:457pt">Port of Corfu</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитки
  WMD-05S, Афины (монтаж — компания Лига AFXOTEC SA)</td>
  <td class="xl66" width="609" style="width:457pt">Vouliagmeni lake, Athens<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Исландия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитка
  WMD-05S. Комплекс термального бассейна «Laugardalslaug», Рейкьявик, Исландия</td>
  <td class="xl66" width="609" style="width:457pt">Laugardalslaug Geothermal
  Swimming Pool, Reykjavik</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Индия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Banks</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, банк Goldman Sachs, Индия</td>
  <td class="xl66" width="609" style="width:457pt">GoldmanSachs Bank, Mumbai /
  Bangalore</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Италия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовый
  турникет RTD-15, компания SICPA, Италия</td>
  <td class="xl66" width="609" style="width:457pt">SICPA Company, Arnad</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовые
  турникеты RTD-16, морской порт, Ливорно, Италия</td>
  <td class="xl66" width="609" style="width:457pt">Port of Trieste</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовые
  турникеты RTD-15, морской порт, Триест, Италия</td>
  <td class="xl71" width="609" style="width:457pt">Port of Livorno</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Полноростовые
  роторные турникеты RTD-15.2, завод промышленного холодильного оборудования
  компании ARNEG, Падуя, Италия</td>
  <td class="xl66" width="609" style="width:457pt">ARNEG Manufacturing Plant, Padua</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Роторные
  турникеты RTD-15.1, оснащенные крышами RTC-15R. Стадион Vincenzo Presti
  футбольного клуба Gela Calcio, Гела, Сицилия (Италия).</td>
  <td class="xl66" width="609" style="width:457pt">Vincenzo Presti football
  stadium, Gela</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Казахстан</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты ТВ01, ограждения серии BH, бизнес-центр Prime Business Park,
  Казахстан</td>
  <td class="xl71" width="609" style="width:457pt">Prime Business Park Business
  Center, Almaty</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-04.1, ограждения серии BH, бизнес-центр Lotos, Казахстан</td>
  <td class="xl66" width="609" style="width:457pt">Lotos Business Center</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TBC01, бизнес-центр, Караганда</td>
  <td class="xl71" width="609" style="width:457pt">Business Center</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Электронная
  проходная KT02, Школа №12 города Актау, Казахстан</td>
  <td class="xl71" width="609" style="width:457pt">School No.12, Aktau</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Электронная
  проходная KT02, Лицей №20 города Актобе, Казахстан</td>
  <td class="xl71" width="609" style="width:457pt">School No.20, Aktobe, Kazakhstan</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовый
  турникет-трипод TTD-03.1G, Университет Народного Хозяйства, Алматы</td>
  <td class="xl71" width="609" style="width:457pt">University of National Economy,
  Almaty</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01 и калитки WMD-06, Назарбаев Университет, Астана</td>
  <td class="xl71" width="609" style="width:457pt">Nazarbaev University, Astana</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-03S, Казахский национальный университет им. аль-Фараби</td>
  <td class="xl66" width="609" style="width:457pt">Al-Farabi Kazakh National
  University</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-04CW, Алма-Атинский зоопарк</td>
  <td class="xl71" width="609" style="width:457pt">Almaty Zoo</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростной
  проход ST-01, Коворкинг IQ, Казахстан</td>
  <td class="xl71" width="609" style="width:457pt">IQ Co-Working</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовые
  турникеты RTD-15, аэропорт, Алматы</td>
  <td class="xl71" width="609" style="width:457pt">Almaty International Airport</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Литва</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-08A, торговый центр «GEDIMINO 9», Вильнюс, Литва</td>
  <td class="xl66" width="609" style="width:457pt">GEDIMINO 9 Shopping Center,
  Vilnius</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Kaunas railway station</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Мальта</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Cultural institutions and mass
  media enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовый
  роторный турникет RTD-15, храмовой комплекс Гжантия на острове Гоцо, Мальта</td>
  <td class="xl66" width="609" style="width:457pt">Ggantija Temples (UNESCO), Gozo</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Мексика</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Medical Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, сеть частных домов престарелых Belmont Village, г.Мехико,
  Мексика</td>
  <td class="xl66" width="609" style="width:457pt">Belmont Village network of
  private nursing homes, CDMX</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-08A в Университете ITESO, г.Гвадалахара, Мексика</td>
  <td class="xl66" width="609" style="width:457pt">ITESO University, Guadalajara</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Tecnológico de Monterrey,
  Monterrey</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01 в офисе компании Thyssenkrupp, г.Мехико, Мексика</td>
  <td class="xl71" width="609" style="width:457pt">Thyssenkrupp headquarters, CDMX</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01 в офисе компании PepsiCo, г.Мехико, Мексика</td>
  <td class="xl66" width="609" style="width:457pt">PepsiCo headquarters, CDMX</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Bosch plant, Aguascalientes</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Марокко</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Governmental Institutions and
  Local Administrations</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростной
  проход ST-01, калитка WHD-06, бассейновое водное управление, Марокко</td>
  <td class="xl66" width="609" style="width:457pt">Basin Water Resources Direction,
  Morocco</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Новая Зеландия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Турникет-трипод
  TTR-04.1 и огражение BH02 в кафе Quad Cafe, Университет Окланда, Н. Зеландия.
  (Установка GATE AUTOMATION LTD, Окленд)</td>
  <td class="xl71" width="609" style="width:457pt">University of Auckland, New
  Zealand (Installed by GATE AUTOMATION LTD, Auckland)</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  TTR-04.1 и автоматическая калитка WMD-05S на проходной фитнес-центра сети
  BODYTECH.</td>
  <td class="xl66" width="609" style="width:457pt">BODYTECH Fitness Center, New
  Zealand (Installed by Gate Automation LTD, New Zealand)</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Нигерия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Электронная
  проходная KT02, библиотека Университета Порта-Харкорт, Нигерия</td>
  <td class="xl66" width="609" style="width:457pt">Library of University of Port
  Harcourt, Nigeria</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Филиппины</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовый
  роторный турникет RTD-15, Jacobi Carbons Philippines, Филиппины</td>
  <td class="xl71" width="609" style="width:457pt">Jacobi Carbons, the Philippines</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-08A, Университет общества южных Филиппин, Себу, Филиппины</td>
  <td class="xl66" width="609" style="width:457pt">University of Southern
  Philippines Foundation, Cebu City</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Саудовская Аравия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-03.2, компания Al Othaim Food Stuff Co, Эр-Рияд, Саудовская
  Аравия</td>
  <td class="xl66" width="609" style="width:457pt">Al Othaim Food Stuff Co, Riyadh</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Сербия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовый
  роторный турникет RTD-20, Завод ZF Friedrichshafen AG, Сербия</td>
  <td class="xl66" width="609" style="width:457pt">ZF Friedrichshafen AG plant,
  Pancevo</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Словакия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-04.1 и ограждения BH02, Hyza Topolcany, Словакия</td>
  <td class="xl66" width="609" style="width:457pt">Hyza Topolcany, Slovakia</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-03.1 и ограждения BH02, UPV, Словакия</td>
  <td class="xl71" width="609" style="width:457pt">Industrial Property Office of
  the Slovak Republic, Banská Bystrica</td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Турникеты-триподы
  TTR-04.1R и калитки WHD-04R, предприятие ELBA, Словакия (Установка APIS Ltd.,
  Банска-Быстрица)</td>
  <td class="xl66" width="609" style="width:457pt">ELBA Company, Kremnica<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты-триподы TTD-03.1 и ограждения BH02 в офисном здании завода KNAUF,
  Словакия</td>
  <td class="xl66" width="609" style="width:457pt">KNAUF Office, Bratislava<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  TTR-04CW на проходной BSH Hausgeräte GmbH, Словакия</td>
  <td class="xl66" width="609" style="width:457pt">BSH Hausgeräte GmbH,
  Košice</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  T-5 и ограждения BH02, STU, Братислава, Словакия</td>
  <td class="xl66" width="609" style="width:457pt">Slovak University of Technology
  in Bratislava (STU), Bratislava</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  T-5, предприятие TRW Steering Systems, Словакия (Установка APIS Ltd.,
  Банска-Быстрица)</td>
  <td class="xl66" width="609" style="width:457pt">TRW Steering Systems</td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Роторные
  полуростовые турникеты RTD-03S и калитка WMD-05S на вагоностроительном заводе
  «TATRAVAGONKA a.s.», Словакия. (Установка APIS Ltd., Банска-Быстрица)</td>
  <td class="xl66" width="609" style="width:457pt">TATRAVAGONKA a.s. Manufacturing
  Plant</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  в SPA-центре «Vital World», Словакия</td>
  <td class="xl66" width="609" style="width:457pt">Vital World SPA Center</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Испания</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты
  TTD.03.2 в Университете Бильбао, Испания</td>
  <td class="xl66" width="609" style="width:457pt">Deusto University, Bilbao</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитки
  WHD-04G в отеле сети Grupo Transhotel, Мадрид, Испания</td>
  <td class="xl66" width="609" style="width:457pt">Grupo Transhotel, Madrid</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Швеция</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Полноростовый
  роторный турникет RTD-15.1, оснащенный крышей RTC-15R, пивоваренный завод
  Spendrups Brewery, Grängesberg Outside Ludvika, Швеция (Установка ABAS
  Protect, Готланд)</td>
  <td class="xl66" width="609" style="width:457pt">Spendrups Brewery,
  Grängesberg Outside Ludvika</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Украина</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Электронные
  проходные KT05, бизнес-центр SP Hall, Украина</td>
  <td class="xl66" width="609" style="width:457pt">SP Hall Business Center, Kiev</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты-триподы TTD-03.1S, бизнес-центр, Киев. (Установка произведена ООО
  «РКИ Консалтинг»</td>
  <td class="xl66" width="609" style="width:457pt">Business Center, Kiev</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Турникеты-триподы
  TTR-04W, спортивный комплекс «Лавина», Днепропетровск, Украина (Установка
  Системные коммуникации, Киев)</td>
  <td class="xl66" width="609" style="width:457pt">Lavina Sports Center,
  Dnipropetrovsk</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">ОАЭ</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты-триподы
  TTR-04.1, фитнес-центр Gym, Дубаи, ОАЭ</td>
  <td class="xl66" width="609" style="width:457pt">Gym Fitness Center, Dubai</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовые
  турникеты RTD-15 в торговом центре Reem Mall, Абу-Даби, ОАЭ</td>
  <td class="xl71" width="609" style="width:457pt">Reem Mall, Abu-Dhabi</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Полноростовые
  роторные турникеты RTD-15.1 в международном морском порту Jebel Ali, Дубаи,
  ОАЭ</td>
  <td class="xl66" width="609" style="width:457pt">Jebel Ali port, Dubai</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Dubai Maritime City</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовый
  турникет TTD-08A и ограждения BH-02 в ботаническом музее Dubai Green Planet,
  Дубай, ОАЭ</td>
  <td class="xl71" width="609" style="width:457pt">Green Planet Zoological Garden,
  Dubai</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовый
  турникет TTD-08A и ограждения BH-02 в парке развлечений Hub Zero, Дубай, ОАЭ</td>
  <td class="xl71" width="609" style="width:457pt">Hub Zero Amusement Park, Dubai</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Governmental Institutions and
  Local Administrations</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01 в Департаменте Экономического Развития, Абу-Даби, ОАЭ</td>
  <td class="xl71" width="609" style="width:457pt">DED headquarters, Abu-Dhabi</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Великобритания</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, офис компании Student Loans Company, Hillington, Шотландия.
  Установка URSA Gates</td>
  <td class="xl66" width="609" style="width:457pt">Student Loans Company Office,
  Hillington</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TB-01A, офис компании NewDay, Лидс, Англия (Установка Directional
  Data Systems, Глазго)</td>
  <td class="xl66" width="609" style="width:457pt">NewDay Company office, Leeds</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Governmental Institutions and
  Local Administrations</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитка
  WMD-06, государственное учреждение, Глазго, Шотландия</td>
  <td class="xl66" width="609" style="width:457pt">Public Institution, Glasgow</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Автоматическая
  калитка WMD-05S, региональный колледж, Питерборо, Кембриджшир, Великобритания</td>
  <td class="xl66" width="609" style="width:457pt">Peterborough Regional College,
  Cambridgeshire</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитка
  WMD-06, центр досуга и сервиса Moto Hospitality, Бедфордшир, Великобритания</td>
  <td class="xl66" width="609" style="width:457pt">Moto Hospitality leisure and
  service center, Bedfordshire</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  TTD-03.1 и калитка WMD-05S, городской центр развлечений, Глазго</td>
  <td class="xl66" width="609" style="width:457pt">Leisure Centre, Glasgow</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Латвия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, кинотеатр Cinamon Mega, Латвия</td>
  <td class="xl66" width="609" style="width:457pt">Cinamon Mega Cinema</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, бизнес-центр, Латвия</td>
  <td class="xl66" width="609" style="width:457pt">Business Center, Riga</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Galleria shopping mall, Riga</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Албания</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  TTR-08A, Фитнес-центр TIRANA, Албания</td>
  <td class="xl66" width="609" style="width:457pt">TIRANA Fitness Center</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Хорватия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Cultural institutions and mass
  media enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  T-5, Амфитеатр города Пула, Хорватия</td>
  <td class="xl66" width="609" style="width:457pt">Pula Amphitheatre</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Дания</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростные
  проходы ST-01, Пушной аукцион, Дания</td>
  <td class="xl66" width="609" style="width:457pt">Copenhagen Fur</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Буркина-Фасо</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Governmental Institutions and
  Local Administrations</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Роторный
  полноростовый турникет RTD-16.2, Министерство Экономики и Финансов, Уагадугу,
  Буркина-Фасо</td>
  <td class="xl71" width="609" style="width:457pt">Ministry of Economy and Finance,
  Ouagadougou</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Польша</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникеты
  RTD-16, футбольный стадион Suwalki City Stadium, Польша</td>
  <td class="xl66" width="609" style="width:457pt">Suwalki City Stadium</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Автоматическая
  калитка WMD-06 и роторный турникет RTD-03S, аквапарк, Польковице, Польша</td>
  <td class="xl66" width="609" style="width:457pt">Waterpark, Polkowice</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Mars Poland manufacturing
  plants, Poznan / DescriptionBłonie<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Zabrze CHP plant</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl71" width="609" style="width:457pt">Amazon logistic centers, Gliwice
  / Pilchowice</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Нидерланды</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Калитка
  WMD-05 в Физиотерапевтическом центре Centra Plaza<span style="mso-spacerun:yes">&nbsp; </span>-<span style="mso-spacerun:yes">&nbsp;&nbsp;
  </span>Lelystad</td>
  <td class="xl71" width="609" style="width:457pt">Centra Plaza Physiotherapy
  Center, Lelystad</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Скоростной
  проход ST-01 Ben Rietdijk Sport -Velserbroek</td>
  <td class="xl71" width="609" style="width:457pt">Ben Rietdijk Sport FItness
  Center, Velserbroek</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  RTD-20 в Il Fiore Healthcenter -<span style="mso-spacerun:yes">&nbsp;
  </span>Roermond / Herten</td>
  <td class="xl71" width="609" style="width:457pt">Il Fiore Healthcenter, Roermond
  / Herten</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  T5 в спорт центре Experience Fitness -<span style="mso-spacerun:yes">&nbsp;
  </span>Halfway</td>
  <td class="xl71" width="609" style="width:457pt">Experience Fitness Sports
  Center, Halfway<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-03 в центре боевых искусств Killa's Cardio Boxing<span style="mso-spacerun:yes">&nbsp; </span>-<span style="mso-spacerun:yes">&nbsp;&nbsp;
  </span>Assen</td>
  <td class="xl71" width="609" style="width:457pt">Killa's Cardio Boxing, Martial
  Arts center, Assen<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в Fit Factory<span style="mso-spacerun:yes">&nbsp; </span>-<span style="mso-spacerun:yes">&nbsp;&nbsp; </span>Paramaribo, Suriname</td>
  <td class="xl71" width="609" style="width:457pt">Fit Factory Fitness Center,
  Paramaribo/Suriname<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в спорт центре Ames<span style="mso-spacerun:yes">&nbsp; </span>-<span style="mso-spacerun:yes">&nbsp;&nbsp; </span>Deurne</td>
  <td class="xl71" width="609" style="width:457pt">Ames Sports Club, Deurne<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в спорт центре Vivelli -<span style="mso-spacerun:yes">&nbsp; </span>Cuijk</td>
  <td class="xl71" width="609" style="width:457pt">Vivelli Sports Club, Cuijk<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в фитнес клубе<span style="mso-spacerun:yes">&nbsp; </span>Gym Fitness
  -<span style="mso-spacerun:yes">&nbsp;&nbsp; </span>Poeldijk</td>
  <td class="xl71" width="609" style="width:457pt">Gym Fitness Sports Club,
  Poeldijk<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в фитнес клубе Family Sports -<span style="mso-spacerun:yes">&nbsp;&nbsp;
  </span>Wateringen</td>
  <td class="xl71" width="609" style="width:457pt">Family Sports FItness Center,
  Wateringen<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в фитнес клубе HealthclubNU - Heemstede</td>
  <td class="xl71" width="609" style="width:457pt">HealthclubNU FItness Center,
  Heemstede</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в фитнес клубе Knetemann Quality Fitness<span style="mso-spacerun:yes">&nbsp;&nbsp; </span>-<span style="mso-spacerun:yes">&nbsp;
  </span>Den Haag</td>
  <td class="xl71" width="609" style="width:457pt">Knetemann Quality Fitness Sports
  Club, Den Haag</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в фитнес центре BijHoen Fitness &amp; Wellness<span style="mso-spacerun:yes">&nbsp;&nbsp; </span>-<span style="mso-spacerun:yes">&nbsp;&nbsp;
  </span>Brunssum</td>
  <td class="xl71" width="609" style="width:457pt">BijHoen Fitness &amp; Wellness
  Center, Brunssum</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-08A в фитнес центре Sports club West Friesland -<span style="mso-spacerun:yes">&nbsp;&nbsp; </span>De Goorn</td>
  <td class="xl71" width="609" style="width:457pt">West Friesland FItness Center,
  De Goorn<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-07 в фитнес клубе Gym-Fit -<span style="mso-spacerun:yes">&nbsp;&nbsp;
  </span>Losser</td>
  <td class="xl71" width="609" style="width:457pt">Gym-Fit FItness Center,
  Losser<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-08A &amp; BH-02 ограждения Стадион<span style="mso-spacerun:yes">&nbsp;
  </span>JSC Toptraining -<span style="mso-spacerun:yes">&nbsp; </span>Volendam</td>
  <td class="xl71" width="609" style="width:457pt">JSC Toptraining Stadium,
  Volendam<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-08A в фитнес центре Body Power -<span style="mso-spacerun:yes">&nbsp;
  </span>Wormer and Zaandam</td>
  <td class="xl71" width="609" style="width:457pt">Body Power Fitness Center,
  Wormer and Zaandam<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-08A в фитнес центре Kenny Evers<span style="mso-spacerun:yes">&nbsp;
  </span>-<span style="mso-spacerun:yes">&nbsp; </span>Voorburg</td>
  <td class="xl71" width="609" style="width:457pt">Kenny Evers Fitness Center,
  Voorburg</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-08A в фитнес центре RGYM -<span style="mso-spacerun:yes">&nbsp;
  </span>Beverwijk</td>
  <td class="xl71" width="609" style="width:457pt">RGYM Fitness Center, Beverwijk</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-08A в фитнес центре SportivaLife -<span style="mso-spacerun:yes">&nbsp;&nbsp;
  </span>Nederweert</td>
  <td class="xl71" width="609" style="width:457pt">SportivaLife Fitness Center,
  Nederweert<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-08A в фитнес центре The Training Club<span style="mso-spacerun:yes">&nbsp;
  </span>- Dedemsvaart</td>
  <td class="xl71" width="609" style="width:457pt">The Training Club Fitness Center
  , Dedemsvaart<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTR-08A в фитнес центре Vital Fitness -<span style="mso-spacerun:yes">&nbsp;
  </span>Delft</td>
  <td class="xl71" width="609" style="width:457pt">Vital Fitness Fitness Center ,
  Delft<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  WMD-06 в парке развлечений Kabonk -Breda</td>
  <td class="xl71" width="609" style="width:457pt">Kabonk Fitness Center , Breda</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  Т5 в фитнес центре Nopbasicgym<span style="mso-spacerun:yes">&nbsp; </span>-<span style="mso-spacerun:yes">&nbsp;&nbsp; </span>Emmeloord</td>
  <td class="xl71" width="609" style="width:457pt">Nopbasicgym Fitness Center ,
  Emmeloord</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  Т5 в центре боевых искусств Fight Club - Huizen</td>
  <td class="xl71" width="609" style="width:457pt">Fight Club Martial arts center ,
  Huizen<span style="mso-spacerun:yes">&nbsp;</span></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Business centers, shopping malls
  and outlets</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  TTD-10A и TTR-07 в сети супермаркетов HEMA -<span style="mso-spacerun:yes">&nbsp;&nbsp;
  </span>Almere / Veenendaal / Deer<span style="mso-spacerun:yes">&nbsp;</span></td>
  <td class="xl71" width="609" style="width:457pt">HEMA supermarket chain, Almere /
  Veenendaal / Herten / Hellevoetsluis</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет
  T5 в офисе компании BQurius -<span style="mso-spacerun:yes">&nbsp;
  </span>Schipluiden</td>
  <td class="xl71" width="609" style="width:457pt">BQurius company headquarters ,
  Schipluiden</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Португалия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Institutions of Higher Education</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Тумбовые
  турникеты TTD-03.2S, общеобразовательная школа в Лиссабоне, Португалия</td>
  <td class="xl66" width="609" style="width:457pt">Public school, Lisbon</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Босния и Герцеговина</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Турникет-трипод
  TTR-04CW, Метромост, Сараево</td>
  <td class="xl66" width="609" style="width:457pt">Metromost, Saraevo, Bosnia and
  Herzegovina</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Малайзия</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Industrial Enterprises</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Электронная
  проходная КТ02, предприятие Samalaju Lodge, Бинтулу, Саравак, Малайзия.
  (Установка Eagle Controls, Сингапур)</td>
  <td class="xl66" width="609" style="width:457pt">Samalaju Lodge Company, Bintulu,
  Sarawak</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Китай</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl70" width="609" style="width:457pt">Office buildings</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Автоматические
  калитки WMD-05S, офис Chong Qing Mobile Ltd, Китай. (Установка Sigitech
  Science&amp;Technology Co., Шанхай)</td>
  <td class="xl66" width="609" style="width:457pt">Chong Qing Mobile Ltd</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Швейцария</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Sports, Leisure &amp; Recreation
  Facilities</td>
 </tr>
 <tr class="xl66" height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr class="xl66" height="39" style="height:29.0pt">
  <td height="39" class="xl66" width="776" style="height:29.0pt;width:582pt">Полуростовый
  роторный турникет RTD-03S в фитнесс-клубе myFit Fitnessclub, Обервиль,
  Швейцария. (Установка компании Mecona AG, Swiss)</td>
  <td class="xl71" width="609" style="width:457pt">myFit Fitnessclub, Oberwil</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl66" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td colspan="2" height="19" class="xl72" width="1385" style="height:14.5pt;
  width:1039pt">Кувейт</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl68" width="609" style="width:457pt">Transport Terminals</td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl67" width="776" style="height:14.5pt;width:582pt"></td>
  <td class="xl67" width="609" style="width:457pt"></td>
 </tr>
 <tr height="19" style="height:14.5pt">
  <td height="19" class="xl66" width="776" style="height:14.5pt;width:582pt">Моторизованные
  калитки WMD-06</td>
  <td class="xl71" width="609" style="width:457pt">Kuwait International Airport,
  Kuwait City</td>
 </tr>
 <!--[if supportMisalignedColumns]-->
 <tr height="0" style="display:none">
  <td width="776" style="width:582pt"></td>
  <td width="609" style="width:457pt"></td>
 </tr>
 <!--[endif]-->
</tbody></table>