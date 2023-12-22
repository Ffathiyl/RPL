<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard Nav -->
        <li class="nav-heading">Dashboard</li>

        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'dashboard') ? '' : 'collapsed' }}"
                href="{{ route('Dashboard.dashboard') }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!-- Master Nav -->
        <li class="nav-heading">Laporan</li>

        <li class="nav-item">
        <a class="nav-link {{ str_contains(strtolower($title), 'laporan') ? '' : 'collapsed' }}" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-pdf-fill"></i><span>Hasil Penilaian</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse {{ str_contains(strtolower($title), 'laporan') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('laporans.indexOrg') }}" class="{{ str_contains(strtolower($title), 'organisasi') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Organisasi</span>
            </a>
          </li>
          <li>
            <a href="{{ route('laporans.indexDiv') }}" class="{{ str_contains(strtolower($title), 'divisi') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Divisi</span>
            </a>
          </li>
          <li>
            <a href="{{ route('laporans.index') }}" class="{{ str_contains(strtolower($title), 'pengurus') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Pengurus Organisasi</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

        <!-- Master Nav -->
        <li class="nav-heading">Master</li>

        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'admin') ? '' : 'collapsed' }}"
                href="{{ route('admins.index') }}">
                <i class="bi bi-person-plus-fill"></i><span style="color :#000000">Admin</span><i></i>
            </a>
        </li><!-- End Admin Nav -->

        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'pengajuan') ? '' : 'collapsed' }}"
                href="{{ route('pengurus.indexAcc') }}">
                <i class="bi bi-people-fill"></i><span style="color :#000000">Pengajuan Akun</span><i></i>
            </a>
        </li><!-- End Pengurus Nav -->
        
        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'pengurus') ? '' : 'collapsed' }}"
                href="{{ route('pengurus.index') }}">
                <i class="bi bi-people-fill"></i><span style="color :#000000">Pengurus Organisasi</span><i></i>
            </a>
        </li><!-- End Pengurus Nav -->

        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'organisasi') ? '' : 'collapsed' }}"
                href="{{ route('organisasis.index') }}">
                <i class="bi bi-wallet-fill"></i><span style="color :#000000">Organisasi</span><i></i>
            </a>
        </li><!-- End Organisasi Nav -->

        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'divisi') ? '' : 'collapsed' }}"
                href="{{ route('divisis.index') }}">
                <i class="bi bi-map-fill"></i><span style="color :#000000">Divisi</span><i></i>
            </a>
        </li><!-- End Divisi Nav -->

        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'jabatan') ? '' : 'collapsed' }}"
                href="{{ route('jabatans.index') }}">
                <i class="bi bi-list"></i><span style="color :#000000">Jabatan</span><i></i>
            </a>
        </li><!-- End Jabatan Nav -->

        <li class="nav-item">
            <a class="nav-link {{ str_contains(strtolower($title), 'program Studi') ? '' : 'collapsed' }}"
                href="{{ route('programStudis.index') }}">
                <i class="bi bi-people-fill"></i><span style="color :#000000">Program Studi</span><i></i>
            </a>
        </li><!-- End Program Studi Nav -->

        

        <li class="nav-heading">Settings</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span style="color :#000000">Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('logins.logout') }}">
                <i class="bi bi-box-arrow-in-left"></i>
                <span style="color :#000000">Logout</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script>
    var title = document.title;
    console.log(title);
</script>