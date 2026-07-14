@extends('layout')

@section('content')
    <section class="container">
        <div class="form-container category">
            <div class="card">
                <div class="card-body">
                    <div class="form-title">
                        <h2>
                            <i class="bi bi-pencil-square"></i>
                            Edit Category
                        </h2>
                        <p class="text-muted">
                            Update category information
                        </p>
                    </div>
                    <form action="{{route('categories.update', $category)}}" method="post">
                        @csrf
                        @include('categories._form', compact('category'))
                        <button type="submit" class="btn btn-primary w-100 mt-3 py-3">
                            <i class="bi bi-check-circle"></i>
                            Save changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
