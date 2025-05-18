<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="./index.html" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="{{asset('/')}}AdminLTE/dist/assets/img/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">Ponpes Al-Ihsan</span>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu flex-column"
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false">

          <li class="nav-item menu-open">
            <a href="/" class="nav-link">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">Administrasi</li>
          <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Pengelolaan Data 
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('santri') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Santri</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('kepengurusan') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>
                    Kepengurusan
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('guru') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Guru</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('donatur') }}" class="nav-link">
                  <i class="nav-icon bi bi-circle"></i>
                  <p>Donatur</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Akademik</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Mapel
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Hapalan
              </p>
            </a>
          </li>

          <li class="nav-header">Agenda Ponpes</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-palette"></i>
              <p>Agenda</p>
            </a>
          </li>

          <li class="nav-header">Keuangan</li>
          <li class="nav-item">
            <a href="{{ route('infaq') }}" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Infaq
              </p>
            </a>
          </li>

          <li class="nav-header">Sistem</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Berita
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Galeri
              </p>
            </a>
          </li>


        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>