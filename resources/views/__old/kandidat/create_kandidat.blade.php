@extends('luar.master')

@section('dashboard','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
	              <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Create Data Kandidat</li>
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
	                <h3 class="card-title">Form Create</h3>
	              </div>
	              <form role="form" method="post" action="/kandidat" enctype="multipart/form-data">
	              	{{csrf_field()}}
	                <div class="card-body">
		               <div class="row">
	                      <div class="col-md-6">
								<div class="form-group">
					<label for="nisn">NISN Kandidat</label>
									<input type="number" class="form-control" id="nisn" value="{{old('nisn')}}" required name="nisn" autofocus>
								    <small class="form-text">
								    	<div id="notif"></div>
								    </small>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
					<label for="nisn">Nama Kandidat</label>
									<input id="nama" type="text" class="form-control" disabled="" name="nama">
								</div>
	                      </div>
	                  </div>

								<div class="form-group">
									<label for="visi">Visi</label>
									<textarea id="visi" class="form-control" required name="visi" rows="3">{{old('visi')}}</textarea>
								</div>
			                    <div class="form-group">
			                        <label for="misi">Misi</label>
			                        <textarea id="misi" required class="form-control" name="misi" rows="3">{{old('misi')}}</textarea>
			                    </div>
								<div class="form-group">
									<label for="foto">Foto</label>
									<div class="input-group">
									  <div class="custom-file">
									    <input type="file" value="{{old('foto')}}" required name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="foto">
									    <label class="custom-file-label" for="foto">Choose file</label>
									  </div>
									</div>
									@error('foto')
									<small class="form-text text-danger">{{$message}}</small>
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

  //live search
	$("#nisn").keyup(function(){
		var str=  $("#nisn").val();
		$.get( "{{ url('/live?id=') }}"+str, function( data ) {
			$( "#notif" ).removeAttr("class")
			$( "#notif" ).html( '<i class="fa fa-spinner fa-spin"></i> loading...' );
			switch (data) {
				case '1':
				$( "#notif" ).html( 'Tidak Di Temukan' ).addClass('text-danger');
				$( "#nama" ).val( '' );
					break;
				case '2':
				$( "#notif" ).html( 'Sudah menjadi kandidat' ).addClass('text-success');
				$( "#nama" ).val( '' );
					break;
				default:
					$( "#notif" ).html( '' );
					$( "#nama" ).val( data );
			}
		});
	});
}); 
</script>

@endsection