<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("MAIN_SITE_MAP_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("MAIN_SITE_MAP_COMPONENT_DESCR"),
	"ICON" => "/images/map.gif",
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "my_components",
		"CHILD" => array(
			"ID" => "my_site_map",
			"NAME" => GetMessage("MAIN_SITE_MAP_GROUP_NAME"),
		),
	),
);
?>