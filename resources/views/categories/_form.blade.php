@php
    $category = $category ?? null;
@endphp

<div class="mb-4">
    <label for="name" class="form-label">Category name</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="name" name="title" value="{{old('title', $category?->title)}}" placeholder="Enter category name">
    @error('title')
    <div class="invalid-feedback">Maximum 15 characters. Only cyrillic, space, dash.</div>
    @enderror
</div>
<div class="mb-4">
    <label for="description" class="form-label">Description</label>
    <textarea
        class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Enter category description">{{old('description', $category?->description)}}</textarea>
    @error('description')
    <div class="invalid-feedback"> Maximum 50 characters. Only cyrillic, space, dash.</div>
    @enderror
</div>
