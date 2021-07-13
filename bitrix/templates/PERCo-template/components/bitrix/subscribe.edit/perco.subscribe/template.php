<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<script>
	(() => {
		window.addEventListener('load', () => {
			if (document.querySelector('.errortext') && document.querySelector('.errortext') != '' && (window.location.search.match(/action=confirm/gi) || window.location.search.match(/action=unsubscribe/gi))) {
				console.log('daa');
				console.log(document.querySelector('h1'));
				document.querySelector('h1').innerText = 'ОШИБКА';
			}
		});
	})();
</script>
<div class="subscribe-edit">
<?
/*?>
<pre style="display: none;">
	<?
	echo 'message';
	foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
	echo 'error';
	foreach($arResult["ERROR"] as $itemID=>$itemValue)
	echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));
	?>
</pre>
<?
if (preg_match('/subscription\.php/', $_SERVER['REQUEST_URI'])) {
	switch ($_GET['action']) {
	case 'unsubscribe':
		?>
		<h1>ПОДПИСКА ОТМЕНЕНА</h1>
		<?
		break;
	case 'confirm':
		?>
		<h1>АДРЕС ПОДТВЕРЖДЕН</h1>
		<?
		break;
	default: 
		?>
		<h1>СТРАНИЦА НЕ НАЙДЕНА</h1>
		<p>Приносим свои извинения, но страница с таким адресом не найдена.<br />Возможно, она временно недоступна, удалена или её адрес был изменен.</p>
		<?
	}
}
*/
if ($arResult['MESSAGE']['UNSUBSCR'] !== 'Подписка помечена как неактивная. Рассылки на этот адрес производиться не будут.') {
	foreach($arResult["MESSAGE"] as $itemID=>$itemValue)
		echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"OK"));
	foreach($arResult["ERROR"] as $itemID=>$itemValue)
		echo ShowMessage(array("MESSAGE"=>$itemValue, "TYPE"=>"ERROR"));
}

include("setting.php");
?>
</div>