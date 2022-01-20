<div class="comment-wrap">
    <h3 class="common-title line mb-2">코멘트영역</h3>
    <div class="content mb-2">
        <?php
        $operator = hwhome\lib\controllers\loginControllers::$loginArr['member_level'] === '운영자' ? $compact['commentOperatorResult'] : $compact['commentKeepQueryResults'];

        ?>
        <?php if (sizeof($operator)) : ?>
            <?php foreach ($operator as $comment) : ?>
                <?php if ($comment['type'] === 'cmt'): ?>
                    <div class="comment-box mt-2 <?= $comment['commentStatus'] === 'del' ? 'del' : ''?>" id="comment-<?= $comment['idx'] ?>">
                        <div class="name mb-1">
                            <?= $comment['commentStatus'] === 'del' ? '해당 덧글은 삭제된 덧글입니다.'.'<br>' : ''; ?>
                            <?= $comment['member_id'] ?>님의 덧글
                            <?php if (sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id'])) : ?>
                                <button type="button" class="btn ms-2 btn-primary btn-sm re-cmt-first">덧글 달기</button>
                            <?php endif; ?>
                            <?php if (hwhome\lib\controllers\loginControllers::$loginArr['member_id'] === $comment['member_id']): ?>
                                <button type="button" class="btn ms-2 btn-primary btn-sm btn-del">삭제</button>
                            <?php endif; ?>
                        </div>
                        <div class="form-control comment"><?= $comment['content'] ?></div>
                        <div class="recomment-box"></div>
                    </div>
                <?php elseif ($comment['type'] === 'recmt'): ?>
                    <div class="recomment ps-5 mt-2 recomment-<?= $comment['comment_idx'] ?> <?= $comment['commentStatus'] === 'del' ? 'del' : ''?>" id="comment-<?= $comment['idx'] ?>">
                        <div class="name mb-1">
                            <?= $comment['commentStatus'] === 'del' ? '해당 덧글은 삭제된 덧글입니다.'.'<br>' : ''; ?>
                            Re: <?= $comment['member_id'] ?>님의 덧글
                            <?php if (sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id'])) : ?>
                                <button type="button" class="btn ms-2 btn-primary btn-sm re-cmt-first">덧글 달기</button>
                            <?php endif; ?>
                            <?php if (hwhome\lib\controllers\loginControllers::$loginArr['member_id'] === $comment['member_id']): ?>
                                <button type="button" class="btn ms-2 btn-primary btn-sm btn-del">삭제</button>
                            <?php endif; ?>
                        </div>
                        <div class="form-control"><?= $comment['content'] ?></div>
                        <div class="recomment-box"></div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center">코멘트를 추가해주세요.</div>
        <?php endif; ?>
        <hr>
        <div class="comment-box">
            <div class="name mb-1">
                <?php if (sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id'])) : ?>
                <?= hwhome\lib\controllers\loginControllers::$loginArr['member_id'] ?> 님의 덧글
                <button type="button" class="btn ms-2 btn-primary btn-sm cmt">덧글 달기</button>
            </div>
            <textarea name="board_content" class="form-control" id="exampleFormControlTextarea1" rows="3"
                      required=""></textarea>
            <?php else : ?>
                <div class="text-center">손님 로그인 후 코멘트를 달아주세요.</div>

            <?php endif; ?>
        </div>
    </div>
</div>