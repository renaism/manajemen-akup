@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ action('MenuController@store') }}" accept-charset="UTF-8">
        @csrf
        <div class="card black-text" style="margin-top: 48px">
            <div class="card-content">
                <span class="card-title">Insert Menu</span>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" name="nama" data-length="100">
                        <label>Nama Menu</label> 
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        Rp.
                        <div class="input-field inline">
                            <input type="number" name="harga" step="any">
                            <label>Harga</label>
                        </div>
                        ,-
                    </div>
                </div>
            </div>
            <div class="card-action">
                <button type="submit" class="waves-effect waves-light btn">Insert</button>
                <a class="waves-effect waves-light btn red right" href="/menu">Cancel</a>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems, {});
        });
    </script>
@endsection