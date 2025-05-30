<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="/admin/dashboard" class="brand-link">
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
            <a href="/admin/dashboard" class="nav-link">
              <i class="nav-icon bi bi-speedometer"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
        
        @role('admin')
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
                <a href="{{ route('santri.index') }}" class="nav-link">
                  <i class="bi bi-people-fill"></i>
                  <p>Santri</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('kepengurusan.index') }}" class="nav-link">
                  <i class="bi bi-people-fill"></i>
                  <p>
                    Kepengurusan
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('guru.index') }}" class="nav-link">
                <i class="bi bi-people-fill"></i>
                  <p>Guru</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('donatur.index') }}" class="nav-link">
                  <i class="bi bi-people-fill"></i>
                  <p>Donatur</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">Akademik</li>
          <li class="nav-item">
            <li class="nav-item">
            <a href="{{ route('kelas.index') }}" class="nav-link">
              <i class="bi bi-door-closed-fill"></i>
              <p>
                Kelas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('mapel.index') }}" class="nav-link">
            <i class="bi bi-book"></i>
              <p>
                Mapel
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('nilai.index') }}" class="nav-link">
              <i class="bi bi-journal-text"></i>
              <p>
                Nilai
              </p>
            </a>
          </li>

          <li class="nav-item">
             <a href="{{ route('hapalan.index') }}" class="nav-link">
              <i class="bi bi-journal-text"></i>
              <p>
                Hapalan
              </p>
            </a>
          </li>

          <li class="nav-header">Agenda Ponpes</li>
          <li class="nav-item">
            <a href="{{ route('agenda.index') }}" class="nav-link">
              <i class="bi bi-calendar-event-fill"></i>
              <p>Agenda</p>
            </a>
          </li>

          <li class="nav-header">Keuangan</li>
          <li class="nav-item">
            <a href="{{ route('infaq.index') }}" class="nav-link">
              <i class="bi bi-cash-stack"></i>
              <p>
                Infaq
              </p>
            </a>
          </li>

          <li class="nav-header">Sistem</li>
          <li class="nav-item">
            <a href="{{ route('berita.index') }}" class="nav-link">
              <i class="bi bi-newspaper"></i>
              <p>
                Berita
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('galeri.index') }}" class="nav-link">
              <i class="bi bi-image-fill"></i>
              <p>
                Galeri
              </p>
            </a>
          </li>
        @endrole

        @role('guru')
          <li class="nav-header">Guru</li>
          <li class="nav-item">
            <a href="{{ route('kelas.index') }}" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Kelas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('mapel.index') }}" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Mapel
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('santri.index') }}" class="nav-link">
              <i class="nav-icon bi bi-box-seam-fill"></i>
              <p>
                Santri
              </p>
            </a>
          </li>
        @endrole


        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>