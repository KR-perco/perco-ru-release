<?
$host = $_SERVER["HTTP_HOST"]; //хост
$pattern = '/.*\.local$/';  //проверка на локал
if (!preg_match ($pattern, $host))
{
	switch($host)
	{
		case "www.perco.ru":
			$google_id = "UA-662209-8";
			$yandex_id = "176255";
			break;
		case "www.perco.com":
			$google_id = "UA-662209-22";
			$yandex_id = "22880947";
			break;
		case "de.perco.com":
			$google_id = "UA-662209-23";
			$yandex_id = "22880524";
			break;
		case "fr.perco.com":
			$google_id = "UA-662209-19";
			$yandex_id = "22880554";
			break;
		case "it.perco.com":
			$google_id = "UA-662209-21";
			$yandex_id = "22880605";
			break;
		case "es.perco.com":
			$google_id = "UA-662209-20";
			$yandex_id = "22880581";
			break;
		case "www.schoolsystem.ru":
			$google_id = "UA-662209-17";
			$yandex_id = "9499774";
			break;
		default:
			$google_id = "";
			break;
	}
	if ($google_id)
	{
?>
<script type="text/javascript">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', '<?=$google_id;?>', 'auto');
	ga('send', 'pageview');
</script>
<?	}
	if ($yandex_id)
	{
?>
<?/*<!-- Yandex.Metrika counter -->
<script type="text/javascript">
	(function (d, w, c) {
		(w[c] = w[c] || []).push(function() {
			try {
				w.yaCounter<?=$yandex_id;?> = new Ya.Metrika({
					id:<?=$yandex_id;?>,
					clickmap:true,
					trackLinks:true,
					accurateTrackBounce:true,
					webvisor:true
				});
			} catch(e) { }
		});

		var n = d.getElementsByTagName("script")[0],
			s = d.createElement("script"),
			f = function () { n.parentNode.insertBefore(s, n); };
		s.type = "text/javascript";
		s.async = true;
		s.src = "https://mc.yandex.ru/metrika/watch.js";

		if (w.opera == "[object Opera]") {
			d.addEventListener("DOMContentLoaded", f, false);
		} else { f(); }
	})(document, window, "yandex_metrika_callbacks");
</script>
<!-- /Yandex.Metrika counter -->*/?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(<?=$yandex_id;?>, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/<?=$yandex_id;?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<? } } ?>