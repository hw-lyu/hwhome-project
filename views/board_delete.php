<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;

$pdo = dbModels::pdo();

try {

    if($_GET['board_idx'] === explode('?board_idx=', $_SERVER['HTTP_REFERER'])[1]) {
        $boardIdx = $_GET['board_idx'];
        $boardDelete = $pdo->prepare(db::update('hwhome_board', 'postStatus = "del"', 'idx='.$boardIdx));
        $boardDelete->execute();
        //$boardDelete->errorInfo()
        header("Location: /hwhome/index.php");
    } else {
        //board_idx가 이전 페이지와 다른 경우 예외처리
        echo "
            <script>
            alert('삭제 페이지에 접근할 수 없습니다.');
             window.location = '../index.php';
            </script>";
    }

} catch (Exception $e) {
    $pdo->rollback();
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
}