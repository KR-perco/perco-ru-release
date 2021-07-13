<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты");
$APPLICATION->SetPageProperty("keywords", "Контакты");
$APPLICATION->SetPageProperty("description", "Контакты");
$APPLICATION->SetTitle("Контакты");
?>
<div id="textBlcok">
	<ul>
		<li><a href="/client/company/service-center/" >Новости</a></li>
		<li><a href="/client/company/service-center/remontnaya-dokumentaciya/" >Ремонтная документация</a></li>
		<li><a href="/client/company/service-center/blanki-po-remontu-i-zayavki-na-popolnenie-zip/" >Бланки по ремонту и заявки на пополнение ЗИП</a></li>
		<li><a href="/client/company/service-center/garant/">Гарантийные обязательства PERCo</a></li>
		<li><a href="/client/company/service-center/normativ/">Нормативы проведения ремонтных работ</a></li>
		<li><a href="/client/company/service-center/parametry/">Параметры сервисного обслуживания, согласуемые между СЦ и PERCo</a></li>
		<li><a href="/client/company/service-center/katalog-zip/" >Каталог ЗИП</a></li>
		<li><a href="/client/company/service-center/zadat-vopros/" >Задать вопрос</a></li>
		<li><a href="/client/company/service-center/kontakty/">Контакты</a></li>
	</ul>
  <br />
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
  <table cellpadding="3" border="0" style="margin: 0pt auto;" cellsapcing="0" class="data-table">
    <thead>
      <tr>
        <td colspan="2"><strong>Департамент Сервисного Обслуживания (ДСО)</strong></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2"><p>Вопросы связанные с ремонтом, технической поддержкой и сервисным обслуживанием:</p>
		  <p>Call-центр: 8-800-775-37-05<br />
		  Телефоны/факс: 247-04-55 <br />
            Режим работы: пн&ndash;пт с 9:00 до 18:15 по мск. времени. <br />
            В остальное время можно оставить сообщение на автоответчике или послать его по факсу или e-mail. </p></td>
      </tr>
      <tr>
        <td valign="top">Исполнительные устройства</td>
        <td><strong>Тукк Сергей</strong> <br />
          Телефон: 247-04-55<br />
          E-mail: <a href="mailto:turnstile@perco.ru">turnstile@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Электронные устройства</td>
        <td><strong>Салтанович Антон</strong><br />
          Телефон: 247-04-55 <br />
          E-mail: <a href="mailto:system@perco.ru" >system@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Программное обеспечение</td>
        <td><strong>Долматов Дмитрий</strong> <br />
		<strong>Иванова Ирина</strong> <br />
          Телефон: 247-04-55 <br />
          E-mail: <a href="mailto:soft@perco.ru" >soft@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Работа с Сервисными Центрами</td>
        <td><strong>Коснырев Василий</strong> <br />
          Телефон: 247-04-55<br />
          E-mail: <a href="mailto:service@perco.ru" >service@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Электромеханические замки</td>
        <td><strong>Тукк Сергей</strong> <br />
          Телефон: 247-04-55<br />
          E-mail: <a href="mailto:locks@perco.ru">locks@perco.ru</a></td>
      </tr>
    </tbody>
    <thead>
      <tr>
        <td colspan="2"><strong>Департамент Логистики (ДЛ)</strong></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2"><p>Вопросы, связанные с доставкой и отправлением ЗИП, ремонтируемых изделий:</p>
          <p>Телефон: 247-04-54<br />
            E-mail: <a href="mailto:logis@perco.ru" >logis@perco.ru</a> </p></td>
      </tr>
    </tbody>
    <thead>
      <tr>
        <td colspan="2"><strong>Департамент продаж</strong></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2"><p>Вопросы, связанные с покупкой и комплектацией изделий PERCo:</p>
          <p>Call-центр: 8-800-333-52-53<br />
            Телефон: (812) 247-04-57<br />
            E-mail: <a href="mailto:mail@perco.ru" >mail@perco.ru</a> </p></td>
      </tr>
    </tbody>
  </table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>