@extends('layouts.app')

@section('header')
    @include('inc.navbar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('inc.sidebar')
            <div class="col-md-10 ml-auto">
                <div class="container py-5">
                    @yield('main-content')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    
@endsection