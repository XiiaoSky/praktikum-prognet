@extends('client.layout')
<title>Your transaction</title>
@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h4>Complete your payment</h4>
            </div>
            <div class="card-body p-5">
                <div class="row">
                    {{-- @foreach ($transactionByUser->user->carts as $item) --}}
                        <div class="col-lg-3 m-0">

                            <h6> <b>Product name </b> <br> </h6>
                            <h6> <b>Price </b> <br> </h6>
                            <h6> <b>Qty </b> <br> </h6>
                            <h6> <b>Shipping Cost </b> <br> </h6>
                            <h6> <b>Sub total </b></h6>
                            <h6> <b> &nbsp; </b></h6>
                            <br>
                            <h6> <b> Total </b></h6>

                        </div>
                        <div class="col-lg-3 text-end m-0">
                            
                            
                            <h6>{{ $transactionByUser->first()->user->carts->qty}} item</h6>
                            <h6>Rp. {{ number_format($transactionByUser->shipping_cost) }}</h6>
                            <h6>{{$transactionByUser->first()->user->carts->qty }} item * Rp.{{ number_format($transactionByUser->first()->user->carts->products[0]->price) }} = </h6>
                            <h6>Rp.{{ number_format($transactionByUser->sub_total) }}</h6>
                            <hr>
                            <h6>Rp.{{ number_format($transactionByUser->total) }}</h6>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center">
                         
                                <img class="img-thumbnail h-75" src="{{ asset('images/'.$transactionByUser->first()->user->carts->products[0]->images[0]->image_name) }}" alt="">
                           
                        </div>
                        <hr>
                    {{-- @endforeach --}}
                        <form action="{{route('user.transaction.proofOfPayment',$transactionByUser->id)}}" method="POST" enctype="multipart/form-data" class="col-lg-4">
                            @csrf
                            <label for="">Upload your payment proof</label>
                            <input type="file" name="proof_of_payment" id="" class="form-control" accept="image/*">
                            
                            <div class="mt-5">
                                <button type="submit" class="btn btn-secondary">Upload</button>
                            </div>
                           
                        </form>
                   
                </div>




            </div>
        </div>
    </div>
@endsection
