@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold text-uppercase mb-0"
                    style="letter-spacing:2px;color:#0056b3;">
                    <i class="bi bi-folder2-open me-2"></i>
                    Add New Article
                </h4>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" id="category" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Subcategory --}}
                <div class="mb-3">
                    <label class="form-label">Subcategory (Optional)</label>
                    <select name="subcategory_id" id="subcategory" class="form-select">
                        <option value="">-- Select Subcategory --</option>
                    </select>
                    @error('subcategory_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text"
                           name="title"
                           id="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Slug --}}
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text"
                           name="slug"
                           id="slug"
                           class="form-control"
                           value="{{ old('slug') }}"
                           readonly>
                    <small class="text-muted">Slug is generated automatically.</small>
                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label class="form-label">Feature Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Content (plain textarea) --}}
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" id="content" rows="5" class="form-control">{{ old('content') }}</textarea>
                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Description (Summernote) --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- Publish --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input ms-0 me-2" type="checkbox" name="is_published" value="1">
                    <label class="form-check-label fw-semibold">Publish immediately</label>
                </div>

                <input type="hidden" name="author_id" value="{{ auth()->id() }}">

                <button type="submit" class="btn btn-primary">Save Article</button>
                <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>

            </form>

        </div>
    </div>

</div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // Description editor (Summernote)
    $('#description').summernote({
        placeholder: 'Short description shown with article…',
        height: 180
    });

    // Auto slug generator
    $('#title').on('keyup change', function () {
        let slug = $(this).val()
            .trim()
            .toLowerCase()
            .replace(/[\s\W-]+/g, '-')
            .replace(/(^-|-$)+/g, '');
        $('#slug').val(slug);
    });

    // Dynamic subcategory load
    $('#category').on('change', function () {
        let category_id = $(this).val();

        if (!category_id) {
            $('#subcategory').html('<option value="">-- Select Subcategory --</option>');
            return;
        }

        $('#subcategory').html('<option>Loading...</option>');

        $.get('/subcategories/by-category/' + category_id, function (data) {

            let options = '<option value="">-- Select Subcategory --</option>';

            if (data.length === 0) {
                options += '<option disabled>No subcategories found</option>';
            }

            data.forEach(item => {
                options += `<option value="${item.id}">${item.name}</option>`;
            });

            $('#subcategory').html(options);
        });
    });

});
</script>
@endsection
