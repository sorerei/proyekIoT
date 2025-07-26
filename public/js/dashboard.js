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

let displayPaused = localStorage.getItem('displayPaused') === 'true';

function setDisplayPaused(status) {
  displayPaused = status;
  localStorage.setItem('displayPaused', status ? 'true' : 'false');
  $('#toggle-data-btn').text(status ? 'Lanjutkan Data' : 'Pause Data');
  $('#toggle-data-btn').toggleClass('btn-warning', !status);
  $('#toggle-data-btn').toggleClass('btn-success', status);
}

$('#toggle-data-btn').on('click', function() {
  setDisplayPaused(!displayPaused);
});

$(document).ready(function() {
  setDisplayPaused(displayPaused);
});

