@extends('Main_layout')
@extends('layouts.app')


@section('title')
    Delete Status
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
                <h6 class="m-0 font-weight-bold text-primary">Delete Status</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Title</th>

                                <th>Settings</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    @if ($blog->deleted_at == !null)
                                        <td>{{ $blog->title }}</td>
                                        <td>
                                            <a href="{{ route('restore', $blog->id) }}"
                                                class="btn btn-success btn-icon-split">
                                                <span class="text">Restore</span>
                                            </a>
                                            <hr style="border: 0.5px solid #c49696; margin: 20px 0;">

                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-icon-split">
                                                    <span class="text">Force Delete</span>
                                                </button>
                                            </form>
                                    @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="custom-file" style="display: flex; justify-content: space-between; width: 100%;">


                        <a href="{{ route('backBlogsIndex') }}" class="bi bi-arrow-right-circle-fill">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z" />
                            </svg>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    @endsection
