@extends('layouts.main')

@section('title', 'Polling Surabaya')

@section('content')
<section class="bg-white bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')]">
    <div class="relative z-10 mx-auto max-w-screen-xl px-4 pb-16 pt-8 text-center lg:pb-28 lg:pt-20">
        <h1 class="mb-5 text-4xl font-extrabold leading-none text-gray-900 md:text-5xl">Ayo Memilih!</h1>
        <p class="text-lg font-normal text-gray-600 sm:px-16 lg:px-48 lg:text-xl">Siapakah pasangan calon presiden dan wakil presiden Republik Indonesia periode 2024-2029 yang akan menjadi pilihan Anda?</p>
    </div>
    <div class="absolute left-0 top-0 z-0 h-full w-full bg-gradient-to-b from-blue-50 to-transparent"></div>
</section>

<div class="w-100 relative z-50 grid flex-grow grid-cols-1 gap-x-8 gap-y-8 pb-16 sm:grid-cols-2 lg:grid-cols-3">
    <x-card />
    <x-card />
    <x-card />
</div>

<section>
    <div>
        <canvas id="pie-chart"></canvas>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // get candidate data from controller
    <?php $candidates = json_encode($candidates); ?>
    const candidates = <?php echo $candidates; ?>;
    console.log(candidates[0].total_vote);
    // select pie-chart element
    const pieChart = document.getElementById('pie-chart');
    const pieChartData = {
        labels: ['iza - nandha', ],
        datasets: [{
            label: 'Jumlah Suara',
            data: [candidates[0].total_vote],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    };
    // create pie chart
    new Chart(pieChart, {
        type: 'pie',
        data: pieChartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Pie Chart'
                }
            }
        },
    });
</script>

@endsection