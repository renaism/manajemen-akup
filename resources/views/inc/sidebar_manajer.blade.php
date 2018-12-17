@extends('inc.sidebar') 

@section('title', 'Manajer')
@section('pages')
    <a href="/bahan" class="nav-link text-light"><span class="oi oi-fire"></span>&nbsp;&nbsp;&nbsp;Bahan</a>
    <a href="/menu" class="nav-link text-light"><span class="oi oi-book"></span>&nbsp;&nbsp;&nbsp;Menu</a>
    <a href="/pembelian" class="nav-link text-light"><span class="oi oi-basket"></span>&nbsp;&nbsp;&nbsp;Pembelian</a>
    <a href="/keuangan" class="nav-link text-light"><span class="oi oi-spreadsheet"></span>&nbsp;&nbsp;&nbsp;Keuangan</a>
@endsection