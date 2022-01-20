window.addEventListener('load', function () {
	let recoBtn = document.querySelector('.btn-wrap div.btn-reco');
	if (recoBtn) {
		recoBtn.addEventListener('click', function () {
			alert('이미 추천하셨습니다.\n추천은 한번만 가능합니다.');
		});
	}
});

