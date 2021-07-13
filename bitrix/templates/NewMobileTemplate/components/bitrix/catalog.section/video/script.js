'use strict';
(() => {
	window.addEventListener("load", () => {
		
		let resizeEvt = new Event('resize');
		
		let getStlNum = (selector, style) => (Number(getComputedStyle(document.querySelector(selector))[style].replace('px', '')));
		
		let setItemsEvt = () => {
			document.querySelectorAll('.video .video-list .item').forEach(item => {
				item.addEventListener('touchstart', function (e) {
					this.dataset.xPressed = e.changedTouches[0].pageX;
					this.dataset.yPressed = e.changedTouches[0].pageY;
				});
				
				item.addEventListener('touchend', function (e) {
					if (this.hasAttribute('data-active')) return;
					if ((Math.abs(e.changedTouches[0].pageY - this.dataset.yPressed) > 4) || (Math.abs(e.changedTouches[0].pageY - this.dataset.yPressed) > 4)) return;
					this.setAttribute('data-x-pressed', '');
					this.setAttribute('data-y-pressed', '');
					document.querySelectorAll('.video .video-list .item').forEach(item => {
						item.removeAttribute('data-active');
					});
					this.setAttribute('data-active', '');
					document.querySelector('.video .main-video iframe').src = `https://www.youtube.com/embed/${items[this.dataset.id].youtubeId}?rel=0&amp;enablejsapi=1`;
					document.querySelector('.video .text').innerHTML = `
						<h1>${items[this.dataset.id].name}</h1>
						<div class="description">
							${items[this.dataset.id].description}
						</div>`
						+ ((items[this.dataset.id].fileLink) ? `<div class="download"><a href="${items[this.dataset.id].fileLink}">Скачать</a> (${items[this.dataset.id].fileSize} MB) — ${items[this.dataset.id].fileDate}</div>` : '');
					$("html, body").animate({ scrollTop: 0 }, 200);
				});
			});
		};
		
		window.addEventListener('resize', () => {
			document.querySelector('.main-video').style.height = getStlNum('.main-video', 'width') * 9 / 16 + 'px';
		});
		
		setItemsEvt();
		
		document.querySelectorAll('.scrollmenu a').forEach(btn => {
			btn.addEventListener('navTabsPressed', async function () {
				let res = await fetch(`${templatePath}/ajax.php`, {
					method: 'POST',
					body: JSON.stringify({
						ajax: true,
						section: this.dataset.section,
						}),
					headers: {
						'Content-Type': 'application/json',
					},
					credentials: 'same-origin',
				});
				if (res.ok) {
					let json = await res.json();
					json.forEach((item, i) => {
						items[i] = [];
						items[i].name = json[i].name;
						items[i].description = json[i].description;
						items[i].youtubeId = json[i].youtubeId;
						items[i].fileLink = json[i].fileLink;
						items[i].fileSize = json[i].fileSize;
						items[i].fileDate = json[i].fileDate;
						items[i].posterLink = json[i].posterLink;
					});
					
					let code = `
					<div class="main-video">
						<iframe data-src="https://www.youtube.com/embed/KyKehb9KQIU?rel=0&amp;enablejsapi=1" frameborder="0" allowfullscreen="" src="https://www.youtube.com/embed/${json[0].youtubeId}?rel=0&amp;enablejsapi=1" style="display: initial;"></iframe>
					</div>
					<div class="text">
						<h1>${json[0].name}</h1>
						<div class="description">
							${json[0].description}
						</div>`
						+ ((json[0].fileLink) ? `<div class="download"><a href="${json[0].fileLink}">Скачать</a> (${json[0].fileSize} MB) — ${json[0].fileDate}</div>` : '') +
					`</div>
					<div class="video-list">
					`;
					json.forEach((item, i) => {
						code += `
							<div data-id="${i}" ${(i == 0) ? 'data-active' : ''} class="item">
								<img src="${json[i].posterLink}">
								<h3>${json[i].name}</h3>
							</div>
						`;
					});
					code += `</div>`;
					document.querySelector('.video').innerHTML = code;
					window.dispatchEvent(resizeEvt);
					setItemsEvt();
				} else {
					console.error(`ошибка ajax запроса: ${res.status}`);
				}
			});
		});
		
		window.dispatchEvent(resizeEvt);
	});
})();