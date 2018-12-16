@extends('layouts.main')

@section('header', 'Input Transaksi')
@section('main-content')
<style>
    input[type="number"] {
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
    }
</style>
    <div class="container mt-4">
        @section('form-action')
        <form method="POST" action="{{ action('TransaksiController@store') }}" accept-charset="UTF-8">
        @show
            @csrf
            <div class="row">
                <div class="col-6">
                    @if (count($daftarMenu) > 0)
                        @foreach ($daftarMenu as $menu)
                            <div class="menu d-flex">
                                <input type="hidden" class="menu-id" value="{{ $menu->id }}">
                                <div class="menu-img mr-3">
                                    <img src="{{ asset('storage/menu/gambar/'.$menu->gambar) }}" onError="this.onerror=null;this.src='{{ asset('menu_default.jpg') }}';" class="gambar-menu-sm img-thumbnail">
                                </div>
                                <div class="menu-detail flex-grow-1 mr-3">
                                    <h3 class="menu-nama">{{ $menu->nama }}</h3>
                                    <span>Rp{{ number_format($menu->harga) }},-</span>
                                </div>
                                <div class="menu-qty w-25 d-flex align-items-end">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn minus">&minus;</button>
                                        </div>
                                        <input type="hidden" id="menuId" value="{{ $menu->id }}">
                                        <input type="number" name="jumlah[{{ $menu->id }}]" id="inputJumlah{{ $menu->id }}" step="1" min="0" class="form-control input-jumlah" value="{{ old('jumlah.'.$menu->id, '0') }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn plus">&plus;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        
                    @endif
                </div>
                <div class="col-6">
                    <div class="card text-dark">
                        <div class="card-header">Pesanan</div>
                        <div class="card-body" id="daftarPesanan">
                            <table class="table table-borderless"><tbody>
                            @foreach ($daftarMenu as $menu)
                                <tr id="pesanMenu{{ $menu->id }}" class="d-none menu-item">
                                    <input type="hidden" class="menu-id" value="{{ $menu->id }}">
                                    <input type="hidden" class="menu-harga" value="{{ $menu->harga }}">
                                    <td>{{ $menu->nama }}</td>
                                    <td class="text-right">x<span class="jumlah-pesan">0</span></td>
                                    <td class="text-right">Rp<span class="harga-sub">0</span>,-</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Subtotal</td>
                                <td colspan="2" class="text-right">Rp<span id="subTotal">0</span>,-</td>
                            </tr>
                            </tbody></table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-lg btn-primary">
                                @section('form-submit')
                                    Input
                                @show 
                            </button>
                            <a href="/pembelian" class="btn btn-lg btn-danger float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>   
    </div>
@endsection

@push('scripts')
    <script>
        function getThousandSeparator() {
            return (1000).toLocaleString().substr(1,1);
        }

        var moneyRegex = new RegExp(getThousandSeparator(), "g");
        
        $(document).ready(function() {
            console.log("ready");
            // $daftarMenu = $("#daftarPesanan tbody").children(".menu-item").each(function() {
            //     console.log($(this).children(".pesan-jumlah").first().val());
            //     change_jumlah($(this).children(".menu-id").first().val(), $(this).children(".pesan-jumlah").first().val());
            // });

            $(".menu").each(function() {
                change_jumlah($(this).find(".menu-id").first().val(), $(this).find(".input-jumlah").first().val());
            });

            $("form").keypress(function(e) {
                //Enter key
                if (e.which == 13) {
                    return false;
                }
            });
        });

        function change_jumlah(menu_id, jumlah) {
            let $menu = $("#daftarPesanan #pesanMenu" + menu_id);
            let menu_harga = $menu.children(".menu-harga").first().val();

            let harga_sub = menu_harga * jumlah;
            let old_harga_sub = parseInt($menu.find(".harga-sub").text().replace(moneyRegex, ""));

            $menu.find(".harga-sub").text(harga_sub.toLocaleString());
            $menu.find(".jumlah-pesan").text(jumlah);
            //$menu.children(".pesan-jumlah").val(jumlah);
            if(jumlah > 0) {
                $menu.removeClass("d-none");
            }
            else if(jumlah == 0) {
                $menu.addClass("d-none");
            }

            let harga_total = parseInt($("#subTotal").text().replace(moneyRegex, ""));
            harga_total += harga_sub - old_harga_sub;
            $("#subTotal").text(harga_total.toLocaleString());
        }
        
        $(".minus").click(function(e) {
            $(this).parent().siblings("input[type=number]")[0].stepDown();
            let menu_id = $(this).parent().siblings("input[type=hidden]").val();
            let jumlah = $(this).parent().siblings("input[type=number]").first().val();
            change_jumlah(menu_id, jumlah);
        });

        $(".plus").click(function(e) {
            $(this).parent().siblings("input[type=number]")[0].stepUp();
            let menu_id = $(this).parent().siblings("input[type=hidden]").val();
            let jumlah = $(this).parent().siblings("input[type=number]").first().val();
            change_jumlah(menu_id, jumlah);
        });
    </script>
@endpush