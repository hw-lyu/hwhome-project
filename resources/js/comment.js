window.addEventListener('load', function (e) {

	e.target.addEventListener('click', function (e) {
		let target = e.target,
			commentParent = target.closest('.comment-box') || target.closest('.recomment');

		function targetFetch(url, content) {
			fetch(url, {
				method: "POST",
				cache: 'no-cache',
				headers: {
					'Content-Type': 'application/json; charset=utf-8',
					Accept: 'application/json'
				},
				body: JSON.stringify(content)
			})
				.then((response) => response.text())
				.then((data) => data);

			window.location = window.location.href;
		}

		if (target.classList.contains('cmt')) {
			targetFetch("/hwhome/views/comment_insert.php", {
				board_idx: window.location.search.split('?board_idx=')[1],
				type: 'cmt',
				comment_contnet: document.querySelector('textarea[name="board_content"]').value
			});
		}

		if (target.classList.contains('re-cmt-first')) {
			console.log(commentParent.querySelector('.recomment-box'));
			commentParent.querySelector('.recomment-box').innerHTML = `
					<div class="recomment ps-5 mt-2">
                        <div class="name mb-1">
                            Re: 
                            <button type="button" class="btn ms-2 btn-primary btn-sm re-cmt">덧글 달기</button>
                        </div>
                        <textarea name="board_content_re" class="form-control" id="exampleFormControlTextarea2"
                                  rows="3"
                                  required=""></textarea>
                    </div>
			`;
		}

		if (target.classList.contains('re-cmt')) {
			let commentParent = target.closest('.comment-box') || target.closest('.recomment-box').closest('.recomment'),
				idArr = commentParent.className.split('comment-');

			targetFetch("/hwhome/views/recomment_insert.php", {
				board_idx: window.location.search.split('?board_idx=')[1],
				type: 'recmt',
				comment_idx: idArr[idArr.length-1],
				comment_contnet: document.querySelector('textarea[name="board_content_re"]').value
			});
		}

		if(target.classList.contains('btn-del')) {
			var id = commentParent.id.split('-');

			targetFetch("/hwhome/views/comment_delete.php", {
				board_idx: window.location.search.split('?board_idx=')[1],
				idx: id[id.length-1]
			});
		}
	});

})
;