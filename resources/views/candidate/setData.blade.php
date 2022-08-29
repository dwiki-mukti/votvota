@extends('layouts.panel')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pilih Kandidat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ Route('voting.index') }}">Voting</a></li>
                        <li class="breadcrumb-item active">Pilih Kandidat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Kandidat</div>
                        </div>
                        <form action="{{ isset($candidate) ? Route('candidate.update', $candidate->id) : Route('candidate.store') }}" method="POST" onsubmit="return confirm('Submit data ini?')" enctype="multipart/form-data">
                            @csrf
                            @isset($candidate)
                                @method('put')
                            @endisset
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Calon Ketua</label>
                                            <select class="form-control" name="leader_id">
                                                <option value=""></option>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->id }}" {{ old('leader_id', ($candidate->leader_id ?? null)) == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('leader_id')
                                                <small class="mt-2 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="leader_image">Foto Calon Ketua</label>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" class="custom-file-input" id="leader_image" name="leader_image">
                                                <label class="custom-file-label" for="leader_image">Pilih gambar</label>
                                            </div>
                                            @error('leader_image')
                                                <small class="mt-2 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Calon Wakil Ketua</label>
                                            <select class="form-control" name="co_leader_id">
                                                <option value=""></option>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->id }}" {{ old('co_leader_id', ($candidate->co_leader_id ?? null)) == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('co_leader_id')
                                                <small class="mt-2 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="co_leader_image">Foto Calon Wakil Ketua</label>
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" class="custom-file-input" id="co_leader_image" name="co_leader_image">
                                                <label class="custom-file-label" for="co_leader_image">Pilih gambar</label>
                                            </div>
                                            @error('co_leader_image')
                                                <small class="mt-2 text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="visi">Visi</label>
                                    <textarea class="form-control" id="visi" name="visi" rows="3" placeholder="Masukkan Visi Kandidat">{{ old('visi', ($candidate->visi ?? null)) }}</textarea>
                                    @error('visi')
                                        <small class="mt-2 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="misi">Misi</label>
                                    <textarea class="form-control" id="misi" name="misi" rows="3" placeholder="Masukkan Misi Kandidat">{{ old('misi', ($candidate->misi ?? null)) }}</textarea>
                                    @error('misi')
                                        <small class="mt-2 text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer d-flex">
                                <button class="btn btn-primary ml-auto">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script type="text/javascript">
        $('#sidbarHome').addClass('active')
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@endsection
