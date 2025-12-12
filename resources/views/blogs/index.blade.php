@extends('Main_layout')
@extends('layouts.app')


@section('title')
    blogs data
@endsection
@section('data')
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Blogs Data</h6>
                <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="text"> Add Blog </span>
                </a>
                <a href="{{ route('status') }}" class="btn btn-info btn-icon-split">
                    <span class="text">Delete Status</span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>content</th>
                                <th>photo</th>
                                <th>category</th>
                                <th>Settings</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>{{ $blog->title }}</td>
                                    <td>{{ $blog->content }}</td>

                                    <td>
                                        @if ($blog->image)
                                            @php
                                                $filename = $blog->image;
                                            @endphp

                                            <img src="{{ route('blog.image.show', ['filename' => $filename]) }}"
                                                style="width: 90px; height: 90px; object-fit: cover; border-radius: 5px;">
                                        @endif
                                    </td>

                                    <td>
                                        {{ $blog->categories->pluck('name')->implode(', ') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('blogs.edit', $blog->id) }}"
                                            class="btn btn-success btn-icon-split">
                                            <span class="text">Edit</span>
                                        </a>
                                        <hr style="border: 0.5px solid #c49696; margin: 20px 0;">
                                        @if ($blog->deleted_at == null)
                                            <form action="{{ route('soft.delete', $blog->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-secondary btn-icon-split">
                                                    <span class="text">Soft <br> Delete</span>
                                                </button>
                                            </form>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
