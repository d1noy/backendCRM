@extends('layout')

@section('content')
    <section class="container">
        <div class="form-container category">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h2>
                            <i class="bi bi-folder-plus"></i>
                            Create Category
                        </h2>
                        <p class="text-muted">
                            Add a new category for your products
                        </p>
                    </div>
                    <form action="{{route('categories.store')}}" method="post">
                        @csrf
                        @include('categories._form')
                        <button type="submit" class="btn btn-primary w-100 mt-3 py-3">
                            <i class="bi bi-plus-circle"></i>
                            Create category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
