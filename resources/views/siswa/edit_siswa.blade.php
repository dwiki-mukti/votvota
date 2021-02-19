@extends('luar.master')

@section('siswa','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item"><a href="/siswa">Data Siswa</a></li>
	              <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">Edit Data Siswa</li>
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
				    <h3 class="card-title">Form Edit Data Siswa</h3>
				  </div>
				  <form role="form" method="post" action="/edit_siswa/{{$siswa->id}}">
				  	{{csrf_field()}}
				    <div class="card-body">
						<div class="form-group">
							<label for="NISN">NISN</label>
							<input type="number" value="{{$siswa->nisn}}" class="form-control" id="NISN">
						</div>
						<div class="form-group">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" required value="{{$siswa->nama}}" name="nama">
						</div>
				  		<div class="form-group">
				          <label>Kelas</label>
				          <select class="form-control select2" style="width: 100%;" name="kelas" required>
				            <option value="{{$siswa->kelas}}">{{$siswa->kelas}}</option>
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