<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="http://127.0.0.1:8000/">HRM</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="http://127.0.0.1:8000/">HRM</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
        <a href="{{url('/dashboard')}}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
         
        </li>
        <li class="menu-header">Pengaturan</li>
        <li class="dropdown">
          <a href="{{url('/departments')}}" class="nav-link "><i class="fas fa-building"></i><span>Departemen</span></a>
        </li>
        <li class="dropdown">
          <a href="{{url('/positions')}}" class="nav-link "><i class="fas fa-user-alt"></i><span>Posisi</span></a>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Karyawan</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="/employee">Data Karyawan</a></li>
          <li class="">
            <a href="{{url('/carieerHistory')}}" class="nav-link "></i><span>Data Karir</span></a>
          </li>
          </ul>
          
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-address-card"></i> <span>Absensi</span></a>
          <ul class="dropdown-menu">
          <li>
          <li class="">
            <a href="{{url('/attendance')}}" class="nav-link "></i><span>Data Kehadiran</span></a>
          </li>
          <li class="">
            <a href="{{url('/attendance/create')}}" class="nav-link "></i><span>Impor / Ekspor</span></a>
          </li>
          <li class="">
          <a href="{{url('/shifts')}}" class="nav-link "><span>Shift</span></a>
          </li>
          {{-- <li class="">
            <a href="{{url('/submissions')}}" class="nav-link "><span>Pengajuan</span></a>
            </li> --}}
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Pengajuan</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{url('/sick_leaves')}}">Pengajuan Sakit</a></li> 
          <li><a class="nav-link" href="{{url('/paid_leaves')}}">Pengajuan Cuti</a></li> 
          <li><a class="nav-link" href="{{url('/permission_leaves')}}">Pengajuan Izin</a></li> 
          </ul>
        </li>
        {{-- <li class="dropdown">
          <a href="{{url('/salaries')}}" class="nav-link"><i class="fas fa-money-bill-alt"></i> <span>Komponen Gaji</span></a>     
        </li> --}}
        {{-- <li class="dropdown">
          <a href="{{url('/reports/salaries_report')}}" class="nav-link"><i class="fas fa-print"></i> <span>Laporan</span></a>     
        </li> --}}
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-money-bill-alt"></i> <span>Penggajian</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{url('/payrolls')}}">Gaji Bulanan</a></li> 
          <li><a class="nav-link" href="{{url('/salaries')}}">Komponen Gaji</a></li> 
          {{-- <li><a class="nav-link" href="{{url('/permission_leaves')}}">Pengajuan Izin</a></li>  --}}
          </ul>
        </li>
      </aside>
  </div>
