// ===================
// Dropdown User Menu
// ===================
function toggleDropdown() {
  const dropdown = document.getElementById("dropdown-menu");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
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

// Tutup dropdown jika klik di luar
window.onclick = function(event) {
  if (!event.target.closest('.user-dropdown')) {
    document.getElementById("dropdown-menu").style.display = "none";
  }
};

// =================== 
// Camera Stream Preload and Swap
// ===================

const imgA = document.getElementById('imgA');
const imgB = document.getElementById('imgB');

let current = imgA;
let buffer = imgB;

function preloadAndSwap() {
  const nextSrc = "{{ url('/camera-snapshot') }}" + "?t=" + new Date().getTime();
  buffer.src = nextSrc;

  buffer.onload = () => {
    // Swap posisi z-index
    buffer.style.zIndex = 1;
    current.style.zIndex = 0;

    // Swap references
    [current, buffer] = [buffer, current];

    // Load next frame
    requestAnimationFrame(preloadAndSwap);
  };

  buffer.onerror = () => {
    setTimeout(preloadAndSwap, 500);
  };
}

// Start camera stream
preloadAndSwap();

