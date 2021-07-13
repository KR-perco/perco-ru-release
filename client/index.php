<?
//define('NEED_AUTH', 'Y');
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Клиентский раздел");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "Страница входа в личный кабинет клиентов");
$APPLICATION->SetTitle("Клиентский раздел");
?>
<style type="text/css">
input[type=button]{
	border-radius: 13px;
    color: #214288;
    background-color: white;
    border: 1px solid #214288;
    cursor: pointer;
    line-height: 35px;
    margin: 8px 0;
    font-size: 19px;
    padding: 0 15px;
    font-family: "FuturaPTWeb", sans-serif;
}

input[type=button]:hover{
	background-color: #214288;
	color: #fff;
}

input[type=button]:focus { outline:none }
.auth a { text-decoration: none; }
.authorize-submit-cell > input { margin: 10px 0 0 0; }
</style>
<h1>
<?$APPLICATION->ShowTitle(false, false)?>
</h1>
<?
if ($USER->IsAuthorized())
{
	$arGroups = CUser::GetUserGroup($USER->GetID());
	$url = "";
	if (in_array(10, $arGroups))
		$url = "/client/student/";
	elseif (in_array(11, $arGroups))
		$url = "/client/uchitelskaya/";
	elseif (in_array(26, $arGroups))
		$url = "/client/prepodavatelskaya/";
	elseif (in_array(32, $arGroups))
		$url = "/client/company/";
	elseif (in_array(34, $arGroups))
		$url = "/forum/";
	if ($url != "")
		Header("Location: " . $url, true, 301);
	else
	{
		/*echo '<div class="auth">
			<p><a href="/client/company/"><input type="button" value="Компания"/></a></p>
			<p><a href="/client/student/"><input type="button" value="Студент"/></a></p>
			<p><a href="/client/uchitelskaya/"><input type="button" value="Учительская"/></a></p>
			<p><a href="/client/prepodavatelskaya/"><input type="button" value="Преподавательская"/></a></p>
			<p><a href="/forum/"><input type="button" value="Форум"/></a></p>
		</div>';*/
		echo '<div class="auth">
			<p><a href="/client/company/"><input type="button" value="Компания"/></a></p>
			<p><a href="/client/student/"><input type="button" value="Студент"/></a></p>
			<p><a href="/client/uchitelskaya/"><input type="button" value="Учительская"/></a></p>
			<p><a href="/client/prepodavatelskaya/"><input type="button" value="Преподавательская"/></a></p>
		</div>';
	}
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>