@extends('admin/layouts/master')
@section('page_title','admin')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3">
            <!-- Tag navigation -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h3 class="mb-0 ">Tags</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTagModal">Add New
                    tag
                </button>
            </div>

            <!-- Category table -->
            <table class="table table-bordered table-striped">
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
                        @foreach($tags as $tag)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->created_at }}</td>
                                <td>{{ $tag->updated_at }}</td>
                                <td>
                                    <form method="post"
                                        action="{{ route('admin.tags.view', str_replace(' ', '-', strtolower($tag->name))) }}"
                                        style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $tag->id }}">
                                        <button type="submit" class="btn btn-info btn-sm"><i
                                                class="fa fa-eye"></i></button>
                                    </form>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editTagModal{{ $tag->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteTagModal{{ $tag->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Tag Modal -->
                            <div class="modal fade" id="editTagModal{{ $tag->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editTagModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editTagModalLabel">Edit Tag</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('admin.tags.update', $tag->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $tag->name }}">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteTagModal{{ $tag->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this tag?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <form
                                                action="{{ route('admin.tags.destroy', $tag->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset

                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- {{route('admin.tag.edit', $tag->id) }} --}}

<!-- Add tag modal -->
<div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTagModalLabel">Add New Tag</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form id="addTagForm" method="POST" action="{{ route('admin.tags.create') }}">
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
