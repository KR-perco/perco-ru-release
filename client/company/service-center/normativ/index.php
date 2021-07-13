<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Нормативы проведения ремонтных работ", "");
$APPLICATION->SetPageProperty("title", "Нормативы проведения ремонтных работ");
$APPLICATION->SetPageProperty("keywords", "Нормативы проведения ремонтных работ");
$APPLICATION->SetPageProperty("description", "Нормативы проведения ремонтных работ");
$APPLICATION->SetTitle("Нормативы проведения ремонтных работ");
?>
<div id="content">
	<ul>
		<li><a href="/client/company/service-center/" >Новости</a></li>
		<li><a href="/client/company/service-center/remontnaya-dokumentaciya.php" >Ремонтная документация</a></li>
		<li><a href="/client/company/service-center/blanki-po-remontu-i-zayavki-na-popolnenie-zip.php" >Бланки по ремонту и заявки на пополнение ЗИП</a></li>
		<li><a href="/client/company/service-center/garant.php">Гарантийные обязательства PERCo</a></li>
		<li><a href="/client/company/service-center/normativ.php">Нормативы проведения ремонтных работ</a></li>
		<li><a href="/client/company/service-center/parametry.php">Параметры сервисного обслуживания, согласуемые между СЦ и PERCo</a></li>
		<li><a href="/client/company/service-center/katalog-zip.php" >Каталог ЗИП</a></li>
		<li><a href="/client/company/service-center/zadat-vopros.php" >Задать вопрос</a></li>
		<li><a href="/client/company/service-center/kontakty.php">Контакты</a></li>
	</ul>
	<h1>
		<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<table>
		<tr><th colspan="6">Ремонт турникета серии PERCo-TTR-04</th></td>
		<tr>
			<th>№</th>
			<th colspan="2">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена платы модуля СП</td>
			<td rowspan="3">PERCo-CU-02N</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена платы КТА</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Замена аккумулятора внутреннего РИП</td>
			<td>0,1</td>
			<td>1100</td>
			<td>110</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена двигателя в механизме управления </td>
			<td rowspan="10">TTR-04</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена платы CLB</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена механического замка</td>
			<td>0,8</td>
			<td>1100</td>
			<td>880</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Замена демпфера</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Замена кольца контрольного</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Замена механизма управления</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>10</td>
			<td>Замена пружины</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>11</td>
			<td>Замена толкателя с роликом</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>12</td>
			<td>Замена оптического датчика механизма управления</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>13</td>
			<td>Замена платы индикации</td>
			<td>0,25</td>
			<td>1100</td>
			<td>275</td>
		</tr>
		<tr>
			<td>14</td>
			<td>Замена датчика несанкционированного прохода</td>
			<td rowspan="3">TTR-04W</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>15</td>
			<td>Замена контроллера нагревателя турникета </td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>16</td>
			<td>Замена контроллера нагревателя турникета </td>
			<td>0,1</td>
			<td>1100</td>
			<td>110</td>
		</tr>
		<tr><th colspan="6">Поверка работоспособности турникета после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности турникета PERCo-TTR-04 с СКУД</td>
			<td>TTR-04</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Проверка работоспособности системы терморегуляции</td>
			<td>TTR-04W</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Проверка работоспособности турникета и блока управления</td>
			<td>PERCo–CU-02N</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
	</table>
	<br />
	<table>
		<tr><th colspan="5">Ремонт турникета серии PERCo-TTD-03</th></td>
		<tr>
			<th>№</th>
			<th width="410px">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена двигателя в механизме управления</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена платы CLB</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Замена механического замка</td>
			<td>0,8</td>
			<td>1100</td>
			<td>880</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена демпфера</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена кольца контрольного</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена механизма управления</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Замена пружины</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Замена толкателя с роликом</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Замена оптического датчика механизма управления</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>10</td>
			<td>Замена платы индикации</td>
			<td>0,25</td>
			<td>1100</td>
			<td>275</td>
		</tr>
		<tr>
			<td>11</td>
			<td>Замена датчика несанкционированного прохода</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr><th colspan="5">Поверка работоспособности турникета после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности турникета PERCo-TTD-03 с СКУД</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Проверка работоспособности турникета в автономном режиме</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
	</table>
	<br />
	<table>
		<tr><th colspan="5">Ремонт калиток серии PERCo-WHD-04</th></td>
		<tr>
			<th>№</th>
			<th width="410px">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена механизма вращения</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена платы модуля управления</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Замена платы модуля СП</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена платы источника питания</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена аккумуляторов РИП</td>
			<td>0,1</td>
			<td>1100</td>
			<td>110</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена электромагнита ТЭ-3</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Замена демпфера</td>
			<td>0,4</td>
			<td>1100</td>
			<td>440</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Замена пружины</td>
			<td>0,6</td>
			<td>1100</td>
			<td>660</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Замена оптического датчика</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>10</td>
			<td>Замена датчика поворота</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>11</td>
			<td>Замена модуля индикации</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr><th colspan="5">Поверка работоспособности калитки после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности стойки калитки и блока управления</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
	</table>
	<br />
	<table>
		<tr><th colspan="5">Ремонт калиток серии PERCo-WMD — 04,05</th></td>
		<tr>
			<th>№</th>
			<th width="410px">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена платы процессорного модуля</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена платы модуля источников питания</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Замена аккумуляторов РИП</td>
			<td>0,1</td>
			<td>1100</td>
			<td>110</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена мотор-редуктора</td>
			<td>2</td>
			<td>1100</td>
			<td>2200</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена платы силового модуля</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена оптического датчика стопорного узла</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Замена оптического датчика положения калитки</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Замена стопорного узла</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Замена замка</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr><th colspan="5">Поверка работоспособности калитки после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности стойки калитки и блока управления</td>
			<td>0,2</td>
			<td>1100</td>
			<td>330</td>
		</tr>
	</table>
	<br />
	<table>
		<tr><th colspan="5">Ремонт турникета серии PERCo-RTD-03</th></td>
		<tr>
			<th>№</th>
			<th width="410px">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена платы процессорного модуля</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена платы модуля источников питания</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Замена аккумуляторов РИП</td>
			<td>0,1</td>
			<td>1100</td>
			<td>110</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена мотор-редуктора</td>
			<td>2</td>
			<td>1100</td>
			<td>2200</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена платы силового модуля</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена оптического датчика стопорного узла</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Замена оптического датчика положения калитки</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Замена стопорного узла</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Замена замка</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr><th colspan="5">Поверка работоспособности калитки после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности стойки калитки и блока управления</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
	</table>
	<br />
	<table>
		<tr><th colspan="5">Ремонт турникета серии PERCo-RTD-15</th></td>
		<tr>
			<th>№</th>
			<th width="410px">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена платы управления</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена узла оптронных датчиков</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Регулировка исполнительного механизма</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена модуля индикации</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена исполнительного механизма</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена мотор-редуктора</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr><th colspan="5">Поверка работоспособности турникета после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности турникета</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
	</table>
	<br />
	<table>
		<tr><th colspan="5">Ремонт турникета серии PERCo-KR05</th></td>
		<tr>
			<th>№</th>
			<th width="410px">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена электромагнита</td>
			<td>1</td>
			<td>1100</td>
			<td>1100</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена платы контроллера</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Замена механического замка</td>
			<td>0,8</td>
			<td>1100</td>
			<td>880</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена демпфера</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена кольца контрольного</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена пружины</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Замена Механизм вращения KR-05.240.00-02</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>8</td>
			<td>Замена оптического датчика</td>
			<td>0,7</td>
			<td>1100</td>
			<td>770</td>
		</tr>
		<tr>
			<td>9</td>
			<td>Замена платы индикации</td>
			<td>0,25</td>
			<td>1100</td>
			<td>275</td>
		</tr>
		<tr><th colspan="5">Поверка работоспособности турникета после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности турникета PERCo-KR05 с СКУД</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Проверка работоспособности турникета в автономном режиме</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
	</table>
	<br />
	<table>
		<tr><th colspan="5">Ремонт контроллеров системы PERCo-S-20</th></td>
		<tr>
			<th>№</th>
			<th width="410px">Наименование операции</th>
			<th>Время, нч</th>
			<th>Тариф, руб/нч</th>
			<th>Стоимость, руб.</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Замена платы в контроллерах системы</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Замена контроллера в системе</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Замена считывателя</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>4</td>
			<td>Замена платы считывателя</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Замена блока питания</td>
			<td>0,1</td>
			<td>1100</td>
			<td>110</td>
		</tr>
		<tr>
			<td>6</td>
			<td>Замена искрогасящих диодов, геркона</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr>
			<td>7</td>
			<td>Прошивка контроллера</td>
			<td>0,2</td>
			<td>1100</td>
			<td>220</td>
		</tr>
		<tr><th colspan="5">Проверка работоспособности PERCo-S-20  после ремонта</th></td>
		<tr>
			<td>1</td>
			<td>Проверка работоспособности отремонтированного элемента системы</td>
			<td>0,3</td>
			<td>1100</td>
			<td>330</td>
		</tr>
		<tr>
			<td>2</td>
			<td>Проверка работоспособности системы в целом</td>
			<td>0,5</td>
			<td>1100</td>
			<td>550</td>
		</tr>
		<tr>
			<td>3</td>
			<td>Проверка неисправностей, связанных с компьютером и ЛВС</td>
			<td>0,4</td>
			<td>1100</td>
			<td>440</td>
		</tr>
	</table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
