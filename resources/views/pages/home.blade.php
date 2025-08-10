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
        <h3>Simulator Sistem Kendali Altitude Satelit dengan Air Bearing</h3>
        <p class="desc">Kami dari SABER mengembangkan sistem monitoring simulator Kendali
          altitude satelit 3 sumbu (x, y, z) dengan air bearing. Didukung oleh ESP32 dan beberapa 
          sistem kontroller tertanam lainnya, memungkinkan aplikasi ini untuk memonitor, menampilkan 
          tangkapan video kamera dan mengontrol pergerakan platform satelit secara real-time.</p>

        <div class="feature-box">
          <p><strong>Apa yang Bisa Dilakukan Sistem Ini?</strong></p>
          <ul>
            <li>✅ Memvisualisasikan gerak rotasi di 3 sumbu satelit (Roll(x), Pitch(y), dan Yaw(z))</li>
            <li>✅ Mengontrol posisi dan kecepatan sudut satelit di satu sumbu (Yaw(z)) menggunakan aktuator reaction wheel</li>
            <li>✅ Kontrol penuh lewat jaringan lokal tanpa internet</li>
            <li>✅ Akses mudah lewat web browser dari PC, laptop, atau HP</li>
          </ul>
        </div>
        <p class="desc">Simulator kendali altitude satelit ini dibuat untuk mensimulasikan dan memvisualisasikan
          pergerakan rotasi satelit di orbit, untuk tujuan pembelajaran dan riset sistem Altitude Determination
          and Control Satellite (ADCS) sebagai salah satu sub-sistem terpenting dari sebuah sistem satelit.</p>

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