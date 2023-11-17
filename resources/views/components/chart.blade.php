<section class="flex w-full flex-col items-center justify-center">
    <div>
        <h1 class="mb-8 text-center text-3xl font-bold">Hasil Polling: {{ $voteCount }} Suara</span></h1>
    </div>
    <div class="relative flex w-full flex-col items-center justify-center gap-x-20 gap-y-20 px-8 lg:flex-row">
        <canvas id="pie-chart"></canvas>
        <canvas id="line-chart"></canvas>
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
                    duration: 1000,
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
                    duration: 1000,
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

        const smallScreen = window.matchMedia('(max-width: 425px)');
        const largeScreen = window.matchMedia('(min-width: 425px)');

        function handleResize() {
            if (smallScreen.matches) {
                line.resize(300, 300);
                myChart.resize(300, 300);
            }

            if (largeScreen.matches) {
                line.resize(400, 400);
                myChart.resize(400, 400);
            }
        }

        // Panggil handleResize saat halaman dimuat
        handleResize();

        // Tambahkan event listener untuk mendeteksi perubahan ukuran layar
        window.addEventListener('resize', handleResize);
    </script>
@endpush
