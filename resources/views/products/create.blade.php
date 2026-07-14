@extends('layout')

@section('content')
    <section class="container">
        <div class="form-container good">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h2><i class="bi bi-bag-plus"></i>Add Product</h2>
                        <p class="text-muted">Create a new product in your catalog</p>
                    </div>
                    <form action="{{ route('products.store', $category) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @include('products._form')

                        <button type="submit" class="btn btn-primary w-100 py-3 mt-3"><i class="bi bi-plus-circle"></i>Add product</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
