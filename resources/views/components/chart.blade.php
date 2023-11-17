<section class="flex w-full flex-col items-center justify-center">
    <div>
        <h1 class="mb-8 text-center text-3xl font-bold">Hasil Polling: {{ $voteCount }} Suara</span></h1>
    </div>
    <div class="flex w-full flex-col items-center justify-center gap-8 sm:w-1/2 md:flex-row xl:w-1/3">
        <canvas id="pie-chart" width="400" height="400"></canvas>
        <canvas id="line-chart" width="400" height="400"></canvas>
    </div>
</section>

@push('script')
    <script>
        const pieChart = document.getElementById('pie-chart');
        const lineChart = document.getElementById('line-chart');
        const candidates = {!! json_encode($candidates) !!};
        let totalVote;
        const namaPaslon = ['Anies Muhaimin', 'Prabowo Gibran', 'Ganjar Mahfud'];
        const suara = [];
        candidates.forEach((candidate) => {
            suara.push(candidate.total_vote);
        })
        const data = {
            labels: namaPaslon,
            datasets: [{
                label: 'Jumlah Suara',
                data: suara,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };
        const dataLine = {
            labels: namaPaslon,
            datasets: [{
                label: 'Polling Suara',
                data: suara,
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4,

            }]
        };
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart',
                },
            },
        };
        const configline = {
            type: 'bar',
            data: data,
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuart',
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y + ' (' + ((context.parsed.y / context.dataset.data.reduce((a, b) => a + b, 0)) * 100).toFixed(2) + '%)';
                                }
                                return label;
                            }
                        }
                    }
                }
            },
        };
        let line = new Chart(
            lineChart,
            configline,
        )

        let myChart = new Chart(
            pieChart,
            config
        );
    </script>
@endpush
