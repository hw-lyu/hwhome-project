<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;

$pdo = dbModels::pdo();
$member_id = sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id']) ? hwhome\lib\controllers\loginControllers::$loginArr['member_id'] : 0;
$fetch_json = json_decode(file_get_contents('php://input'));

try {
    $comment_idx = $fetch_json->idx;

    $commentDel = $pdo->prepare(db::update('hwhome_comment', 'commentStatus = "del"', 'idx='.$comment_idx));
    $commentDel->execute();

} catch (Exception $e) {
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
}