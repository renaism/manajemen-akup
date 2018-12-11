@extends('bahan.create')

@section('header')
    <span class="oi oi-pencil"></span>&nbsp;Edit Bahan
@endsection
@section('form-action')
    <form method="POST" action="{{ action('BahanController@update', $bahan->id) }}" accept-charset="UTF-8">
    @method('PUT')
@endsection
@section('nama'){{ $bahan->nama }}@endsection
@section('stok'){{ $bahan->stok }}@endsection
@section('form-submit')
    <span class="oi oi-pencil"></span>&nbsp;&nbsp;Edit
@endsection 