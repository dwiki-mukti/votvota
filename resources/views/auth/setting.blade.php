@extends('luar.master')


@section('content')

<div class="content-header">
<!-- 	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item"><a href="/siswa">Data Siswa</a></li>
	              <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Edit Data Siswa</li>
	            </ol>
          </div>
		</div>
	</div>
 --></div>

<section class="content">
	<div class="container-fluid">
		<div class="row">

		<div class="col-md-6">
			<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Settings Username</h3>
              </div>
              <form role="form" method="post" action="/manage-account">
              	{{csrf_field()}}
                <div class="card-body">
					<div class="form-group">
						<label for="Email">Email</label>
						<input type="text" value="{{$user->email}}" class="form-control" id="Email" disabled>
						<input type="hidden" value="{{$user->id}}" name="id">
					</div>
					<div class="form-group">
						<label for="nama">Nama</label>
						<input type="text" class="form-control" id="nama" required value="{{$user->name}}" name="nama">
					</div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>

        <div class="col-md-6">
        	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="/manage-account">
              	{{csrf_field()}}
                <div class="card-body">
					<input type="hidden" value="{{$user->id}}" name="id">
					<div class="form-group">
						<label for="password">New Password</label>
						<input type="password" class="form-control" id="password" required name="password">
                                @error('password')
                                    <span class="text-danger" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                @enderror
					</div>
					<div class="form-group">
						<label for="password">Password Confirmation</label>
						<input type="password" class="form-control" id="password" required name="password_confirmation">
					</div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        </div>

		</div>
	</div>
</section>
@endsection


@section('js')
<script>
	  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
</script>
@endsection