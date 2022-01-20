<?php

namespace hwhome\lib\controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/layout/layout.class.php';

/* use */
use hwhome\lib\layout as layout;
use hwhome\lib\models\dbModels as dbModels;
use home\ubuntu\config\commondb as db;

class boardDetailControllers extends dbModels
{
    public function home() {
        //database
        //게시판 삭제 아닌 keep 일 경우 쿼리
        $pdo = parent::pdo();
        $boardDetail = $pdo->prepare(db::read('hwhome_board', '*', 'WHERE postStatus = "KEEP"'));
        $boardDetail->execute();
        $results = $boardDetail->fetchAll();

        //운영자용 게시판 디테일 쿼리
        $boardDetailOperator = $pdo->prepare(db::read('hwhome_board', '*'));
        $boardDetailOperator->execute();
        $boardDetailOperatorResults = $boardDetailOperator->fetchAll();

        //디테일 영역 뷰단
        $idx = $_GET['board_idx'];

        foreach($results as $board) {
            if ($idx === $board['idx']) :
                $boardViews = $pdo->prepare(db::update('hwhome_board', 'views='.addslashes(++$board['views']), 'idx='.$board['idx']));
                $boardViews->execute();
            endif;
        }

        //좋아요한 사람들 쿼리
        $memId = \hwhome\lib\controllers\loginControllers::$loginArr['member_idx'];
        $likeInnerJoin = $pdo->prepare('SELECT hwhome_board.idx, hwhome_board.reco, hwhome_reco.board_idx, hwhome_reco.detail_reco, hwhome_board.writerIdx, hwhome_reco.member_idx FROM hwhome_board INNER JOIN hwhome_reco ON hwhome_board.idx = hwhome_reco.board_idx WHERE hwhome_reco.member_idx = :member_idx AND hwhome_reco.board_idx = :board_idx');
        $likeInnerJoin->bindValue(':member_idx', $memId ? $memId : 0, $pdo::PARAM_INT);
        $likeInnerJoin->bindValue(':board_idx', $idx ? $idx : 0, $pdo::PARAM_INT);
        $likeInnerJoin->execute();
        $likeInnerJoinResult = $likeInnerJoin->fetchAll($pdo::FETCH_ASSOC);

        //좋아요 갯수 뽑아주는 쿼리
        $likeQuery = $pdo->prepare(db::read('hwhome_reco', 'detail_reco', 'WHERE board_idx = :board_idx ORDER BY idx desc limit 1'));
        $likeQuery->bindValue(':board_idx', $idx ? $idx : 0, $pdo::PARAM_INT);
        $likeQuery->execute();
        $likeQueryResult = $likeQuery->fetchAll($pdo::FETCH_ASSOC);

        //좋아요 - main 리스트 like query update 서브쿼리 처리 (쿼리 순서에 따라 영향을 받음)
        $boardLike = $pdo->prepare("UPDATE hwhome_board SET reco = (SELECT detail_reco FROM hwhome_reco ORDER BY idx DESC LIMIT 1) WHERE hwhome_board.idx = (SELECT board_idx FROM hwhome_reco ORDER BY idx DESC LIMIT 1)");
        $boardLike->execute();

        //운영자용 코멘트 디테일 쿼리
        $commentOperator = $pdo->prepare(db::read('hwhome_comment', '*', 'WHERE board_idx = :board_idx ORDER BY comment_idx desc limit 100'));
        $commentOperator->bindValue(':board_idx', $idx ? $idx : 0, $pdo::PARAM_INT);
        $commentOperator->execute();
        $commentOperatorResult = $commentOperator->fetchAll($pdo::FETCH_ASSOC);

        //코멘트 삭제 아닌 keep 일 경우 쿼리
        $commentKeepQuery = $pdo->prepare(db::read('hwhome_comment', '*', 'WHERE board_idx = :board_idx AND commentStatus = "KEEP" ORDER BY comment_idx desc limit 100'));
        $commentKeepQuery->bindValue(':board_idx', $idx ? $idx : 0, $pdo::PARAM_INT);
        $commentKeepQuery->execute();
        $commentKeepQueryResults = $commentKeepQuery->fetchAll();

        // 초기 레이아웃 설정
        layout::htmlStart();
        $file = [
            '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">',
            '<link rel="stylesheet" href="/resources/style/main.css">',
            '<script src="/resources/js/reco.js"></script>',
            '<script src="/resources/js/comment.js"></script>'
        ];
        layout::head('detail', $file);
        layout::layoutContent('views/board_detail.tpl', compact(results, boardDetailOperatorResults, boardDetailDeleteResults, idx, likeInnerJoinResult, likeQueryResult, commentKeepQueryResults, commentOperatorResult));
        layout::htmlEnd();
    }
}