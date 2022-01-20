<?php
/* 오토로딩 초기화 */
require_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/autoload.php';

use home\ubuntu\config\commondb as db;
use hwhome\lib\models\dbModels as dbModels;

$id = $_POST['member_id'];
$pw = $_POST['member_pw'];
$pdo = dbModels::pdo();

try {
    $sql = $pdo->prepare(db::read('hwhome_member', '*'));
    $sql->execute();
    $errorCode = $sql->errorInfo()[1];
    $memberArr = $sql->fetchAll($pdo::FETCH_ASSOC);

    for ($i = 0, $len = count($memberArr); $i < $len; $i++) {
        foreach ($memberArr[$i] as $key => $val) {
            if($key === 'member_id' && $val === $id) {
                if(password_verify($pw, $memberArr[$i]['member_pw'])) {
                    $_SESSION['memberIdx'] = $memberArr[$i]['member_idx'];
                    header("Location: /hwhome/index.php");
                }
            }
        }
    }

    if(sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id']) === 0) {
        echo "<script>
                        alert('로그인을 다시 시도해주세요');
                        location.href = '../index.php';
                        </script>
             ";
    }


} catch (Exception $e) {
    $pdo->rollback();
    $s = $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
}