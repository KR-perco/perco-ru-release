<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
	"GROUPS" => array(
		"SITE_MAP_PARAMS" => array(
			"NAME" => GetMessage("MAIN_SITE_MAP_PARAMS_NAME"),
		),
	),
	
	"PARAMETERS" => array(
		"LEVEL" => array(
			"NAME" => GetMessage("COMP_MAIN_SITE_MAP_LEVEL_NAME"), 
			"TYPE" => "LIST",
			"VALUES" => array("_COUNTERS.php", "_COUNTERS_HEAD.php", "_COUNTERS_BODY.php"),
			"DEFAULT" => "0",
			"PARENT" => "SITE_MAP_PARAMS",
		)
	),
);
?>