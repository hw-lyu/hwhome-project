<?php

namespace hwhome\lib\controllers;
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/layout/layout.class.php';

/* use */
use hwhome\lib\layout as layout;
use hwhome\lib\models\dbModels as dbModels;
use home\ubuntu\config\commondb as db;

class memberLoginControllers extends dbModels
{
    public function home()
    {
        // 초기 레이아웃 설정
        layout::htmlStart();
        $file = [
            '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">',
            '<link rel="stylesheet" href="/resources/style/main.css">'
        ];

        layout::head('login', $file);
        layout::layoutContent('views/member_login.tpl');
        layout::htmlEnd();
    }
}