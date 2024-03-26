<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>@yield('title')</title>

  <!-- General CSS Files -->
  @include('layouts.style')
<!-- /END GA --></head>

<body>
@include('sweetalert::alert')
@include('layouts.navbar')
    

@include('layouts.sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
          <h1>@yield('sub-judul')</h1>
             
            
          </div>
          <div class="section-body">
   @yield('content')
  </div>
</section>
</div>
 @include('layouts.footer')
    </div>
  </div>

 @include('layouts.script')
 <script>
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
 </script>

<script>
  // Mendapatkan URL saat ini
  var currentUrl = window.location.href;

  // Mendapatkan semua elemen <a> di dalam sidebar-menu
  var sidebarLinks = document.querySelectorAll('.sidebar-menu a');

  // Loop melalui setiap link dan tambahkan kelas 'active' jika href-nya cocok dengan URL saat ini
  sidebarLinks.forEach(function(link) {
      if (link.href === currentUrl) {
          link.classList.add('active');
          
          // Jika ada dropdown menu, tambahkan kelas 'active' juga pada parentnya
          var dropdownParent = link.closest('.dropdown');
          if (dropdownParent) {
              dropdownParent.classList.add('active');
          }
      }
  });
</script>
</body>
</html>