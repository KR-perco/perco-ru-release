<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Страница для тестов и вывода тестовых данных | PERCo");
$APPLICATION->SetPageProperty("description", "Тест ссписка расылки"); 
$APPLICATION->SetTitle("Тест ссписка рассылки | PERCo");
  
?>
<?
$file = file_get_contents('../sendmail-imennaya.json'); // Открыть файл
$maillist = json_decode($file, true); // Декодировать в массив
unset($file); // Очистить переменную $file
 
?>  
<script>
	window.euro = <?= round(getCurrency("EUR")) ?>;
	window.date = '<?= date('d.m.y'); ?>';
</script>
 
	<div class="maillist">
		<table>
			
		
	<?
		console_log($maillist['maillist']);
		$i = 0;
		foreach ($maillist['maillist'] as $customer) {
			
			$i++;
			echo "<tr>"; 
			echo "<td>".$i."</td>";
			echo "<td>".$customer['company']."</td>";
			echo "<td>".$customer['mail']."</td>";
			echo "<td>".$customer['fio']."</td>";  
			echo "<tr>"; 
		  } 

		?>
		</table>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>