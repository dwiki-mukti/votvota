@extends('luar.master')

@section('history','active')

@section('content')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2 ">
			<div class="col-sm-12">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item active" style="font-size: 20px; font-weight: 500;">History Voting</li>
	            </ol>
          </div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
          <div class="card" style="min-height: 300px;">
            <div class="card-body">
              <table  class="table table-condensed">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Waktu Berakhir</th>
                  <th style="width: 200px;">More</th>
                </tr>
                </thead>
                <tbody>
                @foreach($voting as $s)
                <tr>
                  <td>{{$s->judul}}</td>

                  @if( $s->status ==='selesai')
                  	<td>{{$s->deleted_at}}</td>
                  <td >
                    <a href="/detail_history/{{$s->id}}" class="btn btn-info" style="width: 100px;">Detail</a>
                  </td>
                  @else
                  	<td><i class="text-danger">Di Batalkan</i></td>
                  	<td><i class="text-danger">Di Batalkan</i></td>
                  @endif

                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>


				</div>
			</div>
	</div>
</section>
@endsection


@section('js')
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection