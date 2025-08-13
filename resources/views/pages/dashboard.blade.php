<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
      <a href="{{ route('pages.eulergraph') }}">📈 Euler Graph</a>
      <a href="{{ route('pages.control') }}">📐 Kontrol</a>
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

    <div style="margin-bottom:16px;">
      <button id="toggle-data-btn" class="btn btn-warning">Matikan Data</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>