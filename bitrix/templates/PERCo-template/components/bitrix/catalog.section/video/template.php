<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php
	if ($arParams['AJAX_QUERY'] == 'Y') {
		foreach($arResult['ITEMS'] as $i => $item) {
			$items[$i] = [];
			$items[$i]['name'] = $arResult['ITEMS'][$i]['NAME'];
			$items[$i]['description'] = htmlspecialchars_decode($arResult['ITEMS'][$i]['DISPLAY_PROPERTIES']['DESCRIPTION']['VALUE'][0]['TEXT']);
			$items[$i]['youtubeId']= $arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['YOUTUBE']["VALUE"][0];
			$items[$i]['fileLink'] = $arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0];
			$items[$i]['fileSize'] = round(filesize('/home/d/dc178435/public_html'.$arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0]) / 1048576, 2);
			$items[$i]['fileDate'] = date('d.m.Y', filemtime('/home/d/dc178435/public_html'.$arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0]));
			$items[$i]['posterLink'] = $arResult['ITEMS'][$i]['DISPLAY_PROPERTIES']['IMAGE']["VALUE"][0];
		}
		echo json_encode($items);
		exit();
	}
?>
<script>
	let templatePath = '<?= $this->GetFolder(); ?>';
</script>
<div class="video">
	<script>
		let items = [];
		(() => {
			window.addEventListener("load", () => {
				<?foreach($arResult['ITEMS'] as $i => $item) {?>
					items[<?= $i ?>] = {};
					items[<?= $i ?>].name = '<?= $arResult['ITEMS'][$i]['NAME']; ?>';
					items[<?= $i ?>].description = `<?= htmlspecialchars_decode($arResult['ITEMS'][$i]['DISPLAY_PROPERTIES']['DESCRIPTION']['VALUE'][0]['TEXT']); ?>`;
					items[<?= $i ?>].youtubeId = '<?= $arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['YOUTUBE']["VALUE"][0]; ?>';
					items[<?= $i ?>].fileLink = '<?= $arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0]; ?>';
					items[<?= $i ?>].fileSize = '<?= round(filesize('/home/d/dc178435/public_html'.$arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0]) / 1048576, 2); ?>';
					items[<?= $i ?>].fileDate = '<?= date('d.m.Y', filemtime('/home/d/dc178435/public_html'.$arResult['ITEMS'][$i]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0])); ?>';
					items[<?= $i ?>].posterLink = '<?= $arResult['ITEMS'][$i]['DISPLAY_PROPERTIES']['IMAGE']["VALUE"][0]; ?>';
				<? } ?>
			});
		})();
	</script>
	<div class="main-video">
		<iframe data-src="https://www.youtube.com/embed/KyKehb9KQIU?rel=0&amp;enablejsapi=1" frameborder="0" allowfullscreen="" src="https://www.youtube.com/embed/<?=$arResult['ITEMS'][0]["DISPLAY_PROPERTIES"]['YOUTUBE']["VALUE"][0]?>?rel=0&amp;enablejsapi=1" style="display: initial;"></iframe>
	</div>
	<div class="text">
		<h1><?=$arResult['ITEMS'][0]['NAME']?></h1>
		<div class="description">
			<?= htmlspecialchars_decode($arResult['ITEMS'][0]['DISPLAY_PROPERTIES']['DESCRIPTION']['VALUE'][0]['TEXT']); ?>
		</div>
		<div class="download">
			<a href="<?= $arResult['ITEMS'][0]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0] ?>" download>Скачать</a> (<?= round(filesize('/home/d/dc178435/public_html'.$arResult['ITEMS'][0]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0]) / 1048576, 2); ?> MB) — <?=date('d.m.Y', filemtime('/home/d/dc178435/public_html'.$arResult['ITEMS'][0]["DISPLAY_PROPERTIES"]['FILE']["VALUE"][0]));?>
		</div>
	</div>
	<div class="video-list">
		<?php foreach ($arResult['ITEMS'] as $i => $item) { ?>
			<div data-id="<?= $i ?>" <?php if ($i == 0) { ?>data-active<?php } ?> class="item">
				<img src="<?= $item['DISPLAY_PROPERTIES']['IMAGE']["VALUE"][0] ?>">
				<h3><?=$item['NAME']?></h3>
			</div>
		<?php } ?>
	</div>
</div>
<!--pre style="display: none;"><?var_dump($arResult['ITEMS'][0]["DISPLAY_PROPERTIES"]['DESCRIPTION']);?></pre-->