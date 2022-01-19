<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Выгрузка тестов");
$APPLICATION->SetPageProperty("keywords", "Выгрузка тестов");
$APPLICATION->SetPageProperty("description", "Выгрузка тестов");
$APPLICATION->SetTitle("Выгрузка тестов");
?><div id="textBlcok">
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>

<h2>Вопросы и ответы из "Тест для сервис-инженеров"</h2>
<?
if (CModule::IncludeModule("learning")){ 
		// id теста (8 - Тест для сервис-инженеров)
		$Test_ID = 8; 

			$resQ = CLQuestion::GetList(
				Array("SORT"=>"ASC"), 
				Array("ACTIVE" => "Y", "LESSON_ID" => [24, 25])
			);
			$x = 1;
			while ($arQuestion = $resQ->GetNext())
			{
				 console_log($arQuestion);
				echo "<i>(".$arQuestion["NAME"].") </i><b>".$arQuestion["DESCRIPTION"]."</b>"; 
				echo "<br>"; 
				$x++;

				$resA = CLAnswer::GetList(
					Array("SORT"=>"ASC"), 
					Array("QUESTION_ID" => $arQuestion["ID"])
				);

				while ($arAnswer = $resA->GetNext())
				{
					if ($arAnswer["CORRECT"] == "Y") {
						echo "[ + ]";
					} else { 
						echo "[ - ]";
					}
					echo " : ".$arAnswer["ANSWER"]."<br>";
				}
				echo "<br>"; 

			}
		// while ($arTest = $res->GetNext())
		// {
		// 	console_log($arTest);
		// 	echo "arTest name: ".$arTest["NAME"]."<br>";
		// 	echo "arTest ID: ".$arTest["ID"]."<br>";
		// 	echo "<br>";
		// } 
}?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>