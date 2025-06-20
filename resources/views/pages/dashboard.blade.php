<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Monitoring Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="sidebar" id="sidebar">
    <div class="logo">System Monitoring</div>
    <nav>
      <a href="#" class="active">🏠 Dashboard</a>
      <a href="{{ route('pages.datahistory') }}">📊 Riwayat Data</a>
      <a  href="{{ route('pages.control') }}">📐 Kontrol</a>
            <a href="{{ route('pages.camera') }}">📷 Kamera</a>

    </nav>
  </div>
  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>


  <div class="main">
    <div class="topbar">
      <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
      <div class="user-dropdown" onclick="toggleDropdown()">
        <span>Hallo! {{ Auth::user()->username }} 🌐 ▼</span>
        <div id="dropdown-menu" class="dropdown-content">
          <a href="{{ route('pages.editprofile') }}">✏️ Edit Profil</a>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🔓 Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>

    <h1>Dashboard</h1>

    <div class="top-cards">
      <div class="card dark">Status Sistem<br><strong id="status-sistem">{{ $data->status_sistem ?? '-' }}</strong></div>
      <div class="card lightblue">Posisi Sumbu<br><strong id="posisi-sumbu">{{ $data->posisi_sumbu ?? '-' }}</strong></div>
      <div class="card dark">Kecepatan<br><strong id="kecepatan">{{ $data->kecepatan ?? '-' }}</strong></div>
    </div>

    <div class="content-layout">
      <div class="side-data">
        <div class="card right">Beban<br><strong id="beban">{{ $data->beban ?? '-' }}</strong></div>
        <div class="card right lightblue">Kemiringan<br><strong id="kemiringan">{{ $data->kemiringan ?? '-' }}</strong></div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
