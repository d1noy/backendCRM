@extends('layout')

@section('content')

    <div class="container py-5">
        <div class="product-view">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-gallery">
                        @foreach($product->image_urls as $imageUrl )
                            <img src="{{$imageUrl}}" alt="Название Товара">
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-info">
                        <h2>{{$product->name}}</h2>
                        <div class="product-price mt-4">
                            {{$product->price}} ₽
                        </div>
                        <div class="description">
                            {{$product->description}}
                        </div>
                        <div class="mt-5 d-flex gap-3">
                            <a href="{{route('products.edit',$product)}}" class="btn btn-success"><i class="bi bi-pencil"></i>Edit
                            </a>
                            <a href="{{route('products.destroy',$product)}}" class="btn btn-danger"><i class="bi bi-trash"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
