@extends('Main_layout')
@extends('layouts.app')

@section('title')
    home
@endsection
@section('data')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="container my-4">
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-6 col-md-8">

                <form action="{{ route('home') }}" method="GET">
                    <div class="input-group shadow-sm rounded-pill p-1 bg-white">

                        <span class="input-group-text border-0 bg-transparent ps-3">
                            <i class="fas fa-filter text-primary"></i>
                        </span>

                        <select name="category_id" id="category_filter" class="form-select border-0 bg-transparent fw-bold"
                            onchange="this.form.submit()">

                            <option value="" class="fw-bold text-muted">-- Filter by category--</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (request('category_id') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @if (request()->has('category_id') && request('category_id') != '')
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary border-0 rounded-pill">
                                <i class="fas fa-times me-1"></i> cancel
                            </a>
                        @endif

                    </div>
                </form>

            </div>
        </div>

    </div>
    <div class="card shadow **mb-4**">
        @foreach ($blogs as $blog)
            @php
                $is_favored = $blog->favoredBy->contains(Auth::id());
            @endphp

            <form action="{{ route('blog.favor.toggle', $blog->id) }}" method="POST" style="display:inline;">
                @csrf

                <button type="submit" class="btn btn-sm {{ $is_favored ? 'btn-danger' : 'btn-outline-danger' }}"
                    title="{{ $is_favored ? 'Remove from favorites' : 'Add to favorites' }}">

                    @if ($is_favored)
                        <i class="fas fa-heart"></i>
                    @else
                        <i class="far fa-heart"></i>
                    @endif

                </button>
            </form>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $blog->title }}</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    @if ($blog->image)
                        @php
                            $filename = $blog->image;
                        @endphp
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 30%;"
                            src="{{ route('blog.image.show', ['filename' => $filename]) }}" alt="...">
                    @endif
                </div>
                <p>{{ $blog->content }}</p>
                @foreach ($blog->categories as $category)
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">#{{ $category->name }}</h6>
                    </div>
                @endforeach
            </div>
            <hr style="border: 3px solid #333; margin: 20px 0;">
        @endforeach
        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
