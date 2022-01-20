<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

/* use */
use hwhome\lib\controllers\homeControllers as homeControllers;

/* 레이아웃 시작 */
homeControllers::home();
