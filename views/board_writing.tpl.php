<?php
$mode = $_GET['mode'];
$idx = $_GET['board_idx'];
$sessionMemeberId = hwhome\lib\controllers\loginControllers::$loginArr['member_id'];
?>
<?php if(sizeof( $sessionMemeberId )) : ?>
    <section class="main-container">
    <div class="inner">
        <?php if ($mode !== 'edit') : ?>
            <form action="/views/insert.php" method="post">
                <div class="board-writing-wrap">
                    <input type="hidden" name="member_index" value="<?= hwhome\lib\controllers\loginControllers::$loginArr['member_idx'] ?>">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h2 class="common-title line">글 작성</h2>
                        <a href="/index.php" class="col-1 btn btn-primary btn-sm">리스트</a>
                    </div>
                    <div class="mb-3">
                        <label for="board-title" class="form-label fs-6">글 제목</label>
                        <input type="text" name="board_title" class="form-control" id="board-title"
                               placeholder="제목을 입력해주세요." value="" required minlength="3">
                    </div>
                    <div class="mb-3">
                        <label for="board-writer-title" class="form-label fs-6">작성자 이름</label>
                        <input type="text" name="board_writer" class="form-control" id="board-writer" value="<?= $sessionMemeberId ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fs-6">글 내용</label>
                        <textarea name="board_content" class="form-control" id="exampleFormControlTextarea1"
                                  rows="10" required minlength="3"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="col-1 btn btn-primary btn-sm">쓰기</button>
                        <button type="button" class="col-1 btn btn-primary btn-sm" onclick="history.back();">취소</button>
                    </div>
        <?php else: ?>
            <form action="/views/update.php?board_idx=<?= $idx ?>" method="post">
        <?php endif; ?>
                <?php if(count($compact['results']) < $idx) : ?>
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

                <?php foreach ($compact['results'] as $board) : ?>
                    <?php if ($idx === $board['idx']) : ?>
                        <?php if($sessionMemeberId === $board['writer']) : ?>
                            <div class="board-writing-wrap">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <h2 class="common-title line">글 수정</h2>
                                    <a href="/index.php" class="col-1 btn btn-primary btn-sm">리스트</a>
                                </div>
                                <div class="mb-3">
                                    <label for="board-title" class="form-label fs-6">글 제목</label>
                                    <input type="text" name="board_title" class="form-control" id="board-title"
                                           placeholder="제목을 입력해주세요." value="<?= $board['title'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="board-writer-title" class="form-label fs-6">작성자 이름</label>
                                    <input type="text" name="board_writer" class="form-control" id="board-writer" value="<?= $board['writer'] ?>" required readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label fs-6">글 내용</label>
                                    <textarea name="board_content" class="form-control" id="exampleFormControlTextarea1"
                                              rows="10" required><?= $board['content'] ?></textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="col-1 btn btn-primary btn-sm">수정</button>
                                    <button type="button" class="col-1 btn btn-primary btn-sm" onclick="history.back();">취소</button>
                                </div>
                                <?php else: ?>
                                    <script>
                                        alert('비정상적인 접근입니다. 접근을 다시 시도해주세요.');
                                        location.href = '../index.php';
                                    </script>
                                <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
            </form>
    </div>
</section>
<?php else : ?>
    <script>
		alert('로그인 접속 후 시도해주세요');
		location.href = '../index.php';
    </script>
<?php endif ?>
