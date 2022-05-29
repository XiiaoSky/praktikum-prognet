@extends('client.layout')
<title>Detail Product</title>
@section('content')
    <div class="container my-5">
        <div class="row p-5">
            <div class="col-md-5 p-0 m-0 bg-light h-auto">
                <div class="card p-3 border-0">
                    <div class="card-body border-none ">
                        <h3 class="card-title fw-bold d-block">{{ $product->product_name }}</h3>
                        @foreach ($product->images as $images)
                            <img class="details-image shadow rounded" src="{{ asset('images/' . $images->image_name) }}"
                                alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-0 rounded-right bg-light">
                <div class="card pt-1 bg-light rounded-0 border-0">
                    <div class="card-body">
                        <div class="card-header rounded-top">
                            <h3 class="mb-0 fw-bold">Payment Details</h3>
                        </div>
                        <div class="right-side p-3">
                            <div class="mb-3">
                                <h2 class="text-primary fw-bold"> Rp.{{ number_format($product->price, 0) }} / items</h2>
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-bold">Description</h6>
                                <p> {{ $product->description }}</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="fw-bold">Stock</h6>
                                <p> {{ $product->stock }} item</p>
                            </div>

                            <div class="mb-3">
                                <h6 class="fw-bold">Weight</h6>
                                <p> {{ $product->weight }} kg</p>
                            </div>


                            <div class="action mb-2">

                                <form action="{{ route('cart.add-to-cart', $product->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"
                                            aria-hidden="true"></i> Add to cart</button>
                                </form>
                                {{-- <a href="#" class="btn btn-warning"> <i class="fa fa-money" aria-hidden="true"></i></i>
                                    Checkout</a> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
