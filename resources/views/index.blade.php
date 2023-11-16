@extends('layouts.main')

@section('content')
    <section class="bg-white bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')]">
        <div class="relative z-10 mx-auto max-w-screen-xl px-4 pb-16 pt-8 text-center lg:pb-28 lg:pt-20">
            <h1 class="mb-5 text-4xl font-extrabold leading-none text-gray-900 md:text-5xl">Ayo Memilih!</h1>
            <p class="text-lg font-normal text-gray-600 sm:px-16 lg:px-48 lg:text-xl">Siapakah pasangan calon presiden dan wakil presiden Republik Indonesia periode 2024-2029 yang akan menjadi pilihan Anda?</p>
        </div>
        <div class="absolute left-0 top-0 z-0 h-full w-full bg-gradient-to-b from-blue-50 to-transparent"></div>
    </section>

    <div class="w-100 relative z-50 grid flex-grow grid-cols-1 gap-x-8 gap-y-8 pb-24 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($candidates as $candidate)
            <x-card id="{{ $candidate->id }}" paslonName="{{ $candidate->paslon }}" image="{{ $candidate->image }}" />
        @endforeach
    </div>

    <section class="flex w-full flex-col items-center justify-center">
        <div>
            <h1 class="mb-8 text-center text-3xl font-bold">Hasil Polling: {{ $votes->count() }} Suara</span></h1>
        </div>
        <div class="flex justify-center w-full sm:w-1/2 xl:w-1/3">
            <canvas id="pie-chart"></canvas>
        </div>
    </section>
@endsection

@push('script')
    <script>
        const pieChart = document.getElementById('pie-chart');
        const lineChart = document.getElementById('line-chart');
        const candidates = {!! json_encode($candidates) !!};
        let totalVote;
        const namaPaslon = [];
        const suara = [];
        candidates.forEach((candidate) => {
            namaPaslon.push(candidate.paslon);
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
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                    }
                }
            },
        };
        let myChart = new Chart(
            pieChart,
            config
        );
    </script>

    <script>
        function handleVote(id) {
            $.ajax({
                url: '{{ route('vote.store') }}',
                type: 'POST',
                data: {
                    candidate_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses Memilih',
                            text: response.message,
                            showConfirmButton: true,
                            timer: 3000,
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Memilih',
                            text: response.message,
                            showConfirmButton: true,
                        })
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memilih',
                        text: error.message,
                        showConfirmButton: false,
                    })
                },
            });
        }
    </script>
@endpush