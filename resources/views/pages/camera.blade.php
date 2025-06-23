<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera</title>
      <link rel="stylesheet" href="{{ asset('css/camera.css') }}" />

</head>
<body>
      <div class="sidebar" id="sidebar">
    <div class="logo">System Monitoring</div>
    <nav>
      <a href="{{ route('pages.dashboard') }}">🏠 Dashboard</a>
      <a href="{{ route('pages.datahistory') }}">📊 Riwayat Data</a>
      <a href="{{ route('pages.control') }}">📐 Kontrol</a>
            <a href="#" class="active">📷 Kamera</a>

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
      <h1>Camera</h1>
    <div class="camera">
        <img src="http://192.168.205.146:8080/?action=stream" alt="Live Camera Feed">
    </div>

      <script src="{{ asset('js/camera.js') }}"></script>
</body>
</html>