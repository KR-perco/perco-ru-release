window.addEventListener('load', () => {
	$('#po>tspan:first').text('Ethernet');
	$('#po>tspan:last').text('Logiciel');
	$('#ip-style>tspan:nth-child(1)').text('Toutniquet');
	$('#ip-style>tspan:nth-child(2)').text('');
	$('#ip-style>tspan:nth-child(3)').text('');
	$('#reader>tspan:nth-child(1)').text('Lecteurs de cartes');
	$('#reader>tspan:nth-child(2)').text('de proximité intégrés');
	$('#contr').text('jusqu’à 8 contrôleurs');
	$('#controller, #controller2').text('Contrôleur');
	$('#lock, #lock2').text('Serrure');
	console.log($('#model[y="42"]').text());
	$('#model[y="38"]').text('IP-stile');
	$('#model[y="42"]').text('KT05.9A');
});