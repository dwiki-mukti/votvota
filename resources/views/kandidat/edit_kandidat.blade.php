@extends('luar.master')

@section('dashboard','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
	              <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Edit Data Kandidat</li>
	            </ol>
          	</div>
		</div>
	</div>
</div>
 
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">{{ $kandidat->name }} | {{ $kandidat->kelas }}</h3>
					</div>
					<form role="form" method="post" action="/kandidat" enctype="multipart/form-data">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="id" value="{{$kandidat->id}}">
						<div class="card-body">
							<div class="form-group">
								<label for="visi">Visi</label>
								<textarea id="visi" class="form-control" required name="visi" rows="3">{{$kandidat->visi}}</textarea>
							</div>
							<div class="form-group">
								<label for="misi">Misi</label>
								<textarea id="misi" required class="form-control" name="misi" rows="3">{{$kandidat->misi}}</textarea>
							</div>
							<div class="form-group">
								<label for="foto">Foto</label>
								<div class="input-group">
								  <div class="custom-file">
								    <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
								    <label class="custom-file-label" for="foto">{{$kandidat->foto}}</label>
								  </div>
								</div>
								@error('foto')
									<small id="emailHelp" class="form-text text-danger"><i class="fas fa-times"></i>
										{{$message}}
									</small>
								@enderror
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

  $(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

@endsection