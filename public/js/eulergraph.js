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
let sumbuChart;

function renderSumbuChart(data) {
  const ctx = document.getElementById('sumbuChart').getContext('2d');

  if (sumbuChart) sumbuChart.destroy();

  sumbuChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels,
      datasets: [
        {
          label: 'Roll (X)',
          data: data.roll,
          borderColor: '#FF6384',
          fill: false,
          tension: 0.4
        },
        {
          label: 'Pitch (Y)',
          data: data.pitch,
          borderColor: '#36A2EB',
          fill: false,
          tension: 0.4
        },
        {
          label: 'Yaw (Z)',
          data: data.yaw,
          borderColor: '#FFCE56',
          fill: false,
          tension: 0.4
        }
      ]
    },
    options: {
      responsive: true,
      animation: false,
      plugins: {
        legend: {
          labels: {
            color: 'white' // Warna label legend
          }
        },
        title: {
          display: false
        },
        tooltip: {
          bodyColor: 'white',
          titleColor: 'white'
        }
      },
      scales: {
        x: {
          ticks: {
            color: 'white' // Warna angka di sumbu X
          },
          title: {
            display: true,
            text: 'Waktu',
            color: 'white' // Warna judul sumbu X
          },
          grid: {
            color: 'rgba(255, 255, 255, 0.2)' // Warna garis grid X
          }
        },
        y: {
          ticks: {
            color: 'white' // Warna angka di sumbu Y
          },
          title: {
            display: true,
            text: 'Nilai Sumbu',
            color: 'white' // Warna judul sumbu Y
          },
          grid: {
            color: 'rgba(255, 255, 255, 0.2)' // Warna garis grid Y
          }
        }
      }
    }
  });
}

let sumbu1Chart;

function renderSumbu1Chart(data) {
  const ctx = document.getElementById('sumbu1Chart').getContext('2d');
  if (sumbu1Chart) sumbu1Chart.destroy();

  sumbu1Chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels,
      datasets: [
        {
          label: 'X Magnet',
          data: data.xmagnet,
          borderColor: '#FF6384',
          fill: false,
          tension: 0.4
        },
        {
          label: 'Y Magnet',
          data: data.ymagnet,
          borderColor: '#36A2EB',
          fill: false,
          tension: 0.4
        },
        {
          label: 'Z Magnet',
          data: data.zmagnet,
          borderColor: '#FFCE56',
          fill: false,
          tension: 0.4
        }
      ]
    },
    options: {
      responsive: true,
      animation: false,
      plugins: {
        legend: {
          labels: {
            color: 'white'
          }
        },
        tooltip: {
          bodyColor: 'white',
          titleColor: 'white'
        }
      },
      scales: {
        x: {
          ticks: { color: 'white' },
          title: {
            display: true,
            text: 'Waktu',
            color: 'white'
          },
          grid: {
            color: 'rgba(255,255,255,0.2)'
          }
        },
        y: {
          ticks: { color: 'white' },
          title: {
            display: true,
            text: 'Nilai Magnet',
            color: 'white'
          },
          grid: {
            color: 'rgba(255,255,255,0.2)'
          }
        }
      }
    }
  });
}


let sumbu2Chart;

function renderSumbu2Chart(data) {
  const ctx = document.getElementById('sumbu2Chart').getContext('2d');
  if (sumbu2Chart) sumbu2Chart.destroy();

  sumbu2Chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: data.labels,
      datasets: [
        {
          label: 'X Accel',
          data: data.xaccel,
          borderColor: '#FF6384',
          fill: false,
          tension: 0.4
        },
        {
          label: 'Y Accel',
          data: data.yaccel,
          borderColor: '#36A2EB',
          fill: false,
          tension: 0.4
        },
        {
          label: 'Z Accel',
          data: data.zaccel,
          borderColor: '#FFCE56',
          fill: false,
          tension: 0.4
        }
      ]
    },
    options: {
      responsive: true,
      animation: false,
      plugins: {
        legend: {
          labels: {
            color: 'white'
          }
        },
        tooltip: {
          bodyColor: 'white',
          titleColor: 'white'
        }
      },
      scales: {
        x: {
          ticks: { color: 'white' },
          title: {
            display: true,
            text: 'Waktu',
            color: 'white'
          },
          grid: {
            color: 'rgba(255,255,255,0.2)'
          }
        },
        y: {
          ticks: { color: 'white' },
          title: {
            display: true,
            text: 'Nilai Akselerasi',
            color: 'white'
          },
          grid: {
            color: 'rgba(255,255,255,0.2)'
          }
        }
      }
    }
  });
}

function isDisplayPaused() {
  // Ambil status pause dari localStorage, default false (tidak pause)
  return localStorage.getItem('displayPaused') === 'true';
}

let lastSumbuChartData = null;
let chartInitialized = false;

function saveChartDataToStorage(data) {
  localStorage.setItem('lastSumbuChartData', JSON.stringify(data));
}

function loadChartDataFromStorage() {
  const saved = localStorage.getItem('lastSumbuChartData');
  return saved ? JSON.parse(saved) : null;
}

function loadSumbuChartData() {
  // Jika pause, jangan ambil data baru, tampilkan data terakhir dari localStorage
  if (isDisplayPaused()) {
    const lastData = loadChartDataFromStorage();
    if (lastData) {
      renderSumbuChart(lastData);
      renderSumbu1Chart(lastData);
      renderSumbu2Chart(lastData);
      chartInitialized = true;
    }
    return;
  }
  // Jika tidak pause, ambil data baru dari server
  fetch('/api/sumbu-chart-data')
    .then(response => response.json())
    .then(data => {
      lastSumbuChartData = data;
      saveChartDataToStorage(data);
      if (!chartInitialized) {
        renderSumbuChart(data);
        renderSumbu1Chart(data);
        renderSumbu2Chart(data);
        chartInitialized = true;
        return;
      }
      renderSumbuChart(data);
      renderSumbu1Chart(data);
      renderSumbu2Chart(data);
    });
}

// Jika user menekan "lanjutkan" setelah pause, tampilkan data terbaru yang sudah diterima
window.addEventListener('storage', function(e) {
  if (e.key === 'displayPaused' && e.newValue === 'false') {
    loadSumbuChartData();
  }
});

// Inisialisasi grafik saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
  loadSumbuChartData();
});

// Interval pengambilan data otomatis
let chartInterval = null;
function startChartInterval() {
  if (chartInterval) clearInterval(chartInterval);
  chartInterval = setInterval(() => {
    loadSumbuChartData();
  }, 500);
}
startChartInterval();

function showRPYData(data) {
  $('#roll').text(data.roll ?? '-');
  $('#pitch').text(data.pitch ?? '-');
  $('#yaw').text(data.yaw ?? '-');
  // Simpan data terakhir ke localStorage
  localStorage.setItem('lastRPYData', JSON.stringify(data));
}

function fetchRPYData(force = false) {
  if (isDisplayPaused() && !force) return;
  $.get('/api/dashboard-data', function(data) {
    if (data) {
      showRPYData(data);
    }
  });
}

// Saat halaman di-refresh dan kondisi pause, tampilkan data terakhir dari localStorage
$(document).ready(function() {
  if (isDisplayPaused()) {
    const saved = localStorage.getItem('lastRPYData');
    if (saved) {
      showRPYData(JSON.parse(saved));
    }
  } else {
    fetchRPYData();
  }
});

// Interval pengambilan data otomatis
let rpyInterval = null;
function startRPYInterval() {
  if (rpyInterval) clearInterval(rpyInterval);
  rpyInterval = setInterval(function() {
    fetchRPYData();
  }, 500);
}
startRPYInterval();

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