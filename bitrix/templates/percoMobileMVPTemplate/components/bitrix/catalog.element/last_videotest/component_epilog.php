<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
global $lastModified;
if (!$lastModified)
	$lastModified = MakeTimeStamp($arResult["TIMESTAMP_X"]);
else
	$lastModified = max($lastModified, MakeTimeStamp($arResult["TIMESTAMP_X"]));
?>