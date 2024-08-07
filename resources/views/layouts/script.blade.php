
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}

{{-- <script src="{{url('stila/assets/modules/jquery.min.js')}}"></script> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<script src="https://kit.fontawesome.com/4237c04efc.js" crossorigin="anonymous"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script src="{{url('stila/assets/modules/popper.js')}}"></script>
 <script src="{{url('stila/assets/modules/tooltip.js')}}"></script>
 <script src="{{url('stila/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
 <script src="{{url('stila/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
 <script src="{{url('stila/assets/modules/moment.min.js')}}"></script>
 <script src="{{url('stila/assets/js/stisla.js')}}"></script>
 
 <!-- JS Libraies -->
 <script src="{{url('stila/assets/modules/jquery.sparkline.min.js')}}"></script>
 <script src="{{url('stila/assets/modules/chart.min.js')}}"></script>
 <script src="{{url('stila/assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
 <script src="{{url('stila/assets/modules/summernote/summernote-bs4.js')}}"></script>
 <script src="{{url('stila/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
 <script src="{{url('stila/assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
 <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <script src="{{url('stila/lightbox2/js/lightbox.min.js')}}"></script>

 <!-- Page Specific JS File -->
 <script src="{{url('stila/assets/js/page/index.js')}}"></script>
 
 <!-- Template JS File -->
 <script src="{{url('stila/assets/js/scripts.js')}}"></script>
 <script src="{{url('stila/assets/js/custom.js')}}"></script>

 <script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}'
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            });
        @endif
    });
</script>
 @yield('addon')
