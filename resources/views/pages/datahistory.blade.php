<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Data</title>
  <link rel="stylesheet" href="{{ asset('css/datahistory.css') }}" />
</head>

<body>
  <div class="sidebar" id="sidebar">
    <div class="logo">System Monitoring</div>
    <nav>
      <a href="{{ route('pages.dashboard') }}">🏠 Dashboard</a>
      <a href="#" class="active">📊 Riwayat Data</a>
      <a href="{{ route('pages.eulergraph') }}">📈 Euler Graph</a>
      <a href="{{ route('pages.control') }}">📐 Kontrol</a>
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
            <button type="button">Roll</button>
            <input type="text" name="roll" value="{{ request('roll') }}">
          </div>
          <div class="filter-group">
            <button type="button">Pitch</button>
            <input type="text" name="pitch" value="{{ request('pitch') }}">
          </div>
          <div class="filter-group">
            <button type="button">Yaw</button>
            <input type="text" name="yaw" value="{{ request('yaw') }}">
          </div>
          <div class="filter-group">
            <button type="button">X Magnet</button>
            <input type="text" name="xmagnet" value="{{ request('xmagnet') }}">
          </div>
          <div class="filter-group">
            <button type="button">Y Magnet</button>
            <input type="text" name="ymagnet" value="{{ request('ymagnet') }}">
          </div>
          <div class="filter-group">
            <button type="button">Z Magnet</button>
            <input type="text" name="zmagnet" value="{{ request('zmagnet') }}">
          </div>
          <div class="filter-group">
            <button type="button">X Accel</button>
            <input type="text" name="xaccel" value="{{ request('xaccel') }}">
          </div>
          <div class="filter-group">
            <button type="button">Y Accel</button>
            <input type="text" name="yaccel" value="{{ request('yaccel') }}">
          </div>
          <div class="filter-group">
            <button type="button">Z Accel</button>
            <input type="text" name="zaccel" value="{{ request('zaccel') }}">
          </div>
        </div>
        <div class="filter-actions">
          <button class="apply-btn" type="submit">Terapkan</button>
          <button type="button" class="reset-btn"
            onclick="window.location.href='{{ route('pages.datahistory') }}'">Reset</button>
        </div>

      </form>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Waktu</th>
            <th>Roll</th>
            <th>Pitch</th>
            <th>Yaw</th>
            <th>X Magnet</th>
            <th>Y Magnet</th>
            <th>Z Magnet</th>
            <th>X Accel</th>
            <th>Y Accel</th>
            <th>Z Accel</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $row)
        <tr>
        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d H:i:s') }}</td>
        <td>{{ $row->roll }}</td>
        <td>{{ $row->pitch }}</td>
        <td>{{ $row->yaw }}</td>
        <td>{{ $row->xmagnet }}</td>
        <td>{{ $row->ymagnet }}</td>
        <td>{{ $row->zmagnet }}</td>
        <td>{{ $row->xaccel }}</td>
        <td>{{ $row->yaccel }}</td>
        <td>{{ $row->zaccel }}</td>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/datahistory.js') }}"></script>
</body>

</html>