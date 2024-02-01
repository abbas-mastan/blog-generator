@extends('app')
@section('content')
    <div class="px-[400px] mt-5">
        @foreach ($responses as $response)
        <div class="mb-24">
            <h2 class="text-red-300 text-4xl mb-5">{{ $response->heading }}</h2>
            <p>{{ $response->content }}</p>
        </div>
        @endforeach
    </div>
@endsection