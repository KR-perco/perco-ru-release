'use strict';
(() => {
	window.addEventListener('load', () => {
		document.querySelector('.model-button a').addEventListener('click', function (event) {
			event.preventDefault();
			const model = document.querySelector('.model');
			if (model.dataset.loaded == 'true') {
				model.style.display = 'flex';
				return;
			}
			const script = document.createElement('script');
			script.addEventListener('load', () => {
				const scriptLoader = document.createElement('script');
				scriptLoader.addEventListener('load', () => {
					if (!BABYLON.Engine.isSupported()) {
						console.error('Babylon не поддерживается');
						return;
					}
					
					model.style.display = 'flex';
					model.dataset.loaded = 'true';
					
					let mouseButtonRightPressed = false;
					let animations;
					
					const canvas = document.querySelector(`.model__canvas`);
					const engine = new BABYLON.Engine(canvas, true);
					
					engine.enableOfflineSupport = false;
					BABYLON.Animation.AllowMatricesInterpolation = true;
					
					function modelPreloader () {};
					modelPreloader.prototype.displayLoadingUI = () => {
						document.querySelector('.model-preloader').style.display = 'flex';
					};
					modelPreloader.prototype.hideLoadingUI = () => {
						document.querySelector('.model-preloader').style.display = 'none';
						document.querySelector('.model__text-popup').style.display = 'block';
					};
					engine.loadingScreen = new modelPreloader();
					
					const scene = new BABYLON.Scene(engine);
					const camera = new BABYLON.ArcRotateCamera("camera", 0, Math.PI / 2, 3, new BABYLON.Vector3(0, 0, 0));
					//const light = new BABYLON.HemisphericLight("light", new BABYLON.Vector3(0, 1, 0));
					scene.clearColor = new BABYLON.Color3(.8, .8, .8);
					
					BABYLON.SceneLoader.ImportMesh(
						undefined,
						"./",
						"ST01-anim.gltf",
						scene, (
							meshes,
							particleSystems,
							skeletons,
							animationList
						) => {
							console.log(meshes);
							animations = animationList;
							animations[0].stop();
							engine.hideLoadingUI();
						}, (progress) => {
							document.querySelector('.model-preloader__text').innerText = `${Math.round(progress.loaded / progress.total * Math.pow(10, 2))}%`;
						}
					);
					
					var reflectionTexture = new BABYLON.HDRCubeTexture("./21_2.hdr", scene, 128, false, true, false, true);
					reflectionTexture.rotationY = 2.5;
					scene.environmentTexture = reflectionTexture;
					
					scene.activeCamera.attachControl(canvas, true);
					scene.activeCamera.panningSensibility = 100;
					scene.activeCamera.panningDistanceLimit = 700;
					scene.activeCamera.inertia = .2;
					scene.activeCamera.lowerRadiusLimit = 64;
					scene.activeCamera.upperRadiusLimit = 384;
					scene.activeCamera.upperBetaLimit = 1.5;
					
					engine.runRenderLoop(() => {
						scene.render();
						engine.resize();
					});
					
					/*BABYLON.SceneLoader.Load("", "ST01.babylon", engine, function (scene) {
						
						BABYLON.SceneLoader.ImportMesh(
							undefined, // Name of meshes to load
							"./", // Path on a server for the file
							"ST01.gltf", // The file name that should be loaded from the above path
							scene, // The scene to load this mesh/model file into
							function (
								meshes, 
								particleSystems,
								skeletons,
								animationList
							) {
								// Custom Code to run after Loading has finished
							}
						);
						
						scene.activeCamera.attachControl(canvas, true);
						//scene.activeCamera.panningSensibility = 100;
						scene.activeCamera.panningSensibility = 100;
						scene.activeCamera.panningDistanceLimit = 700;
						scene.activeCamera.inertia = .7;
						scene.activeCamera.lowerRadiusLimit = 64;
						scene.activeCamera.upperRadiusLimit = 256;
						scene.activeCamera.upperBetaLimit = 1.5;
						
						engine.runRenderLoop(() => {
							if (scene.activeCamera.position.y < 40) {
								scene.activeCamera.position = new BABYLON.Vector3(scene.activeCamera.position.x, 40, scene.activeCamera.position.z);
							}
							scene.render();
							engine.resize();
						});
					}, (progress) => {
						document.querySelector('.model-preloader__text').innerText = `${Math.round(progress.loaded / progress.total * Math.pow(10, 2))}%`;
					});*/

					window.addEventListener('resize', () => {
						engine.resize();
					});
					document.querySelector('.model__close-button').addEventListener('click', () => {
						model.style.display = 'none';
					});
					window.addEventListener('pointerdown', () => {
						document.querySelector('.model__text-popup').style.display = 'none';
					}, {
						once: true
					});
					window.addEventListener('pointerdown', event => {
						if (event.which == 3) {
							mouseButtonRightPressed = true;
							animations[0].play();
						}
					});
					window.addEventListener('pointerup', event => {
						if (event.which == 3) {
							mouseButtonRightPressed = false;
						}
					});
					window.addEventListener('pointermove', event => {
						if (mouseButtonRightPressed) {
							if (scene.activeCamera.target.x != 0 || scene.activeCamera.target.y != 0 || scene.activeCamera.target.z != 0) {
								document.querySelector('.model__center-button').style.display = 'block';
							}
							console.log(scene.activeCamera.target.y);
						}
					});
					document.querySelector('.model__center-button').addEventListener('click', function () {
						this.style.display = 'none';
						scene.activeCamera.target = new BABYLON.Vector3(0, 0, 0);
					});
				});
				scriptLoader.src = 'https://cdn.babylonjs.com/loaders/babylonjs.loaders.min.js';
				document.getElementsByTagName('head')[0].appendChild(scriptLoader);
			}, {
				once: true
			});
			script.src = 'https://cdn.babylonjs.com/babylon.js';
			document.getElementsByTagName('head')[0].appendChild(script);
		});
	});
})();