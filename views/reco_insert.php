<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;

$pdo = dbModels::pdo();

try {
    //추천수 관련 멤버 정보 및 게시판 변수
    $member_idx = hwhome\lib\controllers\loginControllers::$loginArr['member_idx'];

    //board_idx 검증 (이전 페이지 board_idx와 함께 비교검증)
    if ($_GET['board_idx'] === explode('?board_idx=', $_SERVER['HTTP_REFERER'])[1]) {
        $board_idx = $_GET['board_idx'];

        //추천수 불러오는 쿼리
        $likeQuery = $pdo->prepare(db::read('hwhome_reco', 'detail_reco', 'WHERE board_idx = :board_idx ORDER BY idx desc limit 1'));
        $likeQuery->bindValue(':board_idx', $board_idx ? $board_idx : 0, $pdo::PARAM_INT);
        $likeQuery->execute();
        $likeQueryResult = $likeQuery->fetchAll($pdo::FETCH_ASSOC);

        //추천수 관련 변수
        $reco = sizeof($likeQueryResult[0]['detail_reco']) ? $likeQueryResult[0]['detail_reco'] : 0;

        //추천수 넣는 쿼리
        $sql = $pdo->prepare(db::create( 'hwhome_reco (board_idx, member_idx, detail_reco)' , $board_idx .'","'. $member_idx.'","'. ++$reco ));
        $sql->execute();

    } else {
        //board_idx가 이전 페이지와 다른 경우 예외처리 
        echo "
            <script>
            alert('추천 페이지에 접근할 수 없습니다.');
             window.location = '../index.php';
            </script>";
    }

    //멤버 idx가 있는 경우. (=로그인 한 경우) 예외처리
    if(sizeof(\hwhome\lib\controllers\loginControllers::$loginArr['member_idx'])) {
        header("Location: /hwhome/layout/board_detail.php?board_idx=".$board_idx);
    } else {
        echo "
            <script>
            alert('로그인 후 추천할 수 있습니다.');
             window.location = '../layout/member_login.php';
            </script>
        ";
    }

} catch (Exception $e) {
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
}

