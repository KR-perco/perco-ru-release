(() => {
	window.addEventListener(`load`, () => {
		document.querySelectorAll(`.lSPager li`).forEach(li => {
			li.addEventListener(`click`, () => {
				document.querySelector(`#lightSlider`).style.height = `${document.querySelector(`li.active .video-block`).getBoundingClientRect().height}px`;
			});
		});
	});
})();