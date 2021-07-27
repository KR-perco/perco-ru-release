<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arResult["arMap"]==0) $arResult["arMap"]='_COUNTERS.php';
elseif ($arResult["arMap"]==1) $arResult["arMap"]='_COUNTERS_HEAD.php';
elseif ($arResult["arMap"]==2) $arResult["arMap"]='_COUNTERS_BODY.php';
include ($_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.$arResult["arMap"]);
echo "\n<!--end-->";