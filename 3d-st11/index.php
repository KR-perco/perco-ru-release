<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<style>
.model {display: none; justify-content: center; align-items: center; position: fixed; left: 0; top: 0; z-index: 1000; margin: 0!important; block-size: 100%; inline-size: 100%;}
.model__canvas {block-size: 100%; inline-size: 100%;}
.model-preloader {display: flex; justify-content: center; align-items: center; position: absolute; left: 0; top: 0; block-size: 100%; inline-size: 100%; background: grey;}
.model-preloader__window {display: flex; justify-content: center; align-items: center; position: relative;}
.model-preloader__img {animation: 2s linear 0s infinite preloader-rotation;}
.model-preloader__text {position: absolute; color: white; font-size: 28px;}
.model__close-button {position: absolute; z-index: 1001; right: 32px; top: 32px; padding: 8px 16px; color: white; font-size: 24px; cursor: pointer; user-select: none;}
.model__close-button:hover {background: #80808080;}
.model__text-popup {display: none; position: absolute; z-index: 1001; bottom: 20%; padding: 8px 16px; color: white; font-size: 24px; background: #808080c0; user-select: none;}
.model__center-button {display: none; position: absolute; z-index: 1001; bottom: 20%; padding: 8px 16px; color: white; font-size: 24px; background: #808080c0; user-select: none; cursor: pointer;}
.model__center-button:hover {background: #808080e0;}

@keyframes preloader-rotation {
	from {transform: rotateZ(0deg);}
	to {transform: rotateZ(360deg);}
}
</style>
<div class="model-button" style="inline-size: 96px; text-align: center;">
	<a href="#" data-model="ST01-2.gltf" title="3D модель">
		<img src="/images/icons/3d-video.svg" alt="3D модель" style="block-size: 46px;">
		<div>
			<span class="dashed">3D-модель</span>
		</div>
	</a>
</div>
<div class="model" data-loaded="false">
	<canvas class="model__canvas"></canvas>
	<div class="model-preloader">
		<div class="model-preloader__window">
			<img class="model-preloader__img" src="preloader.png">
			<div class="model-preloader__text"></div>
		</div>
	</div>
	<div class="model__close-button">Закрыть</div>
	<div class="model__text-popup">Используйте мышь для управления</div>
	<div class="model__center-button">Вернуться в центр</div>
</div>
<script src="main.js"></script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>