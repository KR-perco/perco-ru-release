<?
	$key = "zdT,\BfO>N";
	$hash = hash_hmac('md5', GetMessage("YOUTUBE"), $key, false);
	$youtube = '//'.SITE_SERVER_NAME.'/redirect.php?site='.GetMessage("YOUTUBE").'&hash='.$hash;
	$hash = hash_hmac('md5', GetMessage("TWITTER"), $key, false);
	$twitter = '//'.SITE_SERVER_NAME.'/redirect.php?site='.GetMessage("TWITTER").'&hash='.$hash;
	$hash = hash_hmac('md5', GetMessage("INSTAGRAM"), $key, false);
	$instagram = '//'.SITE_SERVER_NAME.'/redirect.php?site='.GetMessage("INSTAGRAM").'&hash='.$hash;
?>
	</main>
	<footer itemscope itemtype="https://schema.org/WPFooter">
		<div id="footer_content">
			<div id="footer_logo"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/logo.svg");?></div>
			<div id="phone">
				<img alt="<?GetMessage("PHONE_TEXT");?>" src="/images/icons/phone.svg" width="20" height="20"/> <a href="tel:<?=str_replace('-', '', str_replace(')', '', str_replace('(', '', str_replace(' ', '', GetMessage("PHONE")))));?>" class="footer-tel"><?=GetMessage("PHONE");?></a>
			</div>
			<div id="socseti">
				<a href="<?=$youtube;?>" target="_blank" rel="nofollow">
					<img alt="youtube" src="/images/icons/youtube.svg" width="48" height="20"/>
				</a>
				<a href="<?=$instagram;?>" target="_blank" rel="nofollow">
					<img alt="instagram" src="/images/icons/instagram.svg" width="25" height="20"/>
				</a>
				<a href="<?=$server.GetMessage("RSS")?>rss.php" target="_blank">
					<img alt="RSS" src="/images/icons/rss.svg" width="20" height="20"/>
				</a>
			</div>
			<div id="sitemap"><a href="/<?=translitIt(strtolower(GetMessage("SITEMAP")));;?>.php"><img alt="<?=GetMessage("SITEMAP");?>" src="/images/icons/sitemap.svg" width="28" height="26"/><span><?=GetMessage("SITEMAP");?></span></a></div>
		</div>
	</footer>
	
	<div class="cookie-warning" id="cookie-warning">
		<div class="block">
			<div class="text">
				<p>OOO «ПЭРКо»  <!--a href="/politika-konfidentsialnosti/cookies.php">использует файлы «cookie»</a-->использует файлы «cookie» с целью персонализации сервисов и повышения удобства пользования веб-сайтом. «Cookie» представляют собой небольшие файлы, содержащие информацию о предыдущих посещениях веб-сайта.</p>
				<p>Если вы не хотите использовать файлы «cookie», измените настройки браузера.</p>
			</div>
			<div class="close" onclick="closeWarning()">
				<span class="icon"></span>
			</div>
		</div>
	</div>
	<div class="cookie-warning" id="cookie-warning-en">
		<div class="block">
			<div class="text">
				<p>«PERCo» <a href="/privacy-policy/cookies.php">uses «cookie» files</a> to personalize the services and to increase website usability. «Cookies» are little text files containing information about previous website visits.</p>
				<p>If you don't want to use «cookie» files, please change browser settings. </p>
			</div>
			<div class="close" onclick="closeWarning()">
				<span class="icon"></span>
			</div>
		</div>
	</div>
</body>
</html>