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
            <x-card id="{{ $candidate->id }}" paslonName="{{ $candidate->paslon }}" image="{{ asset('images/' . $candidate->image) }}" />
        @endforeach
    </div>

    <x-chart voteCount="{{ $votes->count() }}" :candidates=$candidates />

    <x-countdown />
@endsection

@push('script')
    <script>
        getLocationPermission();

        function getLocationPermission() {
            if ("geolocation" in navigator) {
                navigator.permissions.query({
                    name: 'geolocation'
                }).then(function(permissionStatus) {
                    if (permissionStatus.state === 'granted') {
                        localStorage.setItem('locationPermission', 'granted');
                    } else if (permissionStatus.state === 'prompt') {
                        navigator.geolocation.getCurrentPosition(function() {
                            localStorage.setItem('locationPermission', 'granted');
                        }, function(error) {
                            showLocationPermissionAlert();
                            localStorage.setItem('locationPermission', 'denied');
                        });
                    } else {
                        showLocationPermissionAlert();
                        localStorage.setItem('locationPermission', 'denied');
                    }
                });
            } else {
                showLocationNotSupportedAlert();
                localStorage.setItem('locationPermission', 'denied');
            }
        }

        function handleVote(id) {
            const locationPermission = localStorage.getItem('locationPermission');
            if (locationPermission === 'granted') {
                getCurrentLocationAndVote(id);
            } else {
                getCurrentLocationByIp(id);
            }
        }

        function getCurrentLocationByIp(id) {
            $.ajax({
                url: '{{ route('vote.ip') }}',
                type: 'GET',
                success: function(response) {
                    if (!response.data) {
                        showLocationNotAllowedAlert();
                    } else {
                        performVote(id);
                    }
                },
                error: function(error) {
                    alert(error)
                },
            })
        }

        function getCurrentLocationAndVote(id) {
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
                                    showLocationNotAllowedAlert();
                                } else {
                                    performVote(id);
                                }
                            },
                            error: function(error) {
                                alert(error)
                            },
                        });
                    }
                },
                function(error) {
                    console.error("Error getting geolocation:", error);
                    showLocationNotSupportedAlert();
                }
            );
        }

        function performVote(id) {
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

        function showLocationPermissionAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'Anda Memblokir Izin Lokasi',
                text: 'Kami akan melakukan pengecekan dengan IP Anda.',
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

        function showLocationNotAllowedAlert() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal Melakukan Vote',
                text: 'Anda tidak dapat melakukan vote karena Anda tidak berada di daerah Surabaya.',
                showConfirmButton: true,
            });
        }
    </script>
@endpush
