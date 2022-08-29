<div class="row">
    <div class="col-md-6">
        <canvas id="chart"></canvas>
    </div>
    <div class="col-md-6">
        <div>
            <h4>Legends</h4>
            <div>
                @foreach ($currentVote->Rcandidate as $key => $candidate)
                    <div class="d-flex align-items-center mb-2" style="gap: .3rem">
                        <div style="height: 20px; width: 40px; background-color: {{ colors()[$key] }}"></div>
                        <span>{{ $candidate->Rleader->name ?? null }} & {{ $candidate->RcoLeader->name ?? null }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(
        document.getElementById('chart'),
        {
            type: 'pie',
            data: {
                labels: ['Red', 'Blue'],
                datasets: [{
                    data: [300, 50],
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