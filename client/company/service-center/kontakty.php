<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Контакты", "");
$APPLICATION->SetPageProperty("title", "Контакты");
$APPLICATION->SetPageProperty("keywords", "Контакты");
$APPLICATION->SetPageProperty("description", "Контакты");
$APPLICATION->SetTitle("Контакты");
?>
<div id="content">
  <?require($_SERVER["DOCUMENT_ROOT"]."/client/company/service-center/menu.php");?>
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
		  Телефон (812) 247-04-55 <br />
            Режим работы: пн&ndash;пт с 9:00 до 18:15 по мск. времени. <br />
            В остальное время можно оставить сообщение на автоответчике или послать его по e-mail. </p></td>
      </tr>
      <tr>
        <td valign="top">Исполнительные устройства</td>
        <td><strong>Тукк Сергей</strong> <br />
          Телефон: (812) 247-04-55  доб. 406<br />
	  <strong>Александров Евгений</strong> <br />
	  Телефон: (812) 247-04-55  доб. 407<br />
          E-mail: <a href="mailto:turnstile@perco.ru">turnstile@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Электронные устройства</td>
        <td><strong>Салтанович Антон</strong><br />
          Телефон: (812) 247-04-55  доб. 405 <br />
          E-mail: <a href="mailto:system@perco.ru" >system@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Программное обеспечение</td>
        <td><strong>Долматов Дмитрий</strong> <br />
	  Телефон: (812) 247-04-55  доб. 403 <br />
		<strong>Иванова Ирина</strong> <br />
          Телефон: (812) 247-04-55  доб. 404 <br />
          E-mail: <a href="mailto:soft@perco.ru" >soft@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Работа с Сервисными Центрами</td>
        <td><strong>Коснырев Василий</strong> <br />
          Телефон: (812) 247-04-55  доб. 409<br />
          E-mail: <a href="mailto:service@perco.ru" >service@perco.ru</a></td>
      </tr>
      <tr>
        <td valign="top">Электромеханические замки</td>
        <td><strong>Тукк Сергей</strong> <br />
          Телефон: (812) 247-04-55  доб. 406<br />
	  <strong>Александров Евгений</strong> <br />
	  Телефон: (812) 247-04-55  доб. 407<br />
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
          <p>Телефон: +7 (812) 247-04-54<br />
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
            Телефон: +7 (812) 247-04-57<br />
            E-mail: <a href="mailto:market@perco.ru" >market@perco.ru</a> </p></td>
      </tr>
    </tbody>
  </table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>