window.addEventListener('load', function () {
	let titleBar = document.getElementById('board-title'),
		textarea = document.getElementById('exampleFormControlTextarea1');
		gapRe = /^[\s]+/g;

	titleBar.addEventListener('keyup', gap);
	textarea.addEventListener('keyup', gap);

	function gap() {
		if(this.value.match(gapRe)) {
			alert('첫 문자로 공백 문자를 쓸 수 없습니다. 다시 입력해주세요.');
			this.value = '';
			this.focus();
		}
	}

})