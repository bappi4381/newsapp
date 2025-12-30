@extends('layouts.app')

@section('content')
<div class="container">

     <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-uppercase mb-0"
            style="letter-spacing:2px;color:#0056b3;">
            <i class="bi bi-folder2-open me-2"></i>
            Article Management
        </h4>
    </div>

    {{-- Articles Table search --}}
    <div class="mb-4">
        <form action="{{ route('articles.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search article title">
                <button class="btn btn-brown" type="submit">
                    <i class="bi bi-search me-1"></i> Search
                </button>
            </div>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th width="220">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($articles as $key => $article)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->user->name ?? '—' }}</td>

                    <td>
                        @if($article->is_published)
                            <span class="badge bg-success">Published</span>
                        @else
                            <span class="badge bg-secondary">Draft</span>
                        @endif
                    </td>

                    <td>
                        {{-- EDIT --}}
                        @can('edit-article')
                            <a href="{{ route('articles.edit', $article->id) }}" 
                               class="btn btn-sm btn-warning">
                                Edit
                            </a>
                        @endcan

                        {{-- PUBLISH --}}
                        @can('publish-article')
                            @if(!$article->is_published)
                                <form action="{{ route('articles.publish', $article->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success" type="submit">
                                        Publish
                                    </button>
                                </form>
                            @endif
                        @endcan

                        {{-- DELETE --}}
                        @can('delete-article')
                            <form action="{{ route('articles.deleted', $article->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this article?')">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No articles found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $articles->links() }}

</div>
@endsection
