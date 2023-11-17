@extends('layouts.main')

@section('content')
    <div class="mx-auto max-w-screen-lg pb-16 pt-8">
        <div class="flex flex-col justify-center">
            <img src="{{ asset('images/' . $candidate->image) }}" class="mb-8 w-full self-center rounded-lg shadow-md sm:w-96" />
            <h1 class="text-center text-3xl font-extrabold text-gray-900 md:text-4xl">{{ $candidate->paslon }}</h1>
        </div>
    </div>
    <div class="mx-auto max-w-screen-md pb-8">
        <div class="mb-6">
            <p class="mb-2 text-2xl font-bold">VISI</p>
            <p>{{ $candidate->visi }}</p>
        </div>
        <div class="mb-6">
            <p class="mb-2 text-2xl font-bold">MISI</p>
            <ol class="list-inside list-decimal space-y-2">
                @foreach ($missions as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
    </div>
@endsection
