<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';


try {
    session_start();
    unset($_SESSION['memberIdx']);
    header("Location: /hwhome/index.php");

} catch (Exception $e) {
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
}