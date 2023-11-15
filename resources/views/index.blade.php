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

<section class="w-full flex flex-col justify-center items-center">
    <div>
        <h1 class="text-3xl font-bold text-center">Hasil Polling: <span id="total-vote"></span></h1>
    </div>
    <div class="w-1/2">
        <canvas class="flex justify-center " id="pie-chart"></canvas>
    </div>
    <div class="w-1/2">
        <canvas class="flex justify-center " id="line-chart"></canvas>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    <?php $candidates = json_encode($candidates); ?>
    const pieChart = document.getElementById('pie-chart');
    const lineChart = document.getElementById('line-chart');
    const totalVoteElement = document.getElementById('total-vote');
    const candidates = <?php echo $candidates; ?>;
    let totalVote;
    const namaPaslon = [];
    const suara = [];
    // fetch data using ajax
    candidates.forEach((candidate) => {
        $.ajax({
            url: `/candidate/${candidate.id}`,
            type: 'GET',
            success: function(response) {
                suara.push(response.data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    // when all data is fetched and pushed to paslon, console.log the paslon
    $(document).ajaxStop(function() {
        totalVote = suara.reduce((a, b) => a + b, 0);
        totalVoteElement.innerHTML = totalVote;
        candidates.forEach((candidate) => {
            namaPaslon.push(candidate.paslon);
        });
        console.log(suara);
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
        const config = {
            type: 'pie',
            data: data,
        };
        let myChart = new Chart(
            pieChart,
            config
        );
        // line chart
    });
</script>

@endsection