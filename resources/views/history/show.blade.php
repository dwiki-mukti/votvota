@extends('layouts.panel')


@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Detail Voting</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ Route('riwayat.index') }}">Riwayat Voting</a></li>
                    <li class="breadcrumb-item active">Detail Voting</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Hasil Voting</div>
                    </div>
                    <div class="card-body">
                        @include('voting.components.progress', compact('currentVote'))
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
    $("#sidebarRiwayat").addClass('active')
</script>
@endsection