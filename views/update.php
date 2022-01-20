<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;

$title = $_POST['board_title'];
$writer = $_POST['board_writer'];
$content = $_POST['board_content'];
$idx = $_GET['board_idx'];

$pdo = dbModels::pdo();
$sql = $pdo->prepare(db::update( 'hwhome_board', 'title = "'. addslashes($title). '", content = "' .nl2br($content). '", writer = "' . addslashes($writer). '"', 'idx = '.$idx ));
$sql->execute();

header("Location: /hwhome/index.php");
