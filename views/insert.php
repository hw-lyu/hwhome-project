<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;
$title = $_POST['board_title'];
$writer = $_POST['board_writer'];
$writerIdx = $_POST['member_index'];
$views = 0;
$reco = 0;
$content = $_POST['board_content'];
$postStatus = 'keep';

$pdo = dbModels::pdo();
$sql = $pdo->prepare(db::create('hwhome_board (title, content, writer, writerIdx, views, reco, postStatus)', addslashes($title). '" , "' .$content. '" , "' . addslashes($writer). '" , "' .addslashes($writerIdx). '" , "' .addslashes($views). '" , "' .addslashes($reco). '" , "' .addslashes($postStatus)));
$sql->execute();

header("Location: /hwhome/index.php");
