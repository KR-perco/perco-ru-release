<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="feed">
	<h2><?=GetMessage("H1");?></h2>
	<ul>
<?
global $server;
foreach($arResult["ITEMS"] as $arItem)
{
?>
		<li>
			<a href="<?=$server.$arItem["DETAIL_PAGE_URL"];?>">
				<div class="anons_img">
					<img width="280" height="107" alt="<?=$arItem["NAME"];?>" src="<?=$arItem["PROPERTIES"]["ANONS_IMG"]["VALUE"];?>" />
				</div>
				<div class="anons_text">
					<p class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></p>
					<p class="news_name"><?=$arItem["NAME"];?></p>
					<p class="news_text"><?=$arItem["PREVIEW_TEXT"];?></p>
				</div>
			</a>
		</li>
<?}?>
	</ul>
</div>