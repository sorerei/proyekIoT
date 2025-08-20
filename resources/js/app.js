function toggleDropdown() {
      document.querySelector('.user-dropdown').classList.toggle('active');
    }

     
  function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");

  sidebar.classList.toggle("active");
  overlay.style.display = sidebar.classList.contains("active") ? "block" : "none";
}

function closeSidebar() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");

  sidebar.classList.remove("active");
  overlay.style.display = "none";
}

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

// Tambahkan sumbu global (tetap) dengan label dan warna berbeda
const axesHelper = new THREE.AxesHelper(1.5);
scene.add(axesHelper);

// Tambahkan label untuk sumbu global
function createAxisLabel(text, color) {
  const canvas = document.createElement('canvas');
  canvas.width = 128;
  canvas.height = 32;
  const ctx = canvas.getContext('2d');
  ctx.font = 'bold 24px Arial';
  ctx.fillStyle = color;
  ctx.textAlign = 'center';
  ctx.textBaseline = 'middle';
  ctx.fillText(text, canvas.width / 2, canvas.height / 2);
  const texture = new THREE.CanvasTexture(canvas);
  const material = new THREE.SpriteMaterial({ map: texture, depthTest: false });
  const sprite = new THREE.Sprite(material);
  sprite.scale.set(0.5, 0.125, 1);
  return sprite;
}

// Label untuk sumbu global
const labelX = createAxisLabel('Y', '#ff0000');
const labelY = createAxisLabel('X', '#00ff00');
const labelZ = createAxisLabel('Z', '#0000ff');
labelX.position.set(1.6, 0, 0);
labelY.position.set(0, 1.6, 0);
labelZ.position.set(0, 0, 1.6);
scene.add(labelX, labelY, labelZ);

const camera = new THREE.PerspectiveCamera(
  45,
  canvas.clientWidth / canvas.clientHeight,
  0.1,
  1000
);
// Atur posisi kamera agar default zoom seperti gambar kedua
camera.position.set(0, 1, 8); // sebelumnya 0, 1, 5

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
controls.minPolarAngle = 0;
controls.maxPolarAngle   = Math.PI;
//controls.enableRotate = true;


/* ------------------------------ LOAD MODEL */
let model = null;
const loader = new GLTFLoader();

loader.load('/models/3DAlat.glb', function (gltf)  {
  model = gltf.scene;

  model.scale.set(1, 1, 1);

  // Atur posisi dan rotasi default model sesuai permintaan:
  // X = 90°, Y = 180°, Z = 180°
  model.position.set(0, 0, 0);
  model.rotation.set(
    THREE.MathUtils.degToRad(90),   // X = 90°
    THREE.MathUtils.degToRad(180),  // Y = 180°
    THREE.MathUtils.degToRad(180)   // Z = 180°
  );

  model.traverse(child => {
    if (child.isMesh) {
      child.castShadow = false;
      child.receiveShadow = false;
      child.frustumCulled = true;
      child.geometry.computeBoundingSphere();
    }
  });

  // Tambahkan sumbu lokal (bergerak) dengan warna berbeda
  const localAxesHelper = new THREE.AxesHelper(1.2);
  localAxesHelper.setColors(
    new THREE.Color('#ffaaaa'), // X' lebih muda
    new THREE.Color('#aaffaa'), // Y' lebih muda
    new THREE.Color('#aaaaff')  // Z' lebih muda
  );
  model.add(localAxesHelper);

  // Label untuk sumbu lokal
  const labelXl = createAxisLabel("Y'", '#ffaaaa');
  const labelYl = createAxisLabel("Z'", '#aaffaa');
  const labelZl = createAxisLabel("X'", '#aaaaff');
  labelXl.position.set(1.3, 0, 0);
  labelYl.position.set(0, 1.3, 0);
  labelZl.position.set(0, 0, 1.3);
  model.add(labelXl, labelYl, labelZl);

  scene.add(model);
}, undefined, error => {
  console.error('GLB load error:', error);
});

// Pastikan juga targetRotation diinisialisasi sama:
let targetRotation = {
  x: THREE.MathUtils.degToRad(90),
  y: THREE.MathUtils.degToRad(180),
  z: THREE.MathUtils.degToRad(180)
};

setInterval(updateModelFromAPI, 1000); // fetch setiap 1 detik


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
      targetRotation.x = THREE.MathUtils.degToRad(x);
      targetRotation.y = THREE.MathUtils.degToRad(y);
      targetRotation.z = THREE.MathUtils.degToRad(z);
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
const clock = new THREE.Clock();

function animate() {
  requestAnimationFrame(animate);
  const delta = clock.getDelta(); // waktu antar frame (dalam detik)


   // Interpolasi rotasi agar smooth
  if (model) {
        const lerpFactor = 5 * delta; // kecepatan interpolasi (semakin besar = makin cepat)
    model.rotation.x += (targetRotation.x - model.rotation.x) * lerpFactor;
    model.rotation.y += (targetRotation.y - model.rotation.y) * lerpFactor;
    model.rotation.z += (targetRotation.z - model.rotation.z) * lerpFactor;
  }

  // Update rotasi legend lokal agar selalu sama dengan model
  if (scene.userData.localLegendGroup && model) {
    scene.userData.localLegendGroup.rotation.x = model.rotation.x;
    scene.userData.localLegendGroup.rotation.y = model.rotation.y;
    scene.userData.localLegendGroup.rotation.z = model.rotation.z;
  }

  controls.update();
  renderer.render(scene, camera);
  
}
animate();

/* ------------------------------ RESPONSIVE */
window.addEventListener('resize', () => {
  const width = canvas.clientWidth;
  const height = canvas.clientHeight;
  camera.aspect = width / height;
  camera.updateProjectionMatrix();
  renderer.setSize(width, height, false);
});

// Tambahkan legend gabungan sumbu global (XYZ) dan lokal (X'Y'Z') di pojok kiri atas, TANPA offset
function addCombinedLegendAxes(position = {x: -2, y: 2, z: 0}) {
  const legendGroup = new THREE.Group();

  // Sumbu legend global (besar)
  const legendAxes = new THREE.AxesHelper(0.6);
  legendGroup.add(legendAxes);

  // Label legend global
  const lx = createAxisLabel('Y', '#ff0000');
  const ly = createAxisLabel('X', '#00ff00');
  const lz = createAxisLabel('Z', '#0000ff');
  lx.position.set(0.7, 0, 0);
  ly.position.set(0, 0.7, 0);
  lz.position.set(0, 0, 0.7);
  legendGroup.add(lx, ly, lz);

  // Sumbu legend lokal (x'y'z') TANPA offset, tepat di tengah legend global
  const localLegendGroup = new THREE.Group();
  const localLegendAxes = new THREE.AxesHelper(0.4);
  localLegendAxes.setColors(
    new THREE.Color('#ffaaaa'), // X'
    new THREE.Color('#aaffaa'), // Y'
    new THREE.Color('#aaaaff')  // Z'
  );
  localLegendGroup.add(localLegendAxes);

  // Label legend lokal (tanpa offset, tumpuk di tengah)
  const lx2 = createAxisLabel("Y'", '#ffaaaa');
  const ly2 = createAxisLabel("Z'", '#aaffaa');
  const lz2 = createAxisLabel("X'", '#aaaaff');
  lx2.position.set(0.5, 0, 0);
  ly2.position.set(0, 0.5, 0);
  lz2.position.set(0, 0, 0.5);
  localLegendGroup.add(lx2, ly2, lz2);

  // Gabungkan group lokal ke legend utama TANPA offset
  legendGroup.add(localLegendGroup);

  // Tempatkan di pojok kiri atas (atau posisi lain sesuai kebutuhan)
  legendGroup.position.set(position.x, position.y, position.z);

  // Simpan referensi group lokal agar bisa diupdate rotasinya
  scene.userData.localLegendGroup = localLegendGroup;

  scene.add(legendGroup);
}
addCombinedLegendAxes({x: -2, y: 2, z: 0});