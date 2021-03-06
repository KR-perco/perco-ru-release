'use strict';
(() => {
	window.addEventListener('load', () => {
		const activeSeminarsHashes = [
			'#perco-introduction',
			'#how-to-choose-a-turnstile',
			'#perco-new-products'
		];
		let email;
		let chosenSeminar = "PERCo introduction";
		let youtubeLink;
		let seminarDate;
		let seminarTime;
		let seminarSubscribe;
		
		let preset = () => {
			activeSeminarsHashes.forEach(seminar => {
				if (seminar == document.location.hash) {
					document.querySelector(`.training-item__reg-link[href="${document.location.hash}"]`).dispatchEvent(new Event('click'));
				}
			});
		};
		
		let setRegisterFormEvents = () => {
			document.querySelector('form[name="TRAINING_REGISTER"] input[type="submit"]').addEventListener('click', async () => {
				email = document.querySelector('form[name="TRAINING_REGISTER"] input[name="form_email_952"]').value;
			});
			
			document.querySelector('form[name="TRAINING_REGISTER"]').addEventListener('submit', function (event) {
				setTimeout(async () => {
					console.log('1');
					if (document.querySelector('.training-feedback_register').querySelector('.notetext')
					&& document.querySelector('.training-feedback_register').querySelector('.notetext').innerText.search(/Thank you/g) != -1
					&& !document.querySelector('.training-feedback_register').querySelector('.errortext')) {
						console.log('4');
						document.querySelector('.training-feedback_register').querySelector('.notetext').innerText = '';
						let response = await fetch('send-mail.php', {
							method: 'POST',
							headers: {
								'Content-Type': 'application/json;charset=utf-8'
							},
							body: JSON.stringify({
								email: email, /*document.querySelector('form[name="TRAINING_REGISTER"] input[name="form_email_952"]').value*/
								seminar: chosenSeminar, /*document.querySelector('form[name="TRAINING_REGISTER"] input[name="form_hidden_957"]').value*/
								youtube: youtubeLink,
								date: seminarDate,
								time: seminarTime,
								subscribe: seminarSubscribe
							})
						});
						if (response.ok) {
							const text = await response.text();
							console.log('?????????? send mail:');
							console.log(text);
						} else {
							alert("???????????? HTTP: " + response.status);
						}
						document.querySelector('.training-registration-title').style.display = 'none';
						document.querySelector('.training-feedback_register').style.display = 'none';
						document.querySelector('.training-feedback_register').insertAdjacentHTML('afterend', `<div class="text-form-filled"><p style="color: green;">Your application for ${chosenSeminar} webinar was submitted successfully.</p><p>To attend the webinar kindly follow the <a target="_blank" href="${youtubeLink}">link</a>, more details will also be sent to your Email.</p><div>`);
					} else {
						console.log('3');
						setRegisterFormEvents();
					}
					console.log('2');
				}, 800);
			});
		};
		
		document.querySelectorAll('.training-feedback-form__label_captcha img').forEach(img => {
			img.addEventListener('click', async () => {
				let response = await fetch('reload-captcha.php');
				if (response.ok) {
					const id = await response.text();
					img.src = '/bitrix/tools/captcha.php?captcha_sid='+id.replace(/"/g, '');
					img.closest('.training-feedback-form__label_captcha').querySelector('input[name="captcha_sid"]').value = id.replace(/"/g, '');
				} else {
					alert("???????????? HTTP: " + response.status);
				}
			});
		});
		
		document.querySelector('form[name="TRAINING_FEEDBACK_CONTACT"] input[type="submit"]').addEventListener('click', () => {
			setTimeout(() => {
				if (document.querySelector('form[name="TRAINING_FEEDBACK_CONTACT"] .errortext')) return;
				document.querySelector('.training-popup-feedback-notification').style.display = 'flex';
				document.querySelector('.training-popup-feedback-notification').offsetLeft;
				document.querySelector('.training-popup-feedback-notification__window').innerHTML = 'Thank you!<br>Your form was submitted successfully.<br>Our team will contact you shortly.';
				if (document.querySelector('.stupid-bitrix').innerText.search(/Thank you/g) === -1) {
					document.querySelector('.training-popup-feedback-notification__window').innerHTML = document.querySelector('.stupid-bitrix').innerHTML;
				}
				document.querySelector('.training-popup-feedback-notification__window').style.opacity = 1;
				document.querySelector('.training-popup-feedback-notification__window').style.transform = 'translate(0, 0)';
			}, 500);
		});
		
		document.querySelector('.training-popup-feedback-notification').addEventListener('click', () => {
			document.querySelector('.training-popup-feedback-notification__window').style.opacity = 0;
			document.querySelector('.training-popup-feedback-notification__window').style.transform = 'translate(0, -32px)';
			document.querySelector('.training-popup-feedback-notification__window').addEventListener('transitionend', () => {
				document.querySelector('.training-popup-feedback-notification').style.display = '';
			}, {
				once: true
			});
		});
		
		document.querySelector('.training-popup-feedback-notification__window').addEventListener('click', e => {
			e.stopPropagation();
		});
		
		document.querySelectorAll('.training-item__reg-link').forEach(link => {
			link.addEventListener('click', e => {
				e.preventDefault();
				document.querySelector('.training-registration-title').style.display = 'block';
				document.querySelector('.training-feedback_register').style.display = 'flex';
				document.querySelector('.text-form-filled')?.remove();
				document.querySelector('.training-popup-register').style.display = 'flex';
				document.querySelector('.training-popup-register').offsetLeft;
				document.querySelector('.training-popup-register__window').style.opacity = 1;
				document.querySelector('.training-popup-register__window').style.transform = 'translate(0, 0)';
				if (link.dataset.seminar) {
					chosenSeminar = link.dataset.seminar;
				}
				document.querySelector('input[name="form_hidden_957"]').value = chosenSeminar;
				//chosenSeminar = link.dataset.seminar;
				switch (chosenSeminar) {
				case 'PERCo introduction':
					youtubeLink = 'https://us02web.zoom.us/j/88336248435?pwd=bGNCV3M3YklQcVNuRlNzTFRaZ29jQT09';
					seminarDate = '14.04.21';
					seminarTime = '10:00am ??? 11:00am';
					seminarSubscribe = 53;
					break;
				case 'How to choose a turnstile':
					youtubeLink = 'https://us02web.zoom.us/j/82925376872?pwd=Mnp2TWVyekE1SzcvaXdoaFRYbUtzQT09';
					seminarDate = '21.04.21';
					seminarTime = '10:00am ??? 11:00am';
					seminarSubscribe = 54;
					break;
				case 'PERCo new products':
					youtubeLink = 'https://us02web.zoom.us/j/89056699246?pwd=NW81Z3ZGdnJvMUZIMnJLSHpza2pQZz09';
					seminarDate = '28.04.21';
					seminarTime = '10:00am ??? 11:00am';
					seminarSubscribe = 55;
					break;
				}
				setRegisterFormEvents();
				//document.location.hash = link.href.match(/#.*$/ig);
			});
		});
		
		document.querySelector('.training-popup-register').addEventListener('click', () => {
			document.querySelector('.training-popup-register__window').style.opacity = 0;
			document.querySelector('.training-popup-register__window').style.transform = 'translate(0, -32px)';
			document.querySelector('.training-popup-register__window').addEventListener('transitionend', () => {
				document.querySelector('.training-popup-register').style.display = '';
			}, {
				once: true
			});
		});
		
		document.querySelector('.training-popup-register__window').addEventListener('click', e => {
			e.stopPropagation();
		});
		
		preset();
	});
})();