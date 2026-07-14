@extends('layout')

@section('content')

    <div class="container py-5">
        <div class="page-title">
            <div>
                <h1>Products</h1>
                <p>Browse all available products</p>
            </div>
        </div>
        <div class="row g-4">
            @foreach($product as $products)
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        @if($products->default_image)
                            <div class="product-image">
                                <img src="{{$products->default_image}}" alt="{{$products->name}}">
                            </div>
                        @endif
                        <div class="product-content">
                                <h3>{{$products->name}}</h3>
                                <p class="product-description">{{$products->description}}</p>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <div class="product-price">{{$products->price}} ₽</div>
                                    <a href="{{route('products.show',$products)}}" class="btn btn-primary">More</a>
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-5">
            {{$product->links('vendor.pagination.custom')}}
        </div>
    </div>
@endsection
