<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profil</title>
  <link rel="stylesheet" href="{{ asset('css/editprofile.css') }}" />
</head>

<body>
  <div class="sidebar" id="sidebar">
    <div class="logo">System Monitoring</div>
    <nav>
      <a href="{{ route('pages.dashboard') }}">🏠 Dashboard</a>
      <a href="{{ route('pages.datahistory') }}">📊 Riwayat Data</a>
      <a href="{{ route('pages.eulergraph') }}">📈 Euler Graph</a>
      <a href="{{ route('pages.control') }}">📐 Kontrol</a>
      <a href="{{ route('pages.camera') }}">📷 Kamera</a>
    </nav>
  </div>
  <div class="overlay" id="overlay" onclick="closeSidebar()"></div>

  <div class="main">
    <!-- Topbar with Dropdown -->
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

    <h1>Edit Profil</h1>

    <div class="form-card">
      <form method="POST" action="{{ route('pages.updateprofile') }}">
        @csrf

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" readonly>
        </div>

        <div class="form-group">
          <label for="current_password">Password Saat Ini</label>
          <input type="password" id="current_password" name="current_password" required>
        </div>

        <div class="form-group">
          <label for="new_password">Password Baru</label>
          <input type="password" id="new_password" name="new_password" required>
        </div>

        <div class="form-group">
          <label for="new_password_confirmation">Konfirmasi Password Baru</label>
          <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <button type="submit" class="register-btn">Ubah Password</button>

        @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

        @if($errors->any())
        <div class="alert-error">
          <ul>
          @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
          </ul>
        </div>
    @endif
      </form>
    </div>
  </div>

  <script src="{{ asset('js/editprofile.js') }}"></script>

</body>

</html>