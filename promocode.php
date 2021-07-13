<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Промокод - оставить заявку PERCo");
$APPLICATION->SetPageProperty("title", "Системы безопасности – цены, купить комплексные системы безопасности, производство систем безопасности");
$APPLICATION->SetPageProperty("description", "PERCo – крупнейший российский производитель оборудования и систем безопасности (СКУД - системы контроля доступа, видеонаблюдение, охранно-пожарная сигнализация, турникеты, считыватели, электромеханические замки)");
$APPLICATION->SetPageProperty("keywords", "системы безопасности, контроль доступа, системы контроля доступа, скуд, скд, турникеты, охранно пожарная сигнализация, пожарная безопасность, видеонаблюдение, системы видеонаблюдения, учет рабочего времени");

$APPLICATION->AddHeadScript("/scripts/pages/main.js"); // подключение скриптов
$APPLICATION->SetAdditionalCSS("/css/form.css"); // подключение стилей
?>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-font-smoothing: antialiased;
  -o-font-smoothing: antialiased;
  font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
}


.container {
  max-width: 400px;
  width: 100%;
  margin: 0 auto;
  position: relative;
}


#contact {
  background: #F9F9F9;
  padding: 25px;
  margin: 150px 0;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}


fieldset {
  border: medium none !important;
  margin: 0 0 10px;
  min-width: 100%;
  padding: 0;
  width: 100%;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="phone"],
#contact input[type="company"],
#contact textarea {
  width: 100%;
  border: 1px solid #ccc;
  background: #FFF;
  margin: 0 0 5px;
  padding: 10px;
}

#contact input[type="text"]:hover,
#contact input[type="email"]:hover,
#contact input[type="tel"]:hover,
#contact input[type="url"]:hover,
#contact textarea:hover {
  -webkit-transition: border-color 0.3s ease-in-out;
  -moz-transition: border-color 0.3s ease-in-out;
  transition: border-color 0.3s ease-in-out;
  border: 1px solid #aaa;
}

#contact textarea {
  height: 100px;
  max-width: 100%;
  resize: none;
}

#contact button[type="submit"] {
  cursor: pointer;
  width: 100%;
  height: 50px;
  border: none;
  background: #214288;
  color: #FFF;
  margin: 0 0 5px;
  padding: 10px;
  font-size: 15px;
  text-decoration: none;
}

#contact button[type="submit"]:hover {
  background: #4562A2;
  -webkit-transition: background 0.3s ease-in-out;
  -moz-transition: background 0.3s ease-in-out;
  transition: background-color 0.3s ease-in-out;
}

#contact button[type="submit"]:active {
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.copyright {
  text-align: center;
}

#contact input:focus,
#contact textarea:focus {
  outline: 0;
  border: 1px solid #aaa;
}

::-webkit-input-placeholder {
  color: #888;
}

:-moz-placeholder {
  color: #888;
}

::-moz-placeholder {
  color: #888;
}

:-ms-input-placeholder {
  color: #888;
}
h2{
  margin-bottom:20px;
}


fieldset input{
  display: block;
  margin:10px;
  padding:0;
  float: left;
}
</style>

<div class="container">
  <form id="contact" action="promocode-form-in.php" method="post">
    <h2>Для получения промокода заполните форму:</h2>
    <fieldset>
      <input placeholder="Компания" type="company" name="company" tabindex="4" required autofocus>
    </fieldset>
        <fieldset>
          <input placeholder="Контактное лицо" type="text" name="name" tabindex="1" required >
        </fieldset>
    <fieldset>
      <input placeholder="Телефон" type="phone" name="phone" tabindex="3" >
    </fieldset>
    <fieldset>
      <input placeholder="e-mail" type="email" name="email" tabindex="2" required>
    </fieldset>

    <fieldset>
      <input placeholder="person" type="checkbox" name="person" tabindex="5" required>
      <p>Cогласие на обработку персональных данных.</p>
    </fieldset>

    <fieldset>
      <button name="submit" type="submit" id="promocode-submit" data-submit="...Sending">Отправить</button>
    </fieldset>

  </form>
</div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
