<div class="rounded-lg border border-gray-200 bg-white shadow">
    <img class="rounded-t-lg" src="{{ $image }}" alt="" />
    <div class="p-5">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Calon Nomor Urut {{ $id }}</h5>
        <p class="mb-4 font-normal text-gray-700">{{ $paslonName }}</p>
        <div class="flex flex-col items-start gap-x-2 gap-y-2 xl:flex-row">
            <a href="{{ route('candidates.show', $id) }}" class="inline-flex items-center rounded-lg bg-white px-3 py-2 text-center text-sm font-medium text-blue-700 ring-1 ring-blue-700 transition-colors duration-200 hover:bg-blue-700 hover:text-white">
                Lihat Visi & Misi
                <svg class="ms-2 h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
            <a href="#" class="inline-flex items-center rounded-lg bg-blue-700 px-3 py-2 text-center text-sm font-medium text-white transition-colors duration-200 hover:bg-blue-900">
                Pilih Calon Nomor Urut 1
            </a>
        </div>
    </div>
</div>
