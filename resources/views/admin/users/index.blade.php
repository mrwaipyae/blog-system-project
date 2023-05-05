@extends('admin.layouts.master')
@section('page_title','admin')
@section('content')

<div class="container mt-4">
    <h1 class="mb-5">User management</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        <form method="post" action="{{ route('admin.users.view', '@'.str_replace(' ', '', strtolower($user->name))) }}"
                            style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button>
                        </form>

                        <form action="" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
