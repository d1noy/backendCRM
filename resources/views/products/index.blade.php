@extends('layout')

@section('content')

    <div class="container py-5">
        <div class="page-title">
            <div>
                <h1>{{$category->title}}</h1>
                <p>{{$category->description}}</p>
            </div>
            <a href="{{route('products.create', $category)}}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add product</a>
        </div>
        <div class="modern-table">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product as $products)
                    <tr>
                        <td>#{{$products->id}}</td>
                        <td>
                            <strong>{{$products->name}}</strong>
                        </td>
                        <td>
                            <span class="fw-bold text-success">{{$products->price}} ₽</span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{route('products.show',$products)}}" class="btn btn-light"><i class="bi bi-eye"></i></a>
                                <a href="{{route('products.edit',$products)}}" class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                <a href="{{route('products.destroy',$products)}}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
