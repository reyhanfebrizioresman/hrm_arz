<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">HRM</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="active">
        <a href="{{url('/')}}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
         
        </li>
        <li class="menu-header">setting</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Karyawan</span></a>
          <ul class="dropdown-menu">
          <li><a class="nav-link" href="/employee">Data Karyawan</a></li>
          <li><a class="nav-link" href="/employee/create">Buat Karyawan</a></li>
          <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-history"></i><span>Karir Histori</span></a>
            <ul class="dropdown-menu">
            <li class="">
              <a href="{{url('/carieerHistory')}}" class="nav-link "></i><span>Data Karir</span></a>
              <a href="{{url('/carieerHistory/create')}}" class="nav-link "></i><span>Tambah Karir</span></a>
            </li>
            </ul>
          </li>
          </ul>
          
        </li>
        <li class="">
          <a href="{{url('/positions')}}" class="nav-link "><i class="fas fa-user-alt"></i><span>Posisi</span></a>
        </li>
        <li class="">
          <a href="{{url('/departments')}}" class="nav-link "><i class="fas fa-building"></i><span>Departmen</span></a>
        </li>
        

     
       
       
      </aside>
  </div>
