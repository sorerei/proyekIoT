function toggleDropdown() {
    const dropdown = document.getElementById("dropdown-menu");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
  }
  
  window.onclick = function(event) {
    if (!event.target.closest('.user-dropdown')) {
      const dropdown = document.getElementById("dropdown-menu");
      if (dropdown) dropdown.style.display = "none";
    }
  };

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

function isDisplayPaused() {
  // Ambil status pause dari localStorage, default false (tidak pause)
  return localStorage.getItem('displayPaused') === 'true';
}

$(document).ready(function() {
  function refreshTable() {
    if (isDisplayPaused()) {
      // Saat pause, tampilkan data terakhir dari localStorage (jika ada)
      const saved = localStorage.getItem('lastHistoryTable');
      if (saved) {
        $('.table-container').html(saved);
      }
      return;
    }
    $.get(window.location.href, function(response) {
      // Ambil isi tabel dari response HTML
      const newTable = $(response).find('.table-container').html();
      $('.table-container').html(newTable);
      // Simpan data terakhir ke localStorage
      localStorage.setItem('lastHistoryTable', newTable);
    });
  }

  // OPTIMALISASI: Saat halaman di-refresh dan pause, langsung tampilkan data terakhir sebelum interval berjalan
  if (isDisplayPaused()) {
    const saved = localStorage.getItem('lastHistoryTable');
    if (saved) {
      $('.table-container').html(saved);
    }
  }

  setInterval(refreshTable, 500); // Refresh tiap 0.5 detik
});
