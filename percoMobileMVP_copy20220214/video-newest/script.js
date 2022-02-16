'use strict';
(async () => {
		window.addEventListener('resize', () => {
			document.querySelector('.main-video').style.height = getStlNum('.main-video', 'width') * 9 / 16 + 'px';
		});
		
		window.dispatchEvent(new Event('resize'));
})();