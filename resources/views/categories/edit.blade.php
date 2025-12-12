@extends('Main_layout')
@extends('layouts.app')

@section('title')
    Edit category
@endsection
@section('data')
    <div>
        @if (session()->has('error'))
            <div class="alert alert-error" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif

        <form action="{{ route('categories.update', $data['id']) }}" method="post" enctype="multipart/form-data" role="form"
            style="width: 80%; margin: 0 auto; background-color: white">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name"> name </label>
                    <input autofocus type="text" class="form-control" name="name" id="name"
                        value="{{ old('name', $data['name']) }}">
                    @error('name')
                        <span style="color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="custom-file" style="display: flex; justify-content: space-between; width: 100%;">

                    <button type="submit" class="btn btn-primary">Update</button>

                    <a href="{{ route('backCategoriesIndex') }}" class="bi bi-arrow-right-circle-fill">
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
