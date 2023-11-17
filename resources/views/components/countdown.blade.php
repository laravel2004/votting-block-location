<section class="mt-24 flex items-center justify-center bg-white pb-14 pt-5">
    <div>
        <div class="mb-8">
            <div class="mb-4 flex items-center justify-center gap-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                    <path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path>
                    <path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path>
                </svg>
                <h2 class="text-center text-xl">14 Februari 2024</h2>
            </div>
            <h1 class="text-center text-3xl font-bold">Waktu hitung mundur hingga pemilu 2024</h1>
        </div>
        <div class="flex w-full items-center justify-center text-center text-6xl">
            <div class="mx-1 w-24 rounded-lg p-2">
                <div class="leading-none" id="days">00</div>
                <div class="mt-3 text-sm uppercase leading-none">Hari</div>
            </div>
            <div class="mx-1 w-24 rounded-lg p-2">
                <div class="leading-none" id="hours">00</div>
                <div class="mt-3 text-sm uppercase leading-none">Jam</div>
            </div>
            <div class="mx-1 w-24 rounded-lg p-2">
                <div class="leading-none" id="minutes">00</div>
                <div class="mt-3 text-sm uppercase leading-none">Menit</div>
            </div>
            <div class="mx-1 w-24 rounded-lg p-2">
                <div class="leading-none" id="seconds">00</div>
                <div class="mt-3 text-sm uppercase leading-none">Detik</div>
            </div>
            <div id="end"></div>
        </div>
    </div>
</section>

@push('script')
    <script>
        var targetDate = new Date("February 14, 2024 00:00:00").getTime();

        var x = setInterval(function() {
            var now = new Date().getTime();
            var distance = targetDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerText = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("end").innerHTML = "Waktu hitung mundur telah berakhir!";
            }
        }, 1000);
    </script>
@endpush
