@extends('client.layout')
<title>Your cart</title>
@section('content')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-12 mr-0 p-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"> Shopping Cart </h4>

                        {{-- @if (count($cart) == 0)
                            <h1> Your cart is empty</h1>
                        @else --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 120px;">Product Pict</th>
                                    <th class="pl-5">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th> Action </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cart as $data)
                                    <tr>
                                        @foreach ($data->products as $key => $item)
                                            <th scope="row">
                                                <img src="{{ asset('images/' . $item->images->first()->image_name) }}"
                                                    class="border" style="width:120px;" alt="">
                                            </th>
                                            <td class="pl-5 m-auto ">{{ $item->product_name }}</td>
                                            <td class="fw-bold"> Rp.{{ number_format($item->price, 2) }}</td>

                                            {{-- <form action="{{ route('updateQty', $data->cart_id) }}" method="get"> --}}
                                            <td>
                                                <input id="ticketNum" type="number" name="product_quantity" min="1"
                                                    value="{{ $data->qty }}" style="width: 50px;">
                                            </td>
                                            <td>
                                        @endforeach



                                        {{-- <button type="submit" class="btn btn-warning fw-bold">Update Qty</button> --}}
                                        {{-- </form> --}}

                                        <a href="{{ route('transaction.create', $data->id) }}" type="submit"
                                            class="btn btn-info fw-bold"> <i class="fa fa-money"></i> Checkout </a>

                                        <a href="{{ route('cart.delete', $data->id) }}" class="btn btn-danger "> <i
                                                class="fa fa-trash"></i> Delete</a>



                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                        {{-- @endif --}}

                    </div>
                </div>
            </div>
            {{-- <div class="col-md ml-0 p-0 bg">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title mb-4"> Jumlah </h4>
                    <hr>
                    <h5>Items : <label for="" class="badge badge-info">6</label> </h5>
                    <h5> Price : Rp.500000 </h5>
                    <button class="btn btn-dark btn-block rounded-0">Proceed</button>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
@endsection
