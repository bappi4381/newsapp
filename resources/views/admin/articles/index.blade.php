dD@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="card-title">Articles</h5>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary float-end">Add Article</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">  
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Published At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->user->name }}</td>
                                <td>{{ $article->published_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('admin.articles.destroy', $article->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No articles found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection