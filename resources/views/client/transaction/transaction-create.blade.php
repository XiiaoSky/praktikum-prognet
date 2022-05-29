<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
    <title>Your Transaction</title>
</head>

<body style="background: #f3f3f3">
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <a class="navbar-brand" href="{{ route('productList') }}">E-commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav mr-auto" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Link</a>
                    </li>
                </ul>
                <form class="d-flex justify-content-between">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success ml-2" type="submit">Search</button>
                </form>
                @auth
                    <li class="d-flex ms-5 nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.cart.index') }}"> <i class="fa fa-cart-plus"
                                        aria-hidden="true"></i> Cart</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out"></i>
                                    Logout</a></li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <ul>
                        <li class="nav-item">
                            <a href="#" class="nav-link"> This is guest</a>
                        </li>
                    </ul>
                @endguest
            </div>
        </div>

    </nav>
    {{-- ///End navbar --}}
    <div class="container p-5 mt-3">

        <div class="card">
            <div class="card">
                <div class="card-header">
                    Complete Your Transaction
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 pb-5"> 
                                <form action="{{ route('transaction.store',$cart->id) }}" method="POST">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <h3>ASAL PENGIRIM</h3>
                                            <hr>
                                            <div class="form-group">
                                                <label class="font-weight-bold">PROVINSI ASAL</label>
                                                <select class="form-control provinsi-asal" name="province_origin">
                                                    <option value="0">-- pilih provinsi asal --</option>
                                                    @foreach ($provinces as $province => $value)
                                                        <option value="{{ $province }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">KOTA / KABUPATEN ASAL</label>
                                                <select class="form-control kota-asal" name="city_origin">
                                                    <option value="">-- pilih kota asal --</option>
                                                </select>
                                                <hr>
                                            </div>
                                            <h3>TUJUAN PENGIRIMAN</h3>
                                            <hr>
                                            <div class="form-group">
                                                <label class="font-weight-bold">PROVINSI TUJUAN</label>
                                                <select class="form-control provinsi-tujuan"
                                                    name="province_destination">
                                                    <option value="0">-- pilih provinsi tujuan --</option>
                                                    @foreach ($provinces as $province => $value)
                                                        <option value="{{ $province }}">{{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">KOTA / KABUPATEN TUJUAN</label>
                                                <select class="form-control kota-tujuan" name="city_destination">
                                                    <option value="">-- pilih kota tujuan --</option>
                                                </select>
                                                <hr>
                                            </div>
                                            <div class="card-body px-2">
                                                <h3>ALAMAT LENGKAP</h3>
                                                <hr>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Alamat anda</label>
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        placeholder="Masukkan Berat (GRAM)"> </input>
                                                </div>
                                                <hr>
                                            </div>

                                            <div class="card-body px-2 pt-0">
                                                <h3>KURIR</h3>
                                                <hr>
                                                <div class="form-group">
                                                    <label>JENIS KURIR</label>
                                                    <select class="form-control kurir" name="courier">
                                                        <option value="0">-- pilih kurir --</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="pos">POS</option>
                                                        <option value="tiki">TIKI</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">BERAT (GRAM)</label>
                                                    <input type="number" class="form-control" name="weight"
                                                        id="weight" placeholder="Masukkan Berat (GRAM)">
                                                </div>
                                                <hr>
                                            </div>

                                           

                                            {{-- <div class="card-body px-2">
                                                <h3>TOTAL</h3>
                                                <hr>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">Sub Total</label>
                                                    <input type="text" class="form-control" name="address"
                                                        id="address" placeholder="Masukkan Berat (GRAM)"> </input>
                                                </div>
                                                <div class="form-group">
                                                    <label class="font-weight-bold">TOTAL</label>
                                                    <input type="text" class="form-control" name="address"
                                                        id="address" placeholder="Masukkan Berat (GRAM)"> </input>
                                                </div>
                                            </div> --}}
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <div class="card d-none ongkir">
                                                        <div class="card-body">
                                                            <select class="form-control" name="shipping_cost"
                                                                id="ongkir">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-md btn-primary btn-check shadow mt-2">CEK ONGKOS
                                                KIRIM</button>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-block mt-5"> Buat Transaksi</button>
                                </form>

                            </div>

                            <div class="col-md-6">

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title fw-bold">Product Detail</h5>
                                    </div>
                                    @foreach ($cart->products->first()->images as $item)
                                        <img class="img-thumbnail d-block m-auto w-50 mb-4 mt-2"
                                            src="{{ asset('images/'.$item->image_name) }}" alt="">
                                    @endforeach

                                    <div class="card-body">

                                        <h3 class="fw-bold">{{ $cart->products->first()->product_name }}</h3>
                                        <h3><i class="fa-solid fa-sack-dollar"></i>
                                            {{ number_format($cart->products->first()->price, 2) }}</h3>
                                        <div class="form-group">
                                            <b>Product Description</b>
                                            <p>{{ $cart->products->first()->description }}</p>
                                        </div>
                                        <h6> <i class="fa fa-weight fa-lg"></i> {{ $cart->products->first()->weight }} Kg</h5>
                                    </div>

                                   

                                </div>

                                {{-- <div class="card mt-2">
                                    <div class="card-header pb-0">
                                        <h5 class="p-0">Payment Detail </h5> <br>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6>Quantity </h6>
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $cart->qty }}
                                            </div>
                                            <div class="col-md-4">
                                                <h6>Product Name </h6>
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $cart->products->product_name }}
                                            </div>
                                            <div class="col-md-4">
                                                <h6>Price </h6>
                                            </div>
                                            <div class="col-md-8">
                                                : Rp .{{ number_format($cart->products->price) }}
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            //active select2
            $(".provinsi-asal , .kota-asal, .provinsi-tujuan, .kota-tujuan").select2({
                theme: 'bootstrap4',
                width: 'style',
            });
            //ajax select kota asal
            $('select[name="province_origin"]').on('change', function() {
                let provinceId = $(this).val();
                if (provinceId) {
                    jQuery.ajax({
                        url: 'transaction/cities/' + provinceId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="city_origin"]').empty();
                            $('select[name="city_origin"]').append(
                                '<option value="">-- pilih kota asal --</option>');
                            $.each(response, function(key, value) {
                                $('select[name="city_origin"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_origin"]').append(
                        '<option value="">-- pilih kota asal --</option>');
                }

            });
            //ajax select kota tujuan
            $('select[name="province_destination"]').on('change', function() {
                let provinceId = $(this).val();
                if (provinceId) {
                    jQuery.ajax({
                        url: 'transaction/cities/' + provinceId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="city_destination"]').empty();
                            $('select[name="city_destination"]').append(
                                '<option value="">-- pilih kota tujuan --</option>');
                            $.each(response, function(key, value) {
                                $('select[name="city_destination"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_destination"]').empty();
                }
            });
            //ajax check ongkir
            let isProcessing = false;
            $('.btn-check').click(function(e) {
                e.preventDefault();

                let token = $("meta[name='csrf-token']").attr("content");
                let city_origin = $('select[name=city_origin]').val();
                let city_destination = $('select[name=city_destination]').val();
                let courier = $('select[name=courier]').val();
                let weight = $('#weight').val();

                if (isProcessing) {
                    return;
                }

                isProcessing = true;
                jQuery.ajax({
                    url: "transaction/ongkir",
                    data: {
                        _token: token,
                        city_origin: city_origin,
                        city_destination: city_destination,
                        courier: courier,
                        weight: weight,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function(response) {
                        isProcessing = false;
                        if (response) {
                            $('#ongkir').empty();
                            $('.ongkir').addClass('d-block');
                            // $.each(data, function(key, value) {

                            // })
                            $.each(response[0]['costs'], function(key, value) {
                                $('#ongkir').append(' <option value="' + value.cost[0]
                                    .value + '" class="form-control">' +
                                    response[0].code.toUpperCase() + ' : <strong>' +
                                    value.service + '</strong> - Rp. ' + value.cost[
                                        0].value + ' (' + value.cost[0].etd +
                                    ' hari)</option>'
                                )
                            });

                        }
                    }
                });

            });

        });
    </script>
</body>

</html>
{{-- '<select name="shipping_cost" class="form-control">
    <option value="'+value.cost[0].value + '" class="form-control">' +
        response[0].code.toUpperCase() + ' : <strong>' +
            value.service + '</strong> - Rp. ' + value.cost[
        0].value + ' (' + value.cost[0].etd +
        ' hari)</option>
</select>' --}}
{{-- <input type="number" value="'+ value.cost[
                                        0].value + '" class="form-control">' +
                                    response[0].code.toUpperCase() + ' : <strong>' +
                                    value.service + '</strong> - Rp. ' + value.cost[
                                        0].value + ' (' + value.cost[0].etd +
                                    ' hari)</input> --}}
