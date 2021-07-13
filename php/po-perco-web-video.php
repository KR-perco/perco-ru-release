<div class="turnikets-video" id="video">
<?
	$iblocks2 = GetIBlockList("video", "video_files");
	if($arIBlock = $iblocks2->Fetch())
		$block_id2 = $arIBlock["ID"];
		$autoplay = 0;
	$APPLICATION->IncludeComponent("bitrix:catalog.element", "last_video_youtube", array(
		"IBLOCK_ID" => $block_id2,
		"ELEMENT_ID" => "25329",
		"AUTOSTART" => "N",
		"DISPLAY_NAME" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N"
		),
		false
	);
?>
</div>