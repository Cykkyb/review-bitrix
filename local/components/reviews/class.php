<?php
CModule::IncludeModule('iblock');

use Bitrix\Main\Loader;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class Reviews extends CBitrixComponent
{

    protected function getResult()
    {
        $arSelect = ["ID", "IBLOCK_ID", 'CODE', "NAME", 'PREVIEW_PICTURE',
            'PREVIEW_TEXT', 'PROPERTY_DATE', 'PROPERTY_USER_NAME',
            'PROPERTY_RATING', 'PROPERTY_PARAMS',
        ];
        $arFilter = [
            "IBLOCK_ID" => $this->arParams['IBLOCK_ID'],
            "PROPERTY_PRODUCT_ID" => $this->arParams['PRODUCT_ID'],
            "ACTIVE_DATE" => "Y",
            "ACTIVE" => "Y"
        ];

        $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 50], $arSelect);

        $arResult = [];
        $arIds = [];

        while ($element = $res->fetch()) {
            $arResult[] = $element;
            $arIds[] = $element['ID'];
        }

        foreach ($arResult as &$arItem) {
            $arItem['PREVIEW_PICTURE'] = CFile::GetPath($arItem['PREVIEW_PICTURE']);
        }

        $this->arResult['ITEMS'] = $arResult;
        $this->arResult['REVIEWS_LIKES'] = $this->addLikes($arIds);

        $this->includeComponentTemplate();
    }

    public function addLikes($arIds)
    {
        Loader::includeModule("highloadblock");

        global $USER;
        $user_id = $USER->GetID();

        $hlbl = 4;
        $hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $rsData = $entity_data_class::getList([
            "select" => ["*"],
            "order" => ["ID" => "ASC"],
            "filter" => ["UF_REVIEW_ID" => $arIds]
        ]);


        while ($element = $rsData->Fetch()) {
            $review_id = $element['UF_REVIEW_ID'];

            if ($element['UF_USER'] == $user_id) {
                $result[$review_id]['ACTIVE'] = $element['UF_LIKE'];
            }
            $result[$review_id]['LIKES'][] = $element;

            if($element['UF_LIKE'] == 'like'){
                $result[$review_id]['COUNTER']['LIKES']++;
            }
            if($element['UF_LIKE'] == 'dislike'){
                $result[$review_id]['COUNTER']['DISLIKES']++;
            }

        }
        return $result;
    }

    public function executeComponent()
    {
        $this->getResult();
    }
}





