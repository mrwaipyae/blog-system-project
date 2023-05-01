@extends('admin/layouts/master')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3">
            <!-- Tag navigation -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h3 class="mb-0 ">Tags</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTagModal">Add New tag</button>
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
                    @isset($tags)
                        @foreach ($tags as $tag)
                        <tr>
                            <th scope="row">{{$no++}}</th>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->created_at }}</td>
                            <td>{{ $tag->updated_at }}</td>
                            <td>
                                <a class="btn btn-primary" href="">Edit</a>
                                <a class="btn btn-danger" href="" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this category?')) { document.getElementById('delete-form-{{$tag->id}}').submit(); }">Delete</a>
                                <form id="delete-form-{{$tag->id}}" action="" method="POST" style="display: none;">
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
{{-- {{route('admin.tag.edit', $tag->id)}} --}}

<!-- Add tag modal -->
<div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTagModalLabel">Add New Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addTagForm" method="POST" action="{{route('admin.tags.create')}}">
                @csrf
                <div class="modal-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter tag name">
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