function getCookie(name) {
	let matches = document.cookie.match(new RegExp(
	"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

window.addEventListener('resize', () => {console.log(Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("width").replace('px', '')) + 76); console.log(window.innerWidth);
	if (Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("width").replace('px', '')) + 100 >= window.innerWidth && Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("height").replace('px', '')) + 100 < window.innerHeight) {
		document.querySelector('.ny-video button').style.right = '12px';
		document.querySelector('.ny-video button').style.top = '-46px';
	}
	if (Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("width").replace('px', '')) + 100 < window.innerWidth && Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("height").replace('px', '')) + 100 >= window.innerHeight) {
		document.querySelector('.ny-video button').style.right = '-46px';
		document.querySelector('.ny-video button').style.top = '0';
	}
	if (Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("width").replace('px', '')) + 100 >= window.innerWidth && Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("height").replace('px', '')) + 100 >= window.innerHeight) {
		document.querySelector('.ny-video button').style.right = '12px';
		document.querySelector('.ny-video button').style.top = '12px';
	}
});

if (getCookie('nyVideoWatched-' + LANGUAGE_ID) != '1') {
	document.querySelector('.ny-video').style.display = 'flex';
}
document.cookie = 'nyVideoWatched-' + LANGUAGE_ID + '=1; max-age=4';

document.querySelector('.ny-video').addEventListener('click', function(){
	this.style.display = 'none';
});

document.querySelector('.ny-video video').addEventListener('click', function(e){
	e.stopPropagation();
	if (this.paused) {
		this.play();
	} else {
		this.pause();
	}
});

document.querySelector('.ny-video video').addEventListener('ended', () => {
	document.querySelector('.ny-video').style.display = 'none';
});

document.querySelector('.ny-video video').addEventListener('canplay', async () => {
	document.querySelector('.ny-video button').style.display = 'inline';
	if (Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("width").replace('px', '')) + 100 >= window.innerWidth && Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("height").replace('px', '')) + 100 < window.innerHeight) {
		document.querySelector('.ny-video button').style.right = '12px';
		document.querySelector('.ny-video button').style.top = '-46px';
	}
	if (Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("width").replace('px', '')) + 100 < window.innerWidth && Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("height").replace('px', '')) + 100 >= window.innerHeight) {
		document.querySelector('.ny-video button').style.right = '-46px';
		document.querySelector('.ny-video button').style.top = '0';
	}
	if (Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("width").replace('px', '')) + 100 >= window.innerWidth && Number(getComputedStyle(document.querySelector('.ny-video video'), null).getPropertyValue("height").replace('px', '')) + 100 >= window.innerHeight) {
		document.querySelector('.ny-video button').style.right = '12px';
		document.querySelector('.ny-video button').style.top = '12px';
	}
});