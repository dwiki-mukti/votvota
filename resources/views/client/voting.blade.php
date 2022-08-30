@extends('layouts.client')

@section('content')
<div class="content">
    <div class="container" style="width: 100vw;">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 style="font-weight: 600; text-align: center; padding-bottom: 2rem;">Kandidat {{ $currentVote->title }}</h3>
            </div>
            @foreach($currentVote->Rcandidate as $candidate)
            <div class="col-lg-4">
                <div class="cardis">
                    <div class="bg-image bg-profile mx-auto mt-4" style="width: 130px; box-shadow: 0px 0px 15px rgba(0,0,0,0.2); border: 7px solid #efb10a;"></div>
                    <h5 style="margin: 40px 20px 20px 20px; text-align: center;">{{$candidate->Rleader->name}} & <br> {{$candidate->RcoLeader->name}}</h5>
                    <div class="desc">
                        <p style="margin-bottom: .4rem;"><strong>VISI.</strong> {{$candidate->visi}}</p>
                        <p class="mb-0"><strong>MISI.</strong> {{$candidate->misi}}</p>
                    </div>
                    <div class="actions">
                        <div class="follow-btn">
                            <form method="post" action="{{ Route('main.update', 'voting') }}" onsubmit="return confirm('Konfirmasi pilihan anda?')">
                                @csrf
                                @method('put')
                                <input type="hidden" name="candidate_id" value="{{$candidate->id}}">
                                <button type="submit">Pilih</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection