@extends('layouts.panel')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Voting Control</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Voting</li>
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
        </div>
    </div>
</section>
@endsection



@section('script')
<script type="text/javascript">
    $("#sidebarVoting").addClass('active')
    @if (Session::has('isDownloadTokens'))
        location.href = '{{ Route('voting.show', Session::get('isDownloadTokens')) }}'
    @endif
</script>
@endsection