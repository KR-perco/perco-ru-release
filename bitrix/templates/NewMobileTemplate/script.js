(() => {
	BXMobileApp.UI.Page.Refresh.setParams({
		enabled: false,
	});
	window.addEventListener('load', function () {
		BXMobileApp.UI.Page.Refresh.setParams({
			enabled: false,
		});
		
		/*document.querySelectorAll('.lSSlideOuter, .scrollmenu').forEach((item) => {
			item.addEventListener('touchstart', () => {
				BXMobileApp.UI.Page.Refresh.setParams({
					enabled: false,
				});
			});
		});
		document.addEventListener('touchstart', (e) => {
			if (e.target.closest('.lg-outer') && e.target.closest('.lg-outer') == document.querySelector('.lg-outer')) {
				BXMobileApp.UI.Page.Refresh.setParams({
					enabled: false,
				});
			}
		});
		this.addEventListener('touchend', () => {
			BXMobileApp.UI.Page.Refresh.setParams({
				enabled: true,
			});
		});*/
	});
})();