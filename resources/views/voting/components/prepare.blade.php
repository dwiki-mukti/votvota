<div class="row">
    <div class="col-md-4">
        <img src="" class="w-100 mb-1" style="height: 200px">
        <div class="text-center">
            <div class="d-flex justify-content-center align-items-end" style="gap: .3rem">
                <h4 class="m-0">{{ $currentVote->title }}</h4>
                <a href="{{ Route('voting.edit', $currentVote->id) }}"><i class="fas fa-edit"></i></a>
            </div>
            <div class="mb-2">{{ $currentVote->description }}</div>
            <div>
                <div class="mb-1">
                    <a href="{{ Route('voting.show', 'download-token') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-file-download"></i>
                        <span>Unduh Token Pemilih</span>
                    </a>
                </div>
                <div class="d-flex justify-content-center" style="gap: .2rem">
                    <button {{ ($currentVote->Rcandidate->count() < 2) ? 'disabled' : '' }} class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#edit-voting">
                        <i class="fas fa-play"></i>
                        <span>Mulai</span>
                    </button>
                    <form action="{{ Route('voting.destroy', $currentVote->id) }}" method="POST" onsubmit="return confirm('Data setup voting yang dihapus tidak dapat dikembalikan. Tetap hapus?')">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash-alt"></i>
                            <span>Batalkan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <a href="{{ Route('candidate.create') }}" class="btn btn-sm btn-success mb-2">
            <i class="fas fa-plus"></i>
            <span>Tambah Kandidat</span>
        </a>
        <div class="table-responsive">
            <table class="table table-bordered text-nowrap">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Kandidat</th>
                    <th style="width: 100px;">Opsi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($currentVote->Rcandidate as $key => $candidate)
                    <tr>
                        <td>{{ $key+1 }}.</td>
                        <td>{{ $candidate->Rleader->name ?? null }} & {{ $candidate->RcoLeader->name ?? null }}</td>
                        <td>
                            @include('components.btnCrud', ['actions'=>['edit', 'delete'], 'id'=>$candidate->id, 'path'=> 'candidate'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- modal -->
@if (!($currentVote->Rcandidate->count() < 2))
<div class="modal fade" id="edit-voting">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mulai Voting</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ Route('voting.start', $currentVote->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="end_at">Batas Waktu Voting Berakhir</label>
                        <input type="datetime-local" value="{{ old('end_at', ($currentVote->end_at ?? '')) }}" class="form-control" id="end_at" name="end_at">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success">Mulai</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
<!-- end modal -->