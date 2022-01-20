<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;

$member_id = sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id']) ? hwhome\lib\controllers\loginControllers::$loginArr['member_id'] : 0;
$fetch_json = json_decode(file_get_contents('php://input'));

$pdo = dbModels::pdo();
try {
    if($member_id) {
        $sql = $pdo->prepare(db::create( 'hwhome_comment (member_id, content, board_idx, type, comment_group, comment_idx)' , $member_id .'","'. $fetch_json->comment_contnet.'","'. $fetch_json->board_idx.'","'. $fetch_json->type.'","'. '1'.'","'. $fetch_json->comment_idx ));
        $sql->execute();
    }
} catch (Exception $e) {
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
}