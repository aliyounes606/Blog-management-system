@extends('Main_layout')
@extends('layouts.app')


@section('data')

    <div class="container my-4">
        <h2>My favorite blogs</h2>

        @if ($blogs->isEmpty())
            <div class="alert alert-info text-center mt-5">
                You currently have no blogs in your favorites list.
            </div>
        @else
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>

                                <p class="card-text text-muted">
                                    categories:
                                    @foreach ($blog->categories as $category)
                                        <span class="badge bg-secondary text-white me-1">{{ $category->name }}</span>
                                    @endforeach
                                </p>

                                <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>

                                <form action="{{ route('blog.favor.toggle', $blog->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger ms-2">
                                        ❌ removal
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

@endsection
