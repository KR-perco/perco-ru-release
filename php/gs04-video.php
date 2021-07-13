<div class="turnikets-video" id="video">
	<?/*
	$iblocks2 = GetIBlockList("video", "video_files");
	if($arIBlock = $iblocks2->Fetch())
		$block_id2 = $arIBlock["ID"];
		$autoplay = 0;
	$APPLICATION->IncludeComponent("bitrix:catalog.element", "last_video_youtube", array(
		"IBLOCK_ID" => $block_id2,
		"ELEMENT_ID" => "26956",
		"AUTOSTART" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		),
		false
	);*/
	?>
	<style>
		.shlag-desc {margin-block-start: 24px;}
		.vid-ban-block {display: flex; flex-wrap: wrap; justify-content: space-between; margin-block-start: 32px; max-inline-size: 1116px;}
		.iframe-wrap {inline-size: 50%;}
		.iframe {position: relative; padding-block-end: 305px; width: 100%; height: 0;}
		iframe {position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block; margin: auto; max-width: 100%;}
		@media (max-width: 1140px) {
			.vid-ban-block {flex-direction: column; align-items: center; gap: 16px;}
			.iframe-wrap {inline-size: auto; max-inline-size: 100%;}
			.iframe {inline-size: 545px; max-inline-size: 100%; padding-block-end: 308px;}
			.vid-ban-block__img {max-inline-size: 100%;}
		}
		@media (max-width: 568px) {
			.iframe {padding-block-end: 56%;}
		}
	</style>
	<div class="shlag-desc">Шлагбаум PERCo-GS04 предназначен для контроля въезда на территорию промышленных предприятий и бизнес-центров, коттеджных поселков и жилых комплексов, автостоянок и других объектов.</div>
	<div class="vid-ban-block">
		<div class="iframe-wrap">
			<div class="iframe">
				<iframe src="https://www.youtube.com/embed/xKFm7QNyf2o?rel=0" frameborder="0" allowfullscreen=""></iframe>
			</div>
			<p><a href="/video/gs04.mp4" title="Шлагбаум PERCo-GS04" download>Скачать</a> <?='('.printFileInfo('/video/gs04.mp4', "size").')';?> — <?='10.06.2020 12:48:00';?></p>
		</div>
		<a href="https://barrier.perco.ru/">
			<img class="vid-ban-block__img" src="/images/products/boom-barrier/shlagbaum-site-banner-545.jpg" alt="Шлагбаум PERCo-GS04">
		</a>
	</div>
</div>