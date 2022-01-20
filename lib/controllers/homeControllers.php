<?php

namespace hwhome\lib\controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/layout/layout.class.php';

/* use */

use hwhome\lib\layout as layout;
use hwhome\lib\models\dbModels as dbModels;
use home\ubuntu\config\commondb as db;

class homeControllers extends dbModels
{
    public function home()
    {
        //게시판 리스트
        $viewNum = 3;
        $page = max(intval($_GET['page'] ?? 1),1);
        $pdo = parent::pdo();

        //$board['postStatus'] === 'del'
        //del 제외 keep만 보여주기
        $boardView = $pdo->prepare(db::read('hwhome_board', '*', 'WHERE postStatus = "KEEP" ORDER BY idx DESC LIMIT :pageNum, :viewNum'));
        $boardView->bindValue(':pageNum', (($page-1) * $viewNum), $pdo::PARAM_INT);
        $boardView->bindValue(':viewNum', $viewNum, $pdo::PARAM_INT);
        $boardView->execute();
        $results = $boardView->fetchAll();

        //keep idx용 쿼리
        $boardKeepViewIdx = $pdo->prepare(db::read('hwhome_board', '*', 'WHERE postStatus = "KEEP" ORDER BY idx DESC'));
        $boardKeepViewIdx->execute();
        $boardKeepViewIdxResult = $boardKeepViewIdx->fetchAll($pdo::FETCH_ASSOC);

        //운영자용 게시판 쿼리
        $boardViewOperator = $pdo->prepare(db::read('hwhome_board', '*', 'ORDER BY idx DESC LIMIT :pageNum, :viewNum'));
        $boardViewOperator->bindValue(':pageNum', (($page-1) * $viewNum), $pdo::PARAM_INT);
        $boardViewOperator->bindValue(':viewNum', $viewNum, $pdo::PARAM_INT);
        $boardViewOperator->execute();
        $boardViewOperatorResult = $boardViewOperator->fetchAll($pdo::FETCH_ASSOC);

        //all idx
        $idx = $pdo->prepare(db::read('hwhome_board', '(idx)'));
        $idx->execute();
        $boardAllIdx = $idx->fetchAll();

        // 초기 레이아웃 설정
        layout::htmlStart();
        $file = [
            '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">',
            '<link rel="stylesheet" href="resources/style/main.css">'
        ];
        layout::head('home', $file);
        layout::layoutContent('views/home.tpl', compact(results, boardViewOperatorResult, boardAllIdx, boardKeepViewIdxResult, viewNum, page));
        layout::htmlEnd();
    }
}