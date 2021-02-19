@extends('luar.master')

@section('dashboard','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
	</div>
</div>
<section class="content">
	<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 text-center">
            <div style="margin-top: 200px;">
  						<button class="btn btn-success" data-toggle="modal" data-target="#create-voting" style="margin-bottom: 20px;"><i class="fas fa-plus"></i> Create New Voting</button>
  						<p>Tidak ada Pemilihan yang di selenggarakan</p>
            </div>
				</div>
			</div>
	</div>
</section>
<div class="modal fade" id="create-voting">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Nama Pemilihan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="/admin">
        <div class="modal-body">
        	<div class="input-group mb-3">
            <input type="text" class="form-control" name="judul" required>
            <div class="input-group-append">
              <button class="input-group-text btn btn-primary" type="submit" name="submit">Create</button>
            </div>
            {{csrf_field()}}
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection