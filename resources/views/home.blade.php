@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center "><img src="{{ asset('/images/home.jfif') }}"
                class="w-75 mb-2 shadow rounded" alt=""></div>
        <p class='h2 text-center text-primary mt-2'>{{ $loginInfo }}</p>

    </div>
@endsection
