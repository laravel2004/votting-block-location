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
            <x-card id="{{ $candidate->id }}" voteDisabled="1" paslonName="{{ $candidate->paslon }}" image="{{ $candidate->image }}" />
        @endforeach
    </div>

    <section class="flex w-full flex-col items-center justify-center">
        <div>
            <h1 class="mb-8 text-center text-3xl font-bold">Hasil Polling: {{ $votes->count() }} Suara</span></h1>
        </div>
        <div class="flex w-full flex-col items-center justify-center gap-8 sm:w-1/2 md:flex-row xl:w-1/3">
            <canvas id="pie-chart" width="400" height="400"></canvas>
            <canvas id="line-chart" width="400" height="400"></canvas>
        </div>
    </section>

    <section>
        <!-- component -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

        <div class="mt-24 flex items-center justify-center bg-white px-5 pb-14 pt-5" x-data="beer()" x-init="start()">
            <div class="text-black">
                <h1 class="mb-4 text-center text-3xl font-medium">Waktu hitung mundur hingga pemilu 2024</h1>
                <div class="flex w-full items-center justify-center text-center text-6xl">
                    <div class="mx-1 w-24 rounded-lg bg-white p-2 text-black">
                        <div class="leading-none" x-text="days">00</div>
                        <div class="text-sm uppercase leading-none">Days</div>
                    </div>
                    <div class="mx-1 w-24 rounded-lg bg-white p-2 text-black">
                        <div class="leading-none" x-text="hours">00</div>
                        <div class="text-sm uppercase leading-none">Hours</div>
                    </div>
                    <div class="mx-1 w-24 rounded-lg bg-white p-2 text-black">
                        <div class="leading-none" x-text="minutes">00</div>
                        <div class="text-sm uppercase leading-none">Minutes</div>
                    </div>
                    <div class="mx-1 w-24 rounded-lg bg-white p-2 text-black">
                        <div class="leading-none" x-text="seconds">00</div>
                        <div class="text-sm uppercase leading-none">Seconds</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        function beer() {
            return {
                seconds: '00',
                minutes: '00',
                hours: '00',
                days: '00',
                distance: 0,
                countdown: null,
                beerTime: new Date('February 14, 2024 00:00:00').getTime(),
                now: new Date().getTime(),
                start: function() {
                    this.countdown = setInterval(() => {
                        // Calculate time
                        this.now = new Date().getTime();
                        this.distance = this.beerTime - this.now;
                        // Set Times
                        this.days = this.padNum(Math.floor(this.distance / (1000 * 60 * 60 * 24)));
                        this.hours = this.padNum(Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
                        this.minutes = this.padNum(Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60)));
                        this.seconds = this.padNum(Math.floor((this.distance % (1000 * 60)) / 1000));
                        // Stop
                        if (this.distance < 0) {
                            clearInterval(this.countdown);
                            this.days = '00';
                            this.hours = '00';
                            this.minutes = '00';
                            this.seconds = '00';
                        }
                    }, 100);
                },
                padNum: function(num) {
                    var zero = '';
                    for (var i = 0; i < 2; i++) {
                        zero += '0';
                    }
                    return (zero + num).slice(-2);
                }
            }
        }
    </script>
    <script>
        const pieChart = document.getElementById('pie-chart');
        const lineChart = document.getElementById('line-chart');
        const candidates = {!! json_encode($candidates) !!};
        let totalVote;
        const namaPaslon = ['Anies Muhaimin', 'Prabowo Gibran', 'Ganjar Mahfud'];
        const suara = [];
        candidates.forEach((candidate) => {
            // namaPaslon.push(candidate.paslon);
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
                    duration: 2000, // Durasi animasi dalam milidetik (misalnya, 2000 ms)
                    easing: 'easeInOutQuart', // Jenis perubahan animasi (gunakan easing functions)
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
    <script>
        function handleVote(id) {
            if ("geolocation" in navigator) {
                navigator.permissions.query({
                    name: 'geolocation'
                }).then(function(permissionStatus) {
                    if (permissionStatus.state == 'granted') {
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
                    } else {
                        showLocationPermissionAlert();
                    }
                });
            } else {
                showLocationNotSupportedAlert();
            }
        }

        function showLocationPermissionAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Izin Lokasi Diperlukan',
                text: 'Untuk melakukan vote, izinkan lokasi pada perangkat Anda.',
                showConfirmButton: true,
            });
        }

        function showLocationNotSupportedAlert() {
            Swal.fire({
                icon: 'error',
                title: 'Geolocation Tidak Didukung',
                text: 'Perangkat Anda tidak mendukung geolocation.',
                showConfirmButton: true,
            });
        }

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const long = position.coords.longitude;
                    if (lat && long) {
                        $.ajax({
                            url: '{{ route('vote.location') }}',
                            type: 'POST',
                            data: {
                                lat: lat,
                                long: long,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (!response.data) {
                                    window.location.href = "/404";
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            },
                        })
                    } else {
                        // Tidak bisa mendapatkan koordinat
                        window.location.href = "/404";
                    }
                },
                function(error) {
                    console.error("Error getting geolocation:", error);
                    // Tangani kesalahan ketika gagal mendapatkan lokasi
                    window.location.href = "/404";
                }
            );
        } else {
            // Geolocation tidak didukung
            console.log("Geolocation not supported");
        }
    </script>
@endpush
