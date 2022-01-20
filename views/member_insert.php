<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;

$id = $_POST['member_id'];
$pw = $_POST['member_pw'];

$pdo = dbModels::pdo();

try {
    $sql = $pdo->prepare(db::create( 'hwhome_member (member_id, member_pw)' , htmlspecialchars($id) .'","'. password_hash($pw, PASSWORD_DEFAULT) ));
    $pdo->beginTransaction();
    $exc = $sql->execute();
    $errorCode = $sql->errorInfo()[1];

    if($exc === false && $errorCode === 1062) {
        $pdo->rollback();
        header("Location: /hwhome/layout/login_error.php");
    } else {
        $pdo->commit();
        header("Location: /hwhome/index.php");
    }

} catch (Exception $e) {
    $pdo->rollback();
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
}