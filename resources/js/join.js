window.addEventListener('load', function () {
    let idRe = /[^\W_]+(?=@)@[a-z0-9_-]+(\.([a-z0-9]+)){1,}/g,
        memberId = document.getElementById('member-id'),
        memberPw = document.getElementById('member-pw'),
        memberPwRe = document.getElementById('member-pw-re'),
        joinBtn = document.querySelector('button.join-btn');

    const checkState = {id: false, pw: false};

    //id
    memberId.addEventListener('change', function() {
        let spanEle = this.previousElementSibling.lastChild,
            checked = this.value.match(idRe);

        spanEle.innerText = memberId.value === ( (checked !== null) && checked.join() )
            ? "입력을 잘하셨습니다."
            : "입력을 다시 해주세요.";

        checkState.id = memberId.value === ( (checked !== null) && checked.join() )
            ? true
            : false;
        stepNext();
        ;
    });

    //pw
    memberPw.addEventListener('keyup', pwVal);

    //pwRe
    memberPwRe.addEventListener('keyup', pwVal);

    function pwVal() {
        let spanEle = memberPw.previousElementSibling.lastChild,
            checked = (memberPw.value === memberPwRe.value);

        if((memberPw.value || memberPwRe.value) === '') return false;

        spanEle.innerText = checked
            ? "입력을 잘하셨습니다."
            : "다시 입력을 확인해주세요.";
        checkState.pw = checked;
        stepNext();
    }

    //button
    function stepNext() {
        joinBtn.disabled = Object.values(checkState).filter((v) =>  !v ).length;
    }
})
