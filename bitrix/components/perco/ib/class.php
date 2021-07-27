<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

\Bitrix\Main\Loader::includeModule('iblock');

class Ib extends CBitrixComponent
{
	private function getProps($elemId) //возвращает свойства элемента
	{
		/*$items = [];
		foreach ($this->arParams['ELEM_PROPS'] as $propName) {
			$res = CIBlockElement::GetProperties($this->arParams['IB_ID'], $elemId, false, ['CODE' => 'YOUTUBE']);
			$i = 0;
			while ($prop = $res->GetNext()) {
				$items[] = $prop;
				
				if (!$prop) continue;
				foreach ($this->arParams['PROP_FIELDS'] as $field) {
					if (!$prop[$field]) continue;
					$items[$propName][$i][$field] = $prop[$field];
				}
				$i++;
			}
		}
		return $items;*/
		/*$filert = [
			'IBLOCK_ID' => $this->arParams['IB_ID'],
			'ID' => $elemId,
		];
		$select = [
			'IBLOCK_ID', 'ID',
		];
		foreach ($this->arParams['ELEM_PROPS'] as $prop) {
			$select[] = 'PROPERTY_' . $prop;
		}
		$res = CIBlockElement::getList([], $filert, false, false, $select);
		$items = [];
		while ($item = $res->GetNextElement()) {
			foreach ($this->arParams['ELEM_PROPS'] as $propName) {
				$props = $item->GetProperties(false, ['CODE' => $propName,]);
			}
			$props = $item->GetProperties(false, ['CODE' => 'YOUTUBE', 'CODE' => 'FILE']);
			foreach ($props as $propName => $prop) {
				foreach ($this->arParams['PROP_FIELDS'] as $field) {
					$items[$propName][$field] = $props[$propName][$field][0];
				}
			}
		}
		return $items;*/
	}
	
	private function getElems($sectId = false) //возвращает элементы из заданного раздела
	{
		$filert = [
			'IBLOCK_ID' => $this->arParams['IB_ID'],
			'IBLOCK_SECTION_ID' => $sectId,
		];
		$select = [
			'ID',
		];
		array_push($select, ...$this->arParams['ELEM_FIELDS']);
		$res = \Bitrix\Iblock\ElementTable::getList([
			'filter' => $filert,
			'select' => $select,
		]);
		$items = [];
		while ($item = $res->fetch()) {
			$id = $item['ID'];
			unset($item['ID']);
			$item['PROPS'] = $this->getProps($id);
			$items[$id] = $item;
		}
		return $items;
	}
	
	private function getTree() //возвращает элементы и разделы инфоблока в виде дерева в массиве
	{
		$filert = [
			'IBLOCK_ID' => $this->arParams['IB_ID'],
		];
		$select = [
			'ID', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID',
		];
		array_push($select, ...$this->arParams['SECT_FIELDS']);
		$res = \Bitrix\Iblock\SectionTable::getList([
			'filter' => $filert,
			'select' => $select,
		]);
		$items = [];
		$depth = 1;
		while ($item = $res->fetch()) {
			$id = $item['ID'];
			unset($item['ID']);
			$item['ELEMS'] = $this->getElems($id);
			$items[$id] = $item;
			if ($depth < $item['DEPTH_LEVEL']) $depth = $item['DEPTH_LEVEL'];
		}
		for (; $depth > 1; $depth--) {
			foreach ($items as $id => $item) {
				if ($item['DEPTH_LEVEL'] != $depth) continue;
				$items[$item['IBLOCK_SECTION_ID']]['SECTS'][$id] = $item;
				unset($items[$id]);
			}
		}
		return $items;
	}
	
	public function executeComponent()
	{
		//$this->arResult['FIELDS'] = $this->arParams['FIELDS'];
		//$this->arResult['PROPS'] = $this->arParams['PROPERTIES'];
		if ($this->arParams['GET_TREE'] == 'Y') $this->arResult['TREE'] = $this->getTree();
		$this->includeComponentTemplate();
	}
}