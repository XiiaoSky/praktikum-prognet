@extends('client.layout')
<title>Product List</title>
@section('content')

<div class="container px-sm-1 py-5 mx-auto">
    <div class="row justify-content-center">
        @foreach ($products as $product)
        <div class="col-lg-4">
            <div class="card card-1 shadow-lg product-card">
                <div class="pr-3 row justify-content-end">
                    <i class="fa fa-heart-o like" aria-hidden="true"></i>
                </div>
                @foreach ($product->images as $image)
                <a href="{{route('productDetail',$image->id)}}" class="product-image">
                    <img class="pic1 shadow-lg" src="{{ asset('images/'.$image->image_name) }}"> 
                </a>  
                @endforeach
                
                <div class="card p-2 mt-2 shadow">
                    <h5 class="product-name">{{$product->product_name}}</h5>
                    <div class="row px-3 justify-content-between">
                        <p class="price"> <i class="fa fa-money" aria-hidden="true"></i> Rp. {{number_format($product->price,0)}}</p>
                        <span class="sm-text"> <i class="fa fa-clipboard" aria-hidden="true"></i> {{$product->weight}}</span>
                        <hr>
                        <div class="action mb-2">

                            <form action="{{route('cart.add-to-cart',$product->id)}}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to cart</button>
                            </form>
                        </div>
                        {{-- <div class="stars">
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star-o"></span>
                            <span class="fa fa-star-o"></span>
                        </div> --}}
                    </div>
                </div>
              
            </div>
        </div>
        
        @endforeach
       
    </div>
</div>

@endsection