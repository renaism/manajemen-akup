@extends('layouts.app')

@section('navbar')
    @include('inc.navbar')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('inc.sidebar')
            <div class="col-md-10 ml-auto">
                <div class="container py-5" id="mainContent">
                    <h1>
                        @yield('header')
                    </h1>
                    <hr>
                    @include('inc.messages')
                    @yield('main-content')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    
@endsection