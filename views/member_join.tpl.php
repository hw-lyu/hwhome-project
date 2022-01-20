<?php if(sizeof(hwhome\lib\controllers\loginControllers::$loginArr['member_id'])) : ?>
    <section class="main-container">
        <div class="inner">
            <h2 class="blind">메인영역</h2>
            <div class="error-wrap">
                <p class="error-txt">에러!</p>
                로그인을 이미 하셨습니다. 뒤로가기를 클릭해주세요.</strong>
            </div>
        </div>
    </section>
<?php else : ?>
    <section class="main-container">
        <div class="inner">
            <form action="/views/member_insert.php" method="post">
                <div class="join-wrap">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h2 class="common-title line">회원가입</h2>
                    </div>
                    <div class="mb-3">
                        <label for="member-id" class="form-label fs-6">아이디 <span class="comment"></span></label>
                        <input type="text" name="member_id" class="form-control" id="member-id" placeholder="아이디를 이메일 형식으로 입력해주세요. ex. id@email.com" required="">
                    </div>
                    <div class="mb-3">
                        <label for="member-pw" class="form-label fs-6">비밀번호 <span class="comment"></span></label>
                        <input type="password" name="member_pw" class="form-control" id="member-pw" placeholder="비밀번호를 입력해주세요." required="" autocomplete="off" minlength="3">
                    </div>
                    <div class="mb-3">
                        <label for="member-pw-re" class="form-label fs-6">비밀번호 확인</label>
                        <input type="password" name="member_pw_re" class="form-control" id="member-pw-re" placeholder="비밀번호를 다시 입력해주세요." required="" autocomplete="off" minlength="3">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="col-2 btn btn-primary btn-sm join-btn" disabled>가입하기</button>
                        <button type="button" class="col-2 btn btn-primary btn-sm" onclick="history.back();">취소</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php endif; ?>
