window.addEventListener('load', () => {
	const showUnsubscribePopup = () => {
		const wrp = document.querySelector('.popupWrapper');
		wrp.style.display = `grid`;
		wrp.animate([
			{background: `rgba(0, 0, 0, 0)`}, 
			{background: `rgba(0, 0, 0, .4)`}
		], 200);
		document.querySelector('.popup').animate([
			{opacity: `0`, transform: `translate(0, -64px)`}, 
			{opacity: `1`, transform: `translate(0, 0)`}
		], 200);
	};
	
	const hideUnsubscribePopup = () => {
		document.querySelector('.popupWrapper').style.display = `none`;
	};
	
	document.querySelector('.popupWrapper').addEventListener(`click`, () => {
		hideUnsubscribePopup();
	});
	
	document.querySelector('.popup-clsBtn').addEventListener(`click`, () => {
		hideUnsubscribePopup();
	});
	
	document.querySelector('.popup-okBtn').addEventListener(`click`, () => {
		hideUnsubscribePopup();
	});
	
	document.querySelector('.popup').addEventListener(`click`, (evn) => {
		evn.stopPropagation();
	});
	
	//showUnsubscribePopup();
});