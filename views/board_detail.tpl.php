<?php
$id = sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id']);
$idx = hwhome\lib\controllers\loginControllers::$loginArr['member_idx'];
?>

<section class="main-container">
    <div class="inner">
        <div class="board-detail-wrap">
            <?php
            $operator = hwhome\lib\controllers\loginControllers::$loginArr['member_level'] === '운영자' ? $compact['boardDetailOperatorResults'] : $compact['results'];

            ?>
            <?php if (sizeof($operator)) : ?>
            <?php foreach ($operator as $board) : ?>
                <?php if ($compact['idx'] === $board['idx']) : ?>
                    <?php if($board['postStatus'] === 'del') : ?>
                        <p class="del">삭제된 글 입니다.</p>
                    <?php endif?>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h2 class="common-title line">글보기</h2>
                    <div class="w-25 d-flex align-items-center justify-content-end">
                        <a href="/index.php" class="w-25 btn btn-primary btn-sm">목록</a>
                        <?php if (!($id === 0) && $board['writerIdx'] === $idx) : ?>
                            <a href="/layout/board_writing.php?mode=edit&board_idx=<?= $compact['idx'] ?>"
                               class="btn ms-2 btn-primary btn-sm">수정</a>
                            <form action="/views/board_delete.php?board_idx=<?=$_GET['board_idx']?>" method="post">
                                <button type="submit" class="btn ms-2 btn-primary btn-sm" name="btn-delete">삭제</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="content mb-3">
                    <?= nl2br(htmlspecialchars($board['content'])); ?>
                </div>
                <div class="btn-wrap d-flex justify-content-center align-items-center">
                    <form action="/views/reco_insert.php?board_idx=<?=$_GET['board_idx']?>" method="post">
                        <?php if( sizeof($compact['likeInnerJoinResult']) ) : ?>
                            <div class="btn-reco" name="reco"><span>추천 ❤</span></div>
                        <?php else: ?>
                            <button type="submit" class="btn-reco" name="reco"><span>추천 ️🤍</span></button>
                        <?php endif; ?>
                    </form>
                </div>
                <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'hwhome/views/partial/comment.tpl.php'; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>

            <!-- 삭제된 글 경우 -->
            <?php foreach ($compact['boardDetailDeleteResults'] as $delBoard) :?>
                <?php if($compact['idx'] === $delBoard['idx']) : ?>
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h2 class="common-title line">글이 없습니다.</h2>
                        <div class="w-25 d-flex align-items-center justify-content-end">
                            <a href="/index.php" class="w-50 btn btn-primary btn-sm">리스트</a>
                        </div>
                    </div>
                    <div class="content mb-3">
                        해당 게시물이 삭제되었습니다. <br>
                        뒤로가기 혹은 상단의 리스트를 클릭해주세요.
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <!-- 주소창에 해당 게시물의 총 인덱수보다 많은 숫자를 입력했을 경우 나오는 문구 -->
            <?php if( sizeof($compact['boardDetailOperatorResults']) < $compact['idx'] || $compact['idx'] === null ) :?>
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h2 class="common-title line">글이 없습니다.</h2>
                    <div class="w-25 d-flex align-items-center justify-content-end">
                        <a href="/index.php" class="w-50 btn btn-primary btn-sm">리스트</a>
                    </div>
                </div>
                <div class="content mb-3">
                    해당 게시물이 없습니다.<br>
                    뒤로가기 혹은 상단의 리스트를 클릭해주세요.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>