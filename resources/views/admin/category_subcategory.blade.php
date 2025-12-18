@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-uppercase mb-0"
            style="letter-spacing:2px;color:#6f4e37;">
            <i class="bi bi-folder2-open me-2"></i>
            Category & Subcategory Management
        </h4>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- ================= CATEGORY FORM ================= --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header fw-semibold bg-light">
                    <i class="bi bi-tags-fill me-2"></i> Add Category
                </div>

                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Category Name</label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="Enter category name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Category Type</label>
                                <select name="type" class="form-select" required>
                                    <option value="article">Article</option>
                                    <option value="blog">Blog</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Category Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-brown px-4">
                            <i class="bi bi-plus-circle me-1"></i> Add Category
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- ================= SUBCATEGORY FORM ================= --}}
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header fw-semibold bg-light">
                    <i class="bi bi-diagram-3 me-2"></i> Add Subcategory
                </div>

                <div class="card-body">
                    <form action="{{ route('subcategories.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Category Type</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="">-- Choose Type --</option>
                                    <option value="article">Article</option>
                                    <option value="blog">Blog</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">-- Choose Category --</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Subcategory Name</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Enter subcategory name" required>
                        </div>

                        <button type="submit" class="btn btn-brown px-4">
                            <i class="bi bi-plus-circle me-1"></i> Add Subcategory
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= LIST ================= --}}
    <div class="card mt-4 border-0 shadow-sm rounded-3">
        <div class="card-header fw-semibold bg-light">
            <i class="bi bi-table me-2"></i> Categories & Subcategories
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead style="background:#f5ede6">
                    <tr>
                        <th width="20%">Category</th>
                        <th width="15%">Type</th>
                        <th width="15%">Image</th>
                        <th width="35%">Subcategories</th>
                        <th width="15%" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td class="fw-semibold">{{ $category->name }}</td>

                        <td class="fw-semibold text-capitalize">
                            {{ $category->type }}
                        </td>

                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}"
                                     class="img-thumbnail"
                                     style="max-width:80px">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>
                            @forelse($category->subcategories as $sub)
                                <div class="d-flex justify-content-between align-items-center border rounded px-2 py-1 mb-1">
                                    <span>{{ $sub->name }}</span>
                                    <form action="{{ route('subcategories.destroy',$sub->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Delete subcategory?')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <em class="text-muted">No subcategories</em>
                            @endforelse
                        </td>

                        <td class="text-center">
                            <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Delete category & subcategories?')">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No categories found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
document.getElementById('type').addEventListener('change', function () {
    let type = this.value;
    let category = document.getElementById('category_id');
    category.innerHTML = '<option>Loading...</option>';

    if(type){
        fetch(`/categories/by-type/${type}`)
            .then(res => res.json())
            .then(data => {
                category.innerHTML = '<option value="">-- Choose Category --</option>';
                data.forEach(cat => {
                    category.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
                });
            });
    }
});
</script>

{{-- Theme --}}
<style>
.btn-brown{
    background:#6f4e37;
    color:#fff;
}
.btn-brown:hover{
    background:#8b5e3c;
    color:#fff;
}
.card-header{
    letter-spacing:.5px;
}
</style>

@endsection