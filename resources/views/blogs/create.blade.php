@extends('Main_layout')
@extends('layouts.app')

@section('title')
    Add blog
@endsection
@section('data')
    <div>
        @if (session()->has('error'))
            <div class="alert alert-error" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif


        <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data" role="form"
            style="width: 80%; margin: 0 auto; background-color: white">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="title"> title </label>
                    <input autofocus type="text" class="form-control" name="title" id="title"
                        value="{{ old('title') }}">
                    @error('title')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">content</label>
                    <input type="note" class="form-control" name="content" id="content" value="{{ old('content') }}">
                    @error('content')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label> Choose category:</label>

                    <div class="form-check">

                        @if (!empty($category))
                            @foreach ($category as $info)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="category_ids[]"
                                        value="{{ $info->id }}" id="category-{{ $info->id }}"
                                        @php
$checked_categories = old('category_ids') ??
                                         (isset($blog) ? $blog->categories->pluck('id')->toArray() : []); @endphp
                                        @if (in_array($info->id, $checked_categories)) checked @endif>
                                    <label class="form-check-label" for="category-{{ $info->id }}">
                                        {{ $info->name }}
                                    </label>
                                </div>
                            @endforeach
                        @endif

                        @error('category_ids')
                            <span style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="image"> photo </label>
                    <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}">
                </div><br>
                <div class="custom-file" style="display: flex; justify-content: space-between; width: 100%;">

                    <button type="submit" class="btn btn-primary">Add</button>

                    <a href="{{ route('backBlogsIndex') }}" class="bi bi-arrow-right-circle-fill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                            class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                        </svg>
                    </a>

                </div>
            </div>



        </form>
    </div>
@endsection
