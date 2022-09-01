<style>
    .legend-bar-vote {
        width: 40px;
        overflow: hidden;
        color: #fff;
        height: 20px;
        /* padding: 0 .3rem; */
    }
</style>
<div class="row">
    <div class="col-12">
        <h3 class="mb-4 mx-auto text-center" style="font-weight: 600; max-width: 400px;">Voting {{ $currentVote->title }}</h3>
    </div>
    <div class="col-md-6">
        <canvas id="chart"></canvas>
    </div>
    <div class="col-md-6">
        <div class="mb-4">
            <h5 class="m-0">Berakhir pada:</h5>
            <div class="mb-1">{{ DateDetail($currentVote->end_at) }}</div>
            @if($currentVote->end_at > \Carbon\Carbon::now()->timestamp)
            <form action="{{ Route('voting.end', $currentVote->id) }}" method="POST" onsubmit="return confirm('Anda benar-benar ingin mengakhiri voting ini?')">
                @csrf
                @method('delete')
                <button class="btn btn-xs btn-danger">
                    <i class="fas fa-stop"></i>
                    <span>Akhiri Sekarang</span>
                </button>
            </form>
            @endif
        </div>
        <div class="mb-4">
            <h5 class="m-0">Legends</h5>
            <div>
                @foreach ($currentVote->Rcandidate as $key => $candidate)
                <div class="d-flex align-items-center mb-2" style="gap: .3rem">
                    <div class="legend-bar-vote" style="background-color: {{ colors()[$key] }}"></div>
                    <span>{{ $candidate->title }}</span>
                </div>
                @endforeach
                <div class="d-flex align-items-center mb-2" style="gap: .3rem">
                    <div class="legend-bar-vote" style="background-color: {{ colors()[$key+1] }}"></div>
                    <span>Undefined</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(
        document.getElementById('chart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_merge($currentVote->Rcandidate->pluck('title')->toArray(), ['Undefined'])) !!},
                datasets: [{
                    data: {!! json_encode(array_merge($currentVote->Rcandidate->pluck('total_votes')->toArray(), [$currentVote->golput])) !!},
                    backgroundColor: {!! json_encode(colors()) !!},
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        }
    );
</script>