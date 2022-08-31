<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Top Navigation</title>

  <!-- icon -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

  <!-- basic style -->
  <link rel="stylesheet" href="{{ asset('adminlte/custom/default.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

  <!-- custom css -->
  <link rel="stylesheet" href="{{ asset('frontend/css/validasi.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/voting.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
</head>

<body class="hold-transition layout-top-nav sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
      <div class="container">
        <a href="#" class="navbar-brand">
          <img src="{{ asset('frontend/images/LOGOSTMJ.png') }}" alt="AdminLTE Logo" class="brand-image img-circle">
          <span class="brand-text font-weight-light">SMKN 1 JENANGAN</span>
        </a>
        @auth
        <div class="btn btn-sm btn-outline-danger px-3" style="border-radius: 99rem;" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-power-off"></i>
          <span>logout</span>
        </div>
        @endauth
      </div>
    </nav>

    <!-- content-wrapper -->
    <div class="d-flex justify-content-center align-items-center pt-4" style="min-height: calc(100vh - 150px)" id="kanan">
      @yield('content')
    </div>

    <footer id="footer">
      <div style="text-align: center;" class="mb-3 mt-5">
        &copy;<script>
          document.write(new Date().getFullYear());
        </script> by Wongedanyongkru
      </div>
    </footer>
  </div>

  @auth
  <div class="modal fade" id="logoutModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ Route('logout') }}" method="POST" class="text-center">
          @csrf
          <div class="modal-body">
            <div class="my-4">Anda Benar-benar ingin logout dari akun in?</div>
          </div>
          <div class="row m-0 border-top">
            <button type="submit" class="btn justify-content-center col-6 py-3 hover:bg-danger border-right" style="cursor: pointer; border-radius: 0; border-bottom-left-radius: 0.2rem;">Ya</button>
            <div type="button" data-dismiss="modal" aria-label="Close" class="col-6 py-3 hover:bg-secondary" style="cursor: pointer; border-bottom-right-radius: 0.2rem;">Tidak</div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endauth

  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>

  @if(Session::has('error') || Session::has('success'))
  <script>
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        icon: "{{ Session::get('error') ? 'error' : 'success'}}",
        title: "{{ Session::get('error') ?? Session::get('success') }}"
      })
    })
  </script>
  @endif
</body>

</html>