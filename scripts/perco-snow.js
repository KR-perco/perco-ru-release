window.addEventListener('load', () => {
	let prevTime = 0;
	let windXSpeed = Number(Math.random() * 0.08 - 0.04);
	let minX = 0;
	let maxX = screen.width;
	
	let step = (time) => {
		dTime = time - prevTime;
		prevTime = time;
		document.querySelectorAll('.snow-flake').forEach((flake) => {
			if (Number(flake.style.top.replace('px', '')) > 544) {
				flake.remove();
				return;
			}
			flake.style.left = Number(flake.style.left.replace('px', '')) + Number(flake.dataset.xSpeed) * dTime + windXSpeed * dTime + 'px';
			flake.style.top = Number(flake.style.top.replace('px', '')) + Number(flake.dataset.ySpeed) * dTime + 'px';
			flake.dataset.angle = Number(flake.dataset.angle) + Number(flake.dataset.rotationSpeed);
			flake.style.transform = `rotate(`+flake.dataset.angle+`deg)`;
			if (Math.abs(Number(flake.dataset.xSpeed)) > Number(flake.dataset.xMaxSpeed)) {
				flake.dataset.xAcceleration = -1 * Number(flake.dataset.xAcceleration);
			}
			flake.dataset.xSpeed = Number(flake.dataset.xSpeed) + Number(flake.dataset.xAcceleration);
		});
		requestAnimationFrame(step);
	};
	
	let spawn = (minX = 0, maxX = 1920, minYSpeed = 0.03, maxYSpeed = 0.08, minXMaxSpeed = 0.04, maxXMaxSpeed = 0.16, minXAcceleration = 0.002, maxXAcceleration = 0.006, minR = 2, maxR = 12, minOpacity = 0.5, maxOpacity = 1, minRotateSpeed = -2, maxRotateSpeed = 2) => {
		let r = Number(Math.random()*(maxR - minR) + minR);
		let d = 2 * r;
		document.querySelector('#main_banner').insertAdjacentHTML('beforeend', `
			<img data-x-speed="0" data-y-speed="`+Number(Math.random()*(maxYSpeed - minYSpeed) + minYSpeed)+`" data-x-max-speed="`+Number(Math.random()*(maxXMaxSpeed - minXMaxSpeed) + minXMaxSpeed)+`" data-x-acceleration="`+Number(Math.random()*(maxXAcceleration - minXAcceleration) + minXAcceleration)+`" data-angle="0" data-rotation-speed="`+Number(Math.random()*(maxRotateSpeed - minRotateSpeed) + minRotateSpeed)+`" class="snow-flake" style="position: absolute; left: `+Number(Math.random()*(maxX - minX) + minX)+`px; top: -`+d+`px; width: `+d+`px; height: `+d+`px; opacity: `+Number(Math.random()*(maxOpacity - minOpacity) + minOpacity)+`; z-index: 16; cursor: pointer;" src="/images/snow/show_`+Number(Math.round(Math.random() * 3))+`.svg" alt="Снежинка">
		`);
		/*document.querySelector('#main_banner').insertAdjacentHTML('beforeend', `
			<svg data-x-speed="0" data-y-speed="`+Number(Math.random()*(maxYSpeed - minYSpeed) + minYSpeed)+`" data-x-max-speed="`+Number(Math.random()*(maxXMaxSpeed - minXMaxSpeed) + minXMaxSpeed)+`" data-x-acceleration="`+Number(Math.random()*(maxXAcceleration - minXAcceleration) + minXAcceleration)+`" class="snow-flake" style="position: absolute; left: `+Number(Math.random()*(maxX - minX) + minX)+`px; top: -`+d+`px; width: `+d+`px; height: `+d+`px; opacity: `+Number(Math.random()*(maxOpacity - minOpacity) + minOpacity)+`; z-index: 16;">
				<circle r="`+r+`" cx="50%" cy="50%" fill="white"/>
			</svg>
		`);*/
		/*document.querySelector('#main_banner').insertAdjacentHTML('beforeend', `
			<canvas data-x-speed="0" data-y-speed="0.05" data-x-max-speed="0.05" data-x-acceleration="0.005" class="snow-flake" width="8" height="8" style="position: absolute; left: `+Number(Math.random()*(maxX - minX) + minX)+`px; top: -8px; z-index: 16;"></canvas>
		`);
		let ctx = document.querySelector('.snow-flake:last-child').getContext('2d');
		ctx.fillStyle = "rgb(255,255,255)";
        ctx.beginPath();
		ctx.arc(4, 4, 4, 0, 2 * Math.PI);
		ctx.fill();*/
	};
	
	let intervalGeneration = 400;
	
	if (window.innerWidth > 768) {
		intervalGeneration = 200;
	}
	
	setInterval(() => {spawn();}, intervalGeneration);
	requestAnimationFrame(() => {step();});
});