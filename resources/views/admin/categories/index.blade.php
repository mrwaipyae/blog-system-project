@extends('admin/layouts/master')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3">
            <!-- Category navigation -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h3 class="mb-0 ">Categories</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add New Category</button>
            </div>

            <!-- Category table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp 
                    
                    @isset($categories)
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{$no++}}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.categories.edit', $category->id)}}">Edit</a>
                                <a class="btn btn-danger" href="{{route('admin.categories.destroy', $category->id)}}" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this category?')) { document.getElementById('delete-form-{{$category->id}}').submit(); }">Delete</a>
                                <form id="delete-form-{{$category->id}}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endisset
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add category modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addCategoryForm" method="POST" action="{{ route('admin.categories.create') }}">
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
        </div>
    </div>
</div>

@endsection