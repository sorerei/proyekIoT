<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>3D Control</title>
  <link rel="stylesheet" href="{{ asset('css/model.css') }}" />
  @vite(['resources/js/app.js'])

</head>

<body>
  <div class="sidebar" id="sidebar">
    <div class="logo">System Monitoring</div>
    <nav>
      <a href="{{ route('pages.dashboard') }}">🏠 Dashboard</a>
      <a href="{{ route('pages.datahistory') }}">📊 Riwayat Data</a>
      <a href="{{ route('pages.eulergraph') }}">📈 Euler Graph</a>
      <a href="#" class="active">🛰️ 3D Model</a>
      <a href="{{ route('pages.camera') }}">📷 Kamera</a>
    </nav>
  </div>

  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <div class="main">
    <!-- Topbar -->
    <div class="topbar">

      <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

      <div class="user-dropdown" onclick="toggleDropdown()">

        <b><span>Hallo! {{ Auth::user()->username}} 🌐 ▼</span></b>
        <div id="dropdown-menu" class="dropdown-content">
          <a href="{{ route('pages.editprofile') }}">✏️ Edit Profil</a>
          <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🔓 Logout</a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>
    <!-- Kontainer utama untuk model 3D dan kontrolnya -->
    <div class="">
      <!-- Kontainer model 3D dengan latar belakang gelap dan sudut membulat -->
      <div class="kontrol-container">
        <h2 class="">Model 3D</h2>
        <!-- Tambahkan di file control.blade.php, tepat sebelum/di atas canvas -->
        <div id="rotation-legend" style="
          position: absolute;
          top: 20px;
          left: 30vw;
          background: rgba(255,255,255,0.8);
          color: #222;
          padding: 6px 16px;
          border-radius: 8px;
          font-family: monospace;
          font-size: 1.1em;
          z-index: 20;
          pointer-events: none;
          box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        "></div>
        <!-- Elemen canvas untuk rendering 3D Three.js -->
        <canvas id="sceneCanvas" class="model-canvas"></canvas>
      </div>
    </div>
    <script src="{{ asset('js/model.js') }}"></script>
</body>

</html>