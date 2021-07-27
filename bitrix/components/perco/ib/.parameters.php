<?php
$arComponentParameters = [
	'GROUPS' => [
		'DATA_SOURCE' => [
			'NAME' => 'Источник данных',
		],
		'DATA' => [
			'NAME' => 'Выбираемые данные',
		],
	],
	'PARAMETERS' => [
		'IB_ID' => [
			'PARENT' => 'DATA_SOURCE',
			'NAME' => 'Идентификатор инфоблока',
			'TYPE' => 'STRING',
			'MULTIPLE' => 'N',
			'COLS' => 8
		],
		'SECT_ID' => [
			'PARENT' => 'DATA_SOURCE',
			'NAME' => 'Идентификатор раздела',
			'TYPE' => 'STRING',
			'MULTIPLE' => 'N',
			'COLS' => 8
		],
		'FIELDS' => [
			'PARENT' => 'DATA',
			'NAME' => 'Выбираемые поля',
			'TYPE' => 'STRING',
			'MULTIPLE' => 'Y',
			'COLS' => 8
		],
		'PROPERTIES' => [
			'PARENT' => 'DATA',
			'NAME' => 'Выбираемые свойства',
			'TYPE' => 'STRING',
			'MULTIPLE' => 'Y',
			'COLS' => 8
		],
	],
];