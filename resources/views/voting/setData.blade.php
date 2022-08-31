@extends('layouts.panel')

@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>{{ isset($currentVote) ? 'Edit Voting' : 'Buat Voting Baru'}}</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ Route('voting.index') }}">Voting</a></li>
                    <li class="breadcrumb-item active">Voting {{ isset($currentVote) ? 'Edit' : 'Baru'}}</li>
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
                        <div class="card-title">Form Data Voting</div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <img src="" class="w-100 mb-1" style="height: 200px">
                            </div>
                            <div class="col-md-6">
                                <form action="{{ isset($currentVote) ? Route('voting.update', $currentVote->id) : Route('voting.store') }}" method="POST" onsubmit="return confirm('Buat pemungutan suara ini?')">
                                    @csrf
                                    @isset($currentVote)
                                        @method('PUT')
                                    @endisset
                                    <div class="form-group">
                                        <label for="title">Nama Voting</label>
                                        <input value="{{ old('title', ($currentVote->title ?? '')) }}" class="form-control" id="title" name="title" placeholder="Ex: Pemilihan Ketua Osis">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Keterangan <small>(Opsional)</small></label>
                                        <textarea class="form-control" id="description" name="description">{{ old('description', ($currentVote->description ?? '')) }}</textarea>
                                    </div>
                                    <button class="btn btn-primary float-right">Submit</button>
                                </form>
                            </div>
                        </div>
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
</script>
@endsection