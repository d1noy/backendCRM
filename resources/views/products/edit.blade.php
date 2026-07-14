@extends('layout')

@section('content')

    <section class="container">
        <div class="form-container good">
            <div class="card">
                <div class="card-body">
                    <div class="form-title"><h2><i class="bi bi-pencil-square"></i>Edit Product</h2>
                        <p class="text-muted">Update product information</p>
                    </div>

                    <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @include('products._form', compact('product'))

                        <button type="submit" class="btn btn-primary w-100 py-3 mt-3"><i class="bi bi-check-circle"></i>Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
