<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AdminLTE 3 | Top Navigation</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/css/adminlte.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/validasi.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/voting.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="hold-transition layout-top-nav sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-dark">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="/frontend/images/LOGOSTMJ.png" alt="AdminLTE Logo" class="brand-image img-circle">
        <span class="brand-text font-weight-light">SMKN 1 JENANGAN</span>
      </a>      
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- @yield('content') -->
<div id="app">
    <router-view></router-view>
</div>


<footer id="footer">
  <center>
    <p style="position: absolute; bottom: 0; left: 0; right: 0; margin-bottom: 30px;">
    &copy;<script>document.write(new Date().getFullYear());</script> by Wongedanyongkru
    </p>
  </center>
</footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
	//sweet alert
    $(function() {
        const Toast = Swal.mixin({
          toast: false,
          position: '',
          showConfirmButton: false,
          timer: 1500
        });
        @if (Session::has('Sukses'))
          Toast.fire({
            type: 'success',
            title: 'Sukses',
            text: '{{Session::get("Sukses")}}'
          })
        @endif
    });
    //end sweet alert

    //validasi
	$(document).ready(function(){
		$("#nis").keyup(function(){
		var str=  $("#nis").val();
			if (str.length == 5) {
			    $.get( "{{ url('/live?id=') }}"+str, function( data ) {
				    if ( !data == '') {
				    	$( "#kanan" ).html( data );
              $( '#footer' ).hide();
				    }else{
				    	$( "#notif" ).html( '<center><span class="text-danger">Coba Lagi!</span></center>' );
				    }
			    });
			}
		});
	}); 
	//end validasi
</script>
</body>
</html>
