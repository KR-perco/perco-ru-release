<?php
ob_start();
$APPLICATION->IncludeFile("/include/trebovaniya-dlya-po.php", Array(), Array(
	"MODE"      => "html",
	"NAME"      => "Редактировать требования для ПО"
));
$php_result = ob_get_contents();
ob_end_clean();