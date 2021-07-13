<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if (CModule::IncludeModule("iblock")) {
	$rsSeminarType = CIBlockElement::GetList(
		['SORT' => 'ASC'],
		['IBLOCK_CODE' => 'list_seminars_en', 'ACTIVE' => 'Y'],
		false,
		false,
		['ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE']
	);
	while($arSeminarType = $rsSeminarType->GetNextElement()) {
		$arSeminarTypeFields = $arSeminarType->GetFields();
		$arSeminarTypeProps = $arSeminarType->GetProperties();
		$rsSeminar = CIBlockElement::GetList(
			['ACTIVE_FROM' => 'DESC'],
			['IBLOCK_CODE' => 'seminars_en', 'ACTIVE' => 'Y', 'PROPERTY_SEMINAR' => $arSeminarTypeFields['ID']],
			false,
			false,
			['ID', 'IBLOCK_ID', 'ACTIVE_FROM', 'ACTIVE_TO']
		);
		if ($arSeminar = $rsSeminar->GetNextElement()) {
			$arSeminarFields = $arSeminar->GetFields();
			$arSeminarProps = $arSeminar->GetProperties();
			if ($arSeminarProps['NOTIFICATION_STATE']['VALUE'] == 'N') {
				$timeFrom = date_create_from_format('d.m.Y H:i:s', $arSeminarFields['ACTIVE_FROM']);
				$timeTo = date_create_from_format('d.m.Y H:i:s', $arSeminarFields['ACTIVE_TO']);
				$timestampNotification = $timeFrom->gettimestamp() + 3 * 3600 - intval($arSeminarProps['NOTIFICATION_TIME']['VALUE']) * 3600 - intval($arSeminarProps['GMT']['VALUE']) * 3600;
				if ($timestampNotification < time()) {
					$el = new CIBlockElement;
					$PROP = array();
					$PROP[668] = $arSeminarProps['SEMINAR']['VALUE'];
					$PROP[674] = $arSeminarProps['GMT']['VALUE'];
					$PROP[675] = $arSeminarProps['LINK']['VALUE'];
					$PROP[684] = $arSeminarProps['NOTIFICATION_TIME']['VALUE'];
					$PROP[685] = 'Y';
					$arLoadProductArray = Array(
						"PROPERTY_VALUES"=> $PROP
					);
					$el->Update($arSeminarFields['ID'], $arLoadProductArray);
					$rsStudent = CIBlockElement::GetList(
						['ACTIVE_FROM' => 'DESC'],
						['IBLOCK_CODE' => 'students_en', 'ACTIVE' => 'Y', 'PROPERTY_SEMINAR' => $arSeminarFields['ID']],
						false,
						false,
						['ID', 'IBLOCK_ID', 'NAME']
					);
					while ($arStudent = $rsStudent->GetNextElement()) {
						$arStudentFields = $arStudent->GetFields();
						$arStudentProps = $arStudent->GetProperties();
						$arEventFields = [
							"EMAIL" => $arStudentFields['NAME'],
							"NAME" => $arSeminarTypeFields['NAME'],
							"DATE" => $timeFrom->format('d.m.y'),
							"DURATION" => $timeFrom->format('g:ia') . ' - ' . $timeTo->format('g:ia'),
							"GMT" => sprintf('%+d', $arSeminarProps['GMT']['VALUE']),
							"LINK" => $arSeminarProps['LINK']['VALUE'],
							"IMAGE" => 'https://perco.com' . CFile::GetPath($arSeminarTypeFields['PREVIEW_PICTURE']),
							"DESCRIPTION" => str_replace(['&lt;', '&gt;'], ['<', '>'], $arSeminarTypeProps['NOTIFICATION_DESCRIPTION']['VALUE'])
						];
						CEvent::Send("TRAINING_NOTE_EN_NEW", "s5", $arEventFields); //189
					}
				}
			}
		}
	}
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>