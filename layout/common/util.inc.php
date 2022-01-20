<?php

/* use */
use hwhome\lib\controllers\loginControllers as loginControllers;

$id = explode('@', loginControllers::$loginArr['member_id'])[0];

?>
<div class="util-wrap">
    <ul class="list <?= sizeof($_SESSION['memberIdx']) ? 'login' : ''; ?>">
        <?php if(sizeof($_SESSION['memberIdx'])) : ?>
            <li class="mb-1"><?= $id ?>님. 로그인 성공하셨습니다.</li>
            <li><a href="/views/member_logout.php" class="btn btn-primary btn-sm">로그아웃</a></li>
        <?php else : ?>
            <li><a href="/layout/member_join.php" class="btn btn-primary btn-sm">회원가입</a></li>
            <li><a href="/layout/member_login.php" class="btn btn-primary btn-sm">로그인</a></li>
        <?php endif; ?>
    </ul>
</div>