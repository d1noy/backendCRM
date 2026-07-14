@extends('layout')

@section('content')

    <div class="container py-5">


        <div class="page-title">

            <div>
                <h1>
                    Categories
                </h1>
                <p>
                    Manage product categories and their contents
                </p>
            </div>
            <a href="{{route('categories.create')}}" class="btn btn-primary btn-lg"><i class="bi bi-plus-lg"></i>New category
            </a>
        </div>
        <div class="modern-table">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Products
                    </th>
                    <th class="text-end">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>
                        <span class="text-muted">#{{$category->id}}
                        </span>
                        </td>
                        <td>
                            <div class="category-title">{{$category->title}}</div>
                        </td>
                        <td>

                            {{$category->description}}
                        </td>
                        <td>
                        <span class="badge bg-primary">
                            {{$category->products()->count()}}
                            products
                        </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{route('products.index', $category)}}" class="btn btn-light" title="View products"><i class="bi bi-eye"></i></a>
                                <a href="{{route('categories.edit', $category)}}" class="btn btn-success" title="Edit"><i class="bi bi-pencil"></i></a>
                                @if($category->products()->count() === 0)
                                    <a href="{{route('categories.destroy', $category)}}" class="btn btn-danger" title="Delete"><i class="bi bi-trash"></i></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
