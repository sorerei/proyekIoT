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
  <div class="layout">

  </div>
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
      <div class="card dark">Data RPY<br>
        <p>X (Raw) : <strong id="roll">{{ $data->roll ?? '-' }}</strong>, Y (Pitch) : <strong id="pitch">{{ $data->pitch ?? '-' }}</strong>,  Z (Yaw) : <strong id="yaw">{{ $data->yaw ?? '-' }}</strong></p>
      </div>
    </div>

      <div class="side-data">

        <div class="chart-container">
          <div class="chart-wrapper">
              <canvas id="sumbuChart"></canvas>
          </div>
        </div>
      </div>
      <br></br>
      <div class="top-cards">
          <div class="card dark">Medan Magnet<br>
                    <p>X : <strong id="xmagnet">{{ $data->xmagnet ?? '-' }}</strong>, Y : <strong id="ymagnet">{{ $data->ymagnet ?? '-' }}</strong>,  Z : <strong id="zmagnet">{{ $data->zmagnet ?? '-' }}</strong></p>

          </div>
      </div>

      <div class="side-data">
        <div class="chart-container">
          <div class="chart-wrapper">
              <canvas id="sumbu1Chart"></canvas>
          </div>
      </div>
      <br></br>
      <div class="top-cards">
          <div class="card dark">Kecepatan<br>
                    <p>X : <strong id="xaccel">{{ $data->xaccel ?? '-' }}</strong>, Y : <strong id="yaccel">{{ $data->yaccel ?? '-' }}</strong>,  Z : <strong id="zaccel">{{ $data->zaccel ?? '-' }}</strong></p>

          </div>
      </div>

      <div class="side-data">
        <div class="chart-container">
          <div class="chart-wrapper">
              <canvas id="sumbu2Chart"></canvas>
          </div>  
      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
