<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">HRM</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">HRM</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li>
        <a href="{{url('/dashboard')}}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
         
        </li>
        <li class="menu-header">Pengaturan</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Karyawan</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="/employee">Data Karyawan</a></li>
          <li class="">
            <a href="{{url('/carieerHistory')}}" class="nav-link "></i><span>Data Karir</span></a>
          </li>
          </ul>
          
        </li>
        <li class="">
          <a href="{{url('/positions')}}" class="nav-link "><i class="fas fa-user-alt"></i><span>Posisi</span></a>
        </li>
        <li class="">
          <a href="{{url('/departments')}}" class="nav-link "><i class="fas fa-building"></i><span>Departmen</span></a>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Absensi</span></a>
          <ul class="dropdown-menu">
          <li>
          <li class="">
            <a href="{{url('/attendance')}}" class="nav-link "></i><span>Data Kehadiran</span></a>
          </li>
          <li class="">
            <a href="{{url('/attendance')}}" class="nav-link "></i><span>Import/Export</span></a>
          </li>
          <li class="">
            <a href="{{url('/shifts')}}" class="nav-link "><span>Shift</span></a>
          </li>
          </ul>
          
        </li>
        <li class="">
        </li>
      </aside>
  </div>
