<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Data</title>
  <link rel="stylesheet" href="{{ asset('css/datahistory.css') }}" />
</head>
<body>
  <div class="sidebar" id="sidebar">
  <div class="logo">System Monitoring</div>
  <nav>
      <a href="{{ route('pages.dashboard') }}">🏠 Dashboard</a>
      <a href="#" class="active">📊 Riwayat Data</a>
      <a  href="{{ route('pages.control') }}">📐 Kontrol</a>
            <a href="{{ route('pages.camera') }}">📷 Kamera</a>

    </nav>
</div>


  <div class="main">
    <!-- Tombol toggle untuk sidebar -->

<!-- Overlay saat sidebar aktif -->
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

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

    <h1>Riwayat Data</h1>

    <div class="filters">
  <form method="GET" action="{{ route('pages.datahistory') }}">
  <div class="filter-row">  
  <div class="filter-group">
      <button type="button">Rentang Waktu</button>
      <input type="date" name="start_date" value="{{ request('start_date') }}">
      <input type="date" name="end_date" value="{{ request('end_date') }}">
    </div>
    <div class="filter-group">
      <button type="button">Tekanan</button>
      <input type="text" name="beban" placeholder="Tekanan" value="{{ request('beban') }}">
    </div>
    <div class="filter-group">
      <button type="button">Kecepatan</button>
      <input type="text" name="kecepatan" placeholder="RPM" value="{{ request('kecepatan') }}">
    </div>
  </div>
  <div class="filter-actions">
    <button class="apply-btn" type="submit">Terapkan</button>
    <button type="button" class="reset-btn" onclick="window.location.href='{{ route('pages.datahistory') }}'">Reset</button>
  </div>

  </form>
</div>

<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>Waktu</th>
        <th>Tekanan (Bar)</th>
        <th>Kecepatan Putar (RPM)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($data as $row)
        <tr>
          <td>{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s') }}</td>
          <td>{{ number_format((float)$row->beban, 1, ',', '.') }}</td>
          <td>{{ $row->kecepatan }}</td>
          <td>{{ $row->status_sistem }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" style="text-align: center">Tidak ada data</td>
        </tr>
      @endforelse
    </tbody>
  </table>
  <div class="pagination-wrapper">
    {{ $data->links('vendor.pagination.custom') }}
</div>

</div>
  </div>

  <script src="{{ asset('js/riwayatdata.js') }}"></script>
</body>
</html>
