<?php
$viewNum = $compact['viewNum']; //3
$page = $compact['page']; //페이지 넘버
$pageCeil = ceil($page / $viewNum);
?>

<section class="main-container">
    <div class="inner">
        <h2 class="blind">메인영역</h2>
        <div class="table-wrap">
            <div class="btn-wrap d-flex justify-content-end mb-2">
                <?php if (sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id'])) : ?>
                    <a href="layout/board_writing.php" class="col-1 btn btn-primary btn-sm">글쓰기</a>
                <?php endif; ?>
            </div>
            <table class="table">
                <caption>게시판 입니다.</caption>
                <colgroup>
                    <col width="10%;">
                    <col width="40%;">
                    <col width="20%;">
                    <col>
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th class="text-center">글번호</th>
                    <th class="text-center">제목</th>
                    <th class="text-center">작성자</th>
                    <th class="text-center">날짜</th>
                    <th class="text-center">조회수</th>
                    <th class="text-center">추천수</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $operator = hwhome\lib\controllers\loginControllers::$loginArr['member_level'] === '운영자' ? $compact['boardViewOperatorResult'] : $compact['results'];
                ?>
                <?php if (sizeof($operator)): ?>
                    <?php foreach ($operator as $board) : ?>
                        <?php if ($board['postStatus'] === 'del') : ?>
                            <tr class="del">
                                <td class="text-center"><?= $board['idx'] ?></td>
                                <td class="text-left"><a
                                            href="layout/board_detail.php?board_idx=<?= $board['idx'] ?>"><?= htmlspecialchars($board['title']) ?></a>
                                </td>
                                <td class="text-center"><?= htmlspecialchars($board['writer']) ?></td>
                                <td class="text-center"><?= htmlspecialchars(date("Y-m-d", strtotime($board['date']))) ?></td>
                                <td class="text-center"><?= sizeof($board['views']) ? htmlspecialchars($board['views']) : '-'; ?></td>
                                <td class="text-center"><?= sizeof($board['reco']) ? htmlspecialchars($board['reco']) : '-'; ?></td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td class="text-center"><?= htmlspecialchars($board['idx']) ?></td>
                                <td class="text-left"><a
                                            href="layout/board_detail.php?board_idx=<?= $board['idx'] ?>"><?= htmlspecialchars($board['title']) ?></a>
                                </td>
                                <td class="text-center"><?= htmlspecialchars($board['writer']) ?></td>
                                <td class="text-center"><?= htmlspecialchars(date("Y-m-d", strtotime($board['date']))) ?></td>
                                <td class="text-center"><?= sizeof($board['views']) ? htmlspecialchars($board['views']) : '-'; ?></td>
                                <td class="text-center"><?= sizeof($board['reco']) ? htmlspecialchars($board['reco']) : '-'; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center" colspan="6">게시물이 없습니다.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="?page=<?= intval($page - 1) ? $page - 1 : 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php
                $operator = hwhome\lib\controllers\loginControllers::$loginArr['member_level'] === '운영자' ? $compact['boardAllIdx'] : $compact['boardKeepViewIdxResult'];
                $boardAllIdx = sizeof($operator) ? sizeof($operator) : 1;

                for ($i = 1; $i <= $viewNum; $i++) :
                    $ceil = ($pageCeil - 1) * $viewNum + $i;
                    if (ceil($boardAllIdx / $viewNum) < $ceil) break;
                    ?>
                    <li class="page-item <?= $page == $ceil ? 'active' : ''; ?>"><a class="page-link"
                                                                                    href="?page=<?= $ceil ?>"> <?= $ceil ?> </a>
                    </li>
                <?php endfor; ?>

                <li class="page-item">
                    <a class="page-link"
                       href="?page=<?= $page + 1 < ceil($boardAllIdx / $viewNum) ? intval($page + 1) : ceil($boardAllIdx / $viewNum) ?>"
                       aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>