<?php
$arUrlRewrite=array (
  1 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  18 => 
  array (
    'CONDITION' => '#^/video/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1&videoconf',
    'ID' => 'bitrix:im.router',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/fotogalereya/(.*).php(.*)#',
    'RULE' => '/fotogalereya/details.php?TYPE_OBJECT=$1',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/percoMobile/products/(.*)#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/percoMobile/products/details.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/percoDemo/products/(.*)#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/percoDemo/products/details.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/novosti/articles/(.*)/#',
    'RULE' => '/novosti/articles/details.php?ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^(.*)/video/(.*).php(.*)#',
    'RULE' => '/o-kompanii/video/details.php?CODE=$2',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/gde-kupit/(.*)/.*#',
    'RULE' => '/gde-kupit/details.php?country=$1',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/novosti/(.*).php#',
    'RULE' => '/novosti/details.php?ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/resheniya/(.*)/#',
    'RULE' => '/resheniya/details.php?ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/podderzhka/faq/#',
    'RULE' => '',
    'ID' => 'bitrix:support.faq',
    'PATH' => '/podderzhka/faq/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/news/(.*)/#',
    'RULE' => '/rewriteurl.php?ID=$1',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/products/details.php',
    'SORT' => 100,
  ),
);
