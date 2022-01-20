<?php
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/layout/layout.class.php';

/* use */
use hwhome\lib\layout as layout;

// 초기 레이아웃 설정
layout::htmlStart();
$file = [
    '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">',
    '<link rel="stylesheet" href="/resources/style/main.css">'
];
layout::head('error', $file);
layout::layoutContent('views/error.tpl');
layout::htmlEnd();