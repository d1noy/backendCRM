@php
    $product = $product ?? null;
@endphp

<div class="mb-4">
    <label class="form-label">Product name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name', $product?->name)}}" placeholder="Enter product name">
    @error('name')
        <div class="invalid-feedback">Maximum 20 characters.</div>
    @enderror
</div>
<div class="mb-4">
    <label class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter product description">{{old('description', $product?->description)}}</textarea>
    @error('description')
        <div class="invalid-feedback">Maximum 50 characters.</div>
    @enderror
</div>
<div class="mb-4">
    <label class="form-label">Price</label>
    <div class="input-group">
        <input type="number" min="10" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price', $product?->price)}}" placeholder="0.00">
        <span class="input-group-text">₽</span>
    </div>
    @error('price')
        <div class="invalid-feedback d-block">Format xx.xx</div>
    @enderror
</div>
<div class="mb-4">
    <label class="form-label">Product images</label>
    <div class="upload-box">
        <i class="bi bi-cloud-arrow-up"></i>
        <p>Upload up to 5 images</p>
        <input type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" multiple>
    </div>
    @error('images')
        <div class="invalid-feedback d-block">You can upload up to 5 images.</div>
    @enderror
</div>
