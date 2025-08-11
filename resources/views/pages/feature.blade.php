<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Monitoring System</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/feature.css') }}" />
</head>

<body>
  <header class="navbar">
    <div class="nav-container">
      <h1 class="logo">Monitoring System</h1>
      <div class="hamburger" onclick="toggleMenu()">☰</div>
    </div>
    <nav id="nav-menu">
      <a href="{{ route('pages.home') }}">Home</a>
      <a href="#" class="active">Fitur</a>
      <a href="{{ route('pages.about') }}">Tentang Kami</a>
      <a href="{{ route('login') }}" class="start-btn">Get Started</a>

    </nav>
    <a href="{{ route('login') }}" class="start-btn desktop">GET STARTED</a>
  </header>

  <main class="main-content">
    <div class="star left"></div>
    <div class="star right"></div>

    <h2 class="title">Fitur Utama</h2>

    <div class="features">
      <div class="feature-card active animate" style="animation-delay: 0.1s;">Monitoring Data Gerak
        <p>Lihat gerak sumbu rotasi di 3 sumbu satelit (Roll(x), Pitch(y), dan Yaw(z)).</p>
      </div>
      <div class="feature-card animate" style="animation-delay: 0.2s;">History Log Otomatis
        <p>Setiap sesi pemantauan akan otomatis tersimpan. Riwayat data memudahkan untuk analisis lebih lanjut evaluasi
          performa sistem.</p>
      </div>
      <div class="feature-card animate" style="animation-delay: 0.4s;">Status Sistem Secara Real Time
        <p>Lihat status terkini sistem secara langsung</p>
      </div>
    </div>
  </main>
  <script src="{{ asset('js/feature.js') }}"></script>

  <div class="circle-decor"></div>
</body>

</html>