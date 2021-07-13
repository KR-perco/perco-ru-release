'use strict';
(async () => {
	window.addEventListener('load', () => {
		document.querySelectorAll('.scrollmenu a').forEach(btn => {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				document.querySelectorAll('.scrollmenu a').forEach(btn => {
					btn.classList.remove('active');
				});
				this.classList.add('active');
				this.dispatchEvent(new CustomEvent("navTabsPressed"));
			});
		});
		
		/*let prevTimestamp = 0;
		let prevX = 0;
		let cursorX = 0;
		let prevCursorX = 0;
		let dT = 0;
		let dX = 0;
		
		let navTabsInit = () => {
			let navTabs = document.querySelector('.nav-tabs');
			let selector = navTabs.querySelector('.selector');
			let btnBcr = document.querySelector('.nav-tabs button:first-of-type').getBoundingClientRect();
			selector.style.left = `${btnBcr.left - navTabs.getBoundingClientRect().left}px`;
			selector.style.width = `${btnBcr.width}px`;
			switch (worker) {
				case 'installer':
					btnBcr = navTabs.querySelector('button[data-section="videouroki"]').getBoundingClientRect();
					selector.style.left = `${btnBcr.left}px`;
					selector.style.width = `${btnBcr.width}px`;
					navTabs.querySelector('.inner').style.left = `-${btnBcr.left - getStlNum('button[data-section="videouroki"]', 'marginRight') / 2}px`;
					break;
			}
		};
		
		let step = (timestamp) => {
			dT = timestamp - prevTimestamp;
			dX = cursorX - prevCursorX;
			prevTimestamp = timestamp;
			prevCursorX = cursorX;
			navTabsMove();
			requestAnimationFrame((timestamp) => {
				step(timestamp);
			});
		};
		
		let navTabsMove = () => {
			let navTabs = document.querySelector('.nav-tabs');
			let navTabsInner = navTabs.querySelector('.inner');
			if (Math.sign(Number(navTabs.dataset.v)) != Math.sign(Number(navTabs.dataset.v) + Number(navTabs.dataset.a) * dT)) {
				navTabs.removeAttribute('data-v');
				navTabs.removeAttribute('data-a');
				return;
			}
			let navTabsInnerLeft = Number(getComputedStyle(document.querySelector('.nav-tabs .inner'), null).getPropertyValue('left').replace('px', '')) + Number(navTabs.dataset.v) * dT + Number(navTabs.dataset.a) * Math.pow(dT, 2) / 2;
			if (navTabsInnerLeft > 0) {
				navTabsInnerLeft = 0;
			}
			if (navTabsInnerLeft + Number(getComputedStyle(document.querySelector('.nav-tabs .inner'), null).getPropertyValue('width').replace('px', '')) < Number(getComputedStyle(document.querySelector('.nav-tabs'), null).getPropertyValue('width').replace('px', ''))) {
				navTabsInnerLeft = Number(getComputedStyle(document.querySelector('.nav-tabs'), null).getPropertyValue('width').replace('px', '')) - Number(getComputedStyle(document.querySelector('.nav-tabs .inner'), null).getPropertyValue('width').replace('px', ''));
			}
			navTabsInner.style.left = navTabsInnerLeft + 'px';
			navTabs.dataset.v = Number(navTabs.dataset.v) + Number(navTabs.dataset.a) * dT;
		};
		
		let getStlNum = (selector, style) => (Number(getComputedStyle(document.querySelector(selector))[style].replace('px', '')));
		
		window.addEventListener('touchmove', e => {
			for (let i = 0; i < e.changedTouches.length; i++) {
				if (e.changedTouches[i].identifier == document.querySelector('.nav-tabs').dataset.slideIdTouch) {
					cursorX = e.changedTouches[i].pageX;
					let navTabsInnerLeft = e.changedTouches[i].pageX - Number(document.querySelector('.nav-tabs').dataset.offset);
					if (navTabsInnerLeft > 0) {
						navTabsInnerLeft = 0;
					}
					if (navTabsInnerLeft + Number(getComputedStyle(document.querySelector('.nav-tabs .inner'), null).getPropertyValue('width').replace('px', '')) < Number(getComputedStyle(document.querySelector('.nav-tabs'), null).getPropertyValue('width').replace('px', ''))) {
						navTabsInnerLeft = Number(getComputedStyle(document.querySelector('.nav-tabs'), null).getPropertyValue('width').replace('px', '')) - Number(getComputedStyle(document.querySelector('.nav-tabs .inner'), null).getPropertyValue('width').replace('px', ''));
					}
					document.querySelector('.nav-tabs .inner').style.left = navTabsInnerLeft + 'px';
				}
			}
		});
		
		window.addEventListener('touchend', e => {
			BXMobileApp.UI.Page.Refresh.setParams({
				enabled: true,
			});
			let navTabs = document.querySelector('.nav-tabs');
			for (let i = 0; i < e.changedTouches.length; i++) {
				if (e.changedTouches[i].identifier == document.querySelector('.nav-tabs').dataset.slideIdTouch) {
					navTabs.removeAttribute('data-slide-id-touch');
					navTabs.removeAttribute('data-start-x');
					navTabs.removeAttribute('data-offset');
					navTabs.dataset.v = dX / 16;
					navTabs.dataset.a = (navTabs.dataset.v > 0) ? -0.004 : 0.004;
				}
			}
		});
		
		window.addEventListener('touchcancel', e => {
			BXMobileApp.UI.Page.Refresh.setParams({
				enabled: true,
			});
			let navTabs = document.querySelector('.nav-tabs');
			for (let i = 0; i < e.changedTouches.length; i++) {
				if (e.changedTouches[i].identifier == document.querySelector('.nav-tabs').dataset.slideIdTouch) {
					navTabs.removeAttribute('data-slide-id-touch');
					navTabs.removeAttribute('data-start-x');
					navTabs.removeAttribute('data-offset');
				}
			}
		});
		
		document.querySelector('.nav-tabs').addEventListener('touchstart', function (e) {
			e.preventDefault();
			if (this.dataset.slideIdTouch) return;
			BXMobileApp.UI.Page.Refresh.setParams({
				enabled: false,
			});
			let navTabsInnerX = Number(getComputedStyle(document.querySelector('.nav-tabs .inner'), null).getPropertyValue('left').replace('px', ''));
			this.dataset.slideIdTouch = e.changedTouches[0].identifier;
			this.dataset.startX = navTabsInnerX;
			this.dataset.offset = e.changedTouches[0].pageX - navTabsInnerX;
		});
		
		document.querySelectorAll('.nav-tabs button').forEach(btn => {
			btn.addEventListener('touchend', function () {
				let navTabs = this.closest('.nav-tabs');
				if (Math.abs(Number(getComputedStyle(document.querySelector('.nav-tabs .inner'), null).getPropertyValue('left').replace('px', '')) - navTabs.dataset.startX) > 4) return;
				let selector = navTabs.querySelector('.selector');
				let btnBcr = this.getBoundingClientRect();
				selector.style.left = `${btnBcr.left - navTabs.querySelector('.inner').getBoundingClientRect().left}px`;
				selector.style.width = `${btnBcr.width}px`;
				navTabs.removeAttribute('data-slide-id-touch');
				navTabs.removeAttribute('data-start-x');
				navTabs.removeAttribute('data-offset');
				this.dispatchEvent(new CustomEvent("navTabsPressed"));
			});
		});
		
		navTabsInit();
		
		requestAnimationFrame((timestamp) => {step(timestamp)});*/
	});
})();