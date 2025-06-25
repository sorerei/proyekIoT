import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import * as THREE from 'three';
import { GLTFLoader }   from 'three/examples/jsm/loaders/GLTFLoader.js';
import { OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import axios from 'axios';

/* ------------------------------ SCENE & CAMERA */
const canvas = document.getElementById('sceneCanvas');
const scene  = new THREE.Scene();
scene.background = new THREE.Color("#f4faff");

const camera = new THREE.PerspectiveCamera(
  45,
  canvas.clientWidth / canvas.clientHeight,
  0.1,
  1000
);
camera.position.set(0, 1, 5);

/* ------------------------------ RENDERER */
const renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
renderer.setSize(canvas.clientWidth, canvas.clientHeight);
renderer.setPixelRatio(window.devicePixelRatio);

/* ------------------------------ LIGHTING */
scene.add(new THREE.AmbientLight(0xffffff, 0.4));
const light = new THREE.DirectionalLight(0xffffff, 1);
light.position.set(5, 10, 7);
scene.add(light);

/* ------------------------------ ORBIT CONTROLS */
const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping   = true;
controls.dampingFactor   = 0.12;
controls.minDistance     = 2;
controls.maxDistance     = 10;
controls.minPolarAngle =
controls.maxPolarAngle   = Math.PI;

/* ------------------------------ LOAD MODEL */
let model = null;
const loader = new GLTFLoader();

loader.load('/models/3DAlat.glb', gltf => {
model = gltf.scene;

  // Atur skala mirror terhadap Y agar orientasi cocok
  model.scale.set(1, 1, 1);

  // Reset rotasi agar tidak ada tambahan rotasi membingungkan
  model.rotation.set(0, 0, 0);

  scene.add(model);
}, undefined, error => {
  console.error('GLB load error:', error);
});

setInterval(updateModelFromAPI, 500); // fetch setiap 0.5 detik


/* ------------------------------ UI BUTTONS */
let zoomDir = 1;

document.querySelectorAll('.btn').forEach(btn => {
  btn.addEventListener('click', () => {
    if (!model) return; // tunggu model selesai load

    switch (btn.dataset.action) {
      case 'rotate':
        model.rotation.y += Math.PI / 8;
        break;
      case 'zoom':
        camera.position.z += 0.5 * zoomDir;
        if (camera.position.z < 2 || camera.position.z > 8) zoomDir *= -1;
        break;
    }
    saveState(model);
  });
});

function updateModelFromAPI() {
  if (!model) return;

  axios.get('/api/rotation') 
    .then(response => {
      const { x, y, z } = response.data;

      // Konversi derajat ke radian
      model.rotation.x = THREE.MathUtils.degToRad(x);
      model.rotation.y = THREE.MathUtils.degToRad(y);
      model.rotation.z = THREE.MathUtils.degToRad(z);
    })
    .catch(console.warn);
}


/* ------------------------------ SYNC TO BACKEND */
function saveState(obj) {
  axios.post('/api/control', {
    x: obj.position.x,  y: obj.position.y,  z: obj.position.z,
    rx: obj.rotation.x, ry: obj.rotation.y, rz: obj.rotation.z,
    zoom: camera.position.z,
    camX: camera.position.x, camY: camera.position.y, camZ: camera.position.z
  }).catch(console.warn);
}

/* ------------------------------ ANIMATION LOOP */
function animate() {
  requestAnimationFrame(animate);
  controls.update();
  renderer.render(scene, camera);
  
}
animate();

/* ------------------------------ RESPONSIVE */
window.addEventListener('resize', () => {
  camera.aspect = canvas.clientWidth / canvas.clientHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(canvas.clientWidth, canvas.clientHeight);
});