<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

/* use */
use hwhome\lib\controllers\boardWritingControllers as boardWritingControllers;

/* 레이아웃 시작 */
boardWritingControllers::home();


