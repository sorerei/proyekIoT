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


function loadSumbuChartData() {
  fetch('/api/sumbu-chart-data')
    .then(response => response.json())
    .then(data => renderSumbuChart(data));
}


// ===================
// Fetch Realtime Data
// ===================
function fetchData() {
  $.get('/api/dashboard-data', function(data) {
    if (data) {
      // Update elemen statis
      $('#status').text(data.status_sistem || '-');
      $('#kecepatan').text(data.kecepatan || '-');
      $('#beban').text(data.beban || '-');
      $('#kemiringan').text(data.kemiringan || '-');
      $('#medan_magnet').text(data.medan_magnet || '-');

      // Update chart dengan 50 data historis
      const labels = data.history.map(item => item.created_at);
      const rollData = data.history.map(item => item.roll);
      const pitchData = data.history.map(item => item.pitch);
      const yawData = data.history.map(item => item.yaw);
    }
  });
}

loadSumbuChartData();
setInterval(loadSumbuChartData, 10000);
  fetchData();
  setInterval(fetchData, 5000); // per 5 detik
