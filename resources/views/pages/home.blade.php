<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Monitoring System</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>

<body>
  <header class="navbar">
    <div class="nav-container">
      <h1 class="logo">Monitoring System</h1>

      <div class="hamburger" onclick="toggleMenu()">☰</div>

    </div>

    <nav id="nav-menu">
      <a href="#" class="active">Home</a>
      <a href="{{ route('pages.feature') }}">Fitur</a>
      <a href="{{ route('pages.about') }}">Tentang Kami</a>
      <a href="{{ route('login') }}" class="start-btn">GET STARTED</a>

    </nav>

    <a href="{{ route('login') }}" class="start-btn desktop">GET STARTED</a>
  </header>

  <main class="container">
    <section class="content">
      <div class="text-area">
        <h2>Selamat Datang di Sistem Monitoring <br><span>Air Bearing Controller</span></h2>
        <h3>Sistem Monitoring Air Bearing Berbasis ESP32</h3>
        <p class="desc">Kami dari SABER mengembangkan sistem air bearing untuk rotasi satu sumbu (X, Y, atau Z) tanpa
          gesekan langsung.
          Didukung oleh ESP32, alat ini bisa dikontrol dan dipantau lewat jaringan lokal (IntraNet) dan antarmuka web
          yang sederhana dan responsif.</p>

        <div class="feature-box">
          <p><strong>Apa yang Bisa Dilakukan Sistem Ini?</strong></p>
          <ul>
            <li>✅ Rotasi satu sumbu dengan gerakan halus dan stabil</li>
            <li>✅ Monitoring kecepatan dan posisi secara real-time</li>
            <li>✅ Kontrol penuh lewat jaringan lokal tanpa internet</li>
            <li>✅ Akses mudah lewat web browser dari PC, laptop, atau HP</li>
          </ul>
        </div>

        <button class="start-btn" onclick="window.location.href='{{ route('login') }}'">GET STARTED!</button>
      </div>

      <div class="image-area">
        <img src="{{ asset('img/imageHome1.jpg') }}" alt="Air Bearing" />
      </div>
    </section>
    <div class="circle-decor"></div>
  </main>

  <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>