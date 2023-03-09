<?php
require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');
global $USER;
if (!$USER->IsAuthorized()) die();

use Bitrix\Main\Loader;

Loader::includeModule("highloadblock");

use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

$user_id = $USER->GetID();
$review_id = $_POST['data']['review_id'];

$hlbl = 4;
$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
$entity = HL\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$rsData = $entity_data_class::getList([
    "select" => ["*"],
    "order" => ["ID" => "ASC"],
    "filter" => ["UF_REVIEW_ID" => $review_id, "UF_USER" => $user_id]
]);

$result = [];

while ($element = $rsData->Fetch()) {
    $result = $element;
}

if (empty($result)) {
    $data = [
        "UF_REVIEW_ID" => $review_id,
        "UF_USER" => $user_id,
        "UF_LIKE" => $_POST['data']['like'],
    ];
    $result = $entity_data_class::add($data);
    return;
}


$like_status = false;

if ($result['UF_LIKE'] != $_POST['data']['like']) {
    $like_status = $_POST['data']['like'];
}

$result = $entity_data_class::update($result['ID'], ["UF_LIKE" => $like_status]);

echo 1;


