@extends('layouts.panel')

@section('style')
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Voting Control</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="{{ Route('dashboard') }}">Dashboard</a></li> --}}
                    <li class="breadcrumb-item active">Voting</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Voting Saat Ini</h3>
                    </div>
                    <div class="card-body pb-5">
                        @if ($currentVote && is_null($currentVote->end_at))
                            @include('voting.components.prepare', compact('currentVote'))
                        @elseif($currentVote)
                            @include('voting.components.progress', compact('currentVote'))
                        @else
                            <div class="row justify-content-center">
                                <div class="col-md-6 my-4 text-center">
                                    <img src="" class="w-100 mb-1" style="height: 200px">
                                    <h5 class="mb-4">Tidak ada pemungutan suara yang berlangsung.</h5>
                                    <a href="{{ Route('voting.create') }}" class="btn btn-success">
                                        <i class="fas fa-user mr-1"></i>
                                        <span>Buat Pemungutan Suara</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Voting</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Berakhir</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($votes as $vote)
                                    <tr>
                                        <td>{{$vote->title}}</td>
                                        <td>{{$vote->end_at}}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                                <span>Detail</span>
                                            </a>
                                        </td>
                                    </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</section>
@endsection



@section('script')
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script type="text/javascript">
    $("#sidbarHome").addClass('active')
    // data tables
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
</script>
@endsection