@extends('admin.layouts.master')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-edit"></i> Edit Category
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}"
                        method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $category->name }}" required>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.categories') }}"
                                class="btn btn-secondary">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
