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



function loadSumbuChartData() {
  fetch('/api/sumbu-chart-data')
    .then(response => response.json())
    .then(data => {renderSumbuChart(data);       
      renderSumbu1Chart(data);
      renderSumbu2Chart(data);});
}


// ===================
// Fetch Realtime Data
// ===================
function fetchData() {
  $.get('/api/dashboard-data', function(data) {
    if (data) {
      $('#roll').text(data.roll ?? '-');
      $('#pitch').text(data.pitch ?? '-');
      $('#yaw').text(data.yaw ?? '-');
      
      $('#xmagnet').text(data.xmagnet ?? '-');
      $('#ymagnet').text(data.ymagnet ?? '-');
      $('#zmagnet').text(data.zmagnet ?? '-');

      $('#xaccel').text(data.xaccel ?? '-');
      $('#yaccel').text(data.yaccel ?? '-');
      $('#zaccel').text(data.zaccel ?? '-');

      // Update chart dengan 50 data historis
      const labels = data.history.map(item => item.created_at);
      const rollData = data.history.map(item => item.roll);
      const pitchData = data.history.map(item => item.pitch);
      const yawData = data.history.map(item => item.yaw);
    }
  });
}

loadSumbuChartData();
setInterval(loadSumbuChartData, 500);

fetchData();
setInterval(fetchData, 500);
