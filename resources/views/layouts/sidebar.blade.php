            @if (auth()->user()->role->role === 'kepala gudang')
              <li class="sidebar-item">
                <a class="nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="/">
                  <i class="fas fa-fire"></i> <span class="align-middle">Dashboard</span>
                </a>
              </li>
  
              <li class="menu-header">LAPORAN</li>
              <li><a class="nav-link {{ Request::is('laporan-stok') ? 'active' : '' }}" href="laporan-stok"><i class="fa fa-sharp fa-regular fa-file"></i><span>Stok</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-masuk') ? 'active' : '' }}" href="laporan-barang-masuk"><i class="fa fa-regular fa-file-import"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-keluar') ? 'active' : '' }}" href="laporan-barang-keluar"><i class="fa fa-sharp fa-regular fa-file-export"></i><span>Barang Keluar</span></a></li>
            
              <li class="menu-header">MANAJEMEN USER</li>
              <li><a class="nav-link {{ Request::is('aktivitas-user') ? 'active' : '' }}" href="aktivitas-user"><i class="fa fa-solid fa-list"></i><span>Aktivitas User</span></a></li>
            @endif

            @if (auth()->user()->role->role === 'superadmin')
              <li class="sidebar-item">
                <a class="nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="/">
                  <i class="fas fa-fire"></i> <span class="align-middle">Dashboard</span>
                </a>
              </li>

              <li class="menu-header">DATA MASTER</li>
                <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown {{ Request::is('barang') || Request::is('jenis-barang') || Request::is('satuan-barang') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-thin fa-cubes"></i><span>Data Barang</span></a>
                  <ul class="dropdown-menu">
                    <li><a class="nav-link {{ Request::is('barang') ? 'active' : '' }}" href="/barang"><i class="fa fa-solid fa-circle fa-xs"></i> Nama Barang</a></li>
                    <li><a class="nav-link {{ Request::is('jenis-barang') ? 'active' : '' }}" href="/jenis-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Jenis</a></li>
                    <li><a class="nav-link {{ Request::is('satuan-barang') ? 'active' : '' }}" href="/satuan-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Satuan</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="nav-link has-dropdown {{ Request::is('supplier')  || Request::is('customer') ? 'active' : '' }}" data-toggle="dropdown"><i class="fa fa-sharp fa-solid fa-building"></i><span>Perusahaan</span></a>
                  <ul class="dropdown-menu">
                    <li><a class="nav-link {{ Request::is('supplier') ? 'active' : '' }}" href="/supplier"><i class="fa fa-solid fa-circle fa-xs"></i> Supplier</a></li>
                    <li><a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" href="/customer"><i class="fa fa-solid fa-circle fa-xs"></i> Customer</a></li>
                  </ul>
                </li>

              <li class="menu-header">TRANSAKSI</li>
              <li><a class="nav-link {{ Request::is('barang-masuk') ? 'active' : '' }}" href="barang-masuk"><i class="fa fa-solid fa-arrow-right"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('barang-keluar') ? 'active' : '' }}" href="barang-keluar"><i class="fa fa-sharp fa-solid fa-arrow-left"></i> <span>Barang Keluar</span></a></li>
            
              <li class="menu-header">LAPORAN</li>
              <li><a class="nav-link {{ Request::is('laporan-stok') ? 'active' : '' }}" href="laporan-stok"><i class="fa fa-sharp fa-regular fa-file"></i><span>Stok</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-masuk') ? 'active' : '' }}" href="laporan-barang-masuk"><i class="fa fa-regular fa-file-import"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-keluar') ? 'active' : '' }}" href="laporan-barang-keluar"><i class="fa fa-sharp fa-regular fa-file-export"></i><span>Barang Keluar</span></a></li>
              
              <li class="menu-header">MANAJEMEN USER</li>
              <li><a class="nav-link {{ Request::is('data-pengguna') ? 'active' : '' }}" href="data-pengguna"><i class="fa fa-solid fa-users"></i><span>Data Pengguna</span></a></li>
              <li><a class="nav-link {{ Request::is('hak-akses') ? 'active' : '' }}" href="hak-akses"><i class="fa fa-solid fa-user-lock"></i><span>Hak Akses/Role</span></a></li>
              <li><a class="nav-link {{ Request::is('aktivitas-user') ? 'active' : '' }}" href="aktivitas-user"><i class="fa fa-solid fa-list"></i><span>Aktivitas User</span></a></li>
        
            @endif
            
            @if (auth()->user()->role->role === 'admin gudang')
            <li class="sidebar-item">
              <a class="sidebar-link nav-link {{ Request::is('/') || Request::is('dashboard') ? 'active' : '' }}" href="/">
                <i class="fas fa-fire"></i> <span class="align-middle">Dashboard</span>
              </a>
            </li>

              <li class="menu-header">DATA MASTER</li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown {{ Request::is('barang') || Request::is('jenis-barang') || Request::is('satuan-barang') ? 'active' : '' }}" data-toggle="dropdown"><i class="fas fa-thin fa-cubes"></i><span>Data Barang</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link {{ Request::is('barang') ? 'active' : '' }}" href="/barang"><i class="fa fa-solid fa-circle fa-xs"></i> Nama Barang</a></li>
                  <li><a class="nav-link {{ Request::is('jenis-barang') ? 'active' : '' }}" href="/jenis-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Jenis</a></li>
                  <li><a class="nav-link {{ Request::is('satuan-barang') ? 'active' : '' }}" href="/satuan-barang"><i class="fa fa-solid fa-circle fa-xs"></i> Satuan</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="nav-link has-dropdown {{ Request::is('supplier')  || Request::is('customer') ? 'active' : '' }}" data-toggle="dropdown"><i class="fa fa-sharp fa-solid fa-building"></i><span>Perusahaan</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link {{ Request::is('supplier') ? 'active' : '' }}" href="/supplier"><i class="fa fa-solid fa-circle fa-xs"></i> Supplier</a></li>
                  <li><a class="nav-link {{ Request::is('customer') ? 'active' : '' }}" href="/customer"><i class="fa fa-solid fa-circle fa-xs"></i> Customer</a></li>
                </ul>
              </li>

              <li class="menu-header">TRANSAKSI</li>
              <li><a class="nav-link {{ Request::is('barang-masuk') ? 'active' : '' }}" href="barang-masuk"><i class="fa fa-solid fa-arrow-right"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('barang-keluar') ? 'active' : '' }}" href="barang-keluar"><i class="fa fa-sharp fa-solid fa-arrow-left"></i> <span>Barang Keluar</span></a></li>
            
              <li class="menu-header">LAPORAN</li>
              <li><a class="nav-link {{ Request::is('laporan-stok') ? 'active' : '' }}" href="laporan-stok"><i class="fa fa-sharp fa-regular fa-file"></i><span>Stok</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-masuk') ? 'active' : '' }}" href="laporan-barang-masuk"><i class="fa fa-regular fa-file-import"></i><span>Barang Masuk</span></a></li>
              <li><a class="nav-link {{ Request::is('laporan-barang-keluar') ? 'active' : '' }}" href="laporan-barang-keluar"><i class="fa fa-sharp fa-regular fa-file-export"></i><span>Barang Keluar</span></a></li>
              
            @endif
          