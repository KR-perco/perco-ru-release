'use strict';
(() => {
	window.addEventListener(`load`, () => {console.log(`ready`);
		document.querySelectorAll(`.sem-item__reg a`).forEach(a => {
			a.addEventListener(`click`, function (e) {
				ym(176255, 'reachGoal', 'semreg', {seminar: this.closest(`.sem-item__text`).querySelector(`.sem-item__title`).innerText});
			});
		});
	});
})();