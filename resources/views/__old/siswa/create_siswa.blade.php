@extends('luar.master')

@section('tambah','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Create Data Siswa</li>
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
				    <h3 class="card-title">Form Create Data Siswa</h3>
				  </div>
				  <form role="form" method="post" action="/tambah_siswa">
				  	{{csrf_field()}}
				    <div class="card-body">
						<div class="form-group">
							<label for="id">NISN</label>
							<input type="number" class="form-control @error('id') is-invalid @enderror" id="id" required name="id">
					    	@error('id')
					        <small class="text-danger"><i class="fas fa-times"></i>
					        	{{$message}}
					        </small>
					        @enderror
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" value="{{ old('nama') }}" class="form-control" id="nama" required name="nama">
						</div>
				  		<div class="form-group">
				          <label>Kelas</label>
				          <select class="form-control select2" style="width: 100%;" name="kelas" required>
				            <option value="{{ old('kelas') }}">{{ old('kelas') }}</option>
				            <option value="XI RPL A">XI RPL A</option>
				            <option value="XI RPL B">XI RPL B</option>
				            <option value="XI RPL C">XI RPL C</option>
				            <option value="XI TPM A">XI TPM A</option>
				            <option value="XI TPM B">XI TPM B</option>
				            <option value="XI TPM C">XI TPM C</option>
				            <option value="XI BKP A">XI BKP A</option>
				            <option value="XI BKP B">XI BKP B</option>
				            <option value="XI BKP C">XI BKP C</option>
				            <option value="XI DPIB A">XI DPIB A</option>
				            <option value="XI DPIB B">XI DPIB B</option>
				            <option value="XI DPIB C">XI DPIB C</option>
				          </select>
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