<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = array(
    'PARAMETERS' => [
        'IBLOCK_ID' => [
            "PARENT" => "BASE",
            "NAME" => 'Id инфоблока',
            "TYPE" => "TEXT",
            "DEFAULT" => '',
        ],
        'PRODUCT_ID'=>[
            "PARENT" => "BASE",
            "NAME" => 'Id товара',
            "TYPE" => "TEXT",
            "DEFAULT" => '',
        ],
    ],
);