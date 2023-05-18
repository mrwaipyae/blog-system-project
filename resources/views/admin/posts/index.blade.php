@extends('admin/layouts/master')
@section('link')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


@endsection
@section('page_title','admin')
@section('content')
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="fw-bold">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span class="fw-bold">Posts<span></li>
        </ol>
    </nav>
<!-- Post navigation -->
<div class="container mb-4 mt-1 p-3">
    <!-- Alert message (start) -->
    @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <!-- Alert message (end) -->
        <div class="row mt-3 mb-4">
            <div class="">
                <a href="{{ route('admin.posts.new') }}" class="btn btn-success">
                    <i class="bi bi-plus-square me-2"></i>New Post
                </a>
            </div>
        </div>


<!-- Post table -->
@php
    use Carbon\Carbon;
    $no = 1;
@endphp
<table class="row mb-2">
    <div class="col-12">
        <div class="row">
            <div class="col-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" id="from_date" placeholder="Start Date" readonly>
                </div>
            </div>
            <div class="col-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" id="to_date" placeholder="End Date" readonly>
                </div>
            </div>
            <div class="col-1">
                <input type="submit" class="btn btn-outline-danger fw-bold" name="" id="reset" value="Reset">
            </div>
        </div>

    </div>
</table>

<table class="table table-bordered table-striped" id="myTable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">User</th>
            <th scope="col">Tags</th>
            <th>Date</th>
            <th scope="col" class="col-lg-3">Actions</th>

        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
            <tr>
                <th>{{ $no++ }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>
                    @foreach($post->tags as $index => $tag)
                        {{ $tag->name }}
                        @if($index < count($post->tags) - 1)
                            ,
                        @endif
                    @endforeach
                </td>
                <td>
                    {{ Carbon::parse($post->created_at)->format('F d, Y h:i A') }}
                </td>
                <td>
                    <a href="{{ route('admin.post.show', ['@'.str_replace(' ', '', strtolower($post->user->name)), Str::slug($post->title).'-'. $post->id]) }}"
                        class="btn" data-toggle="tooltip" data-placement="top" title="View"><i
                            class="fa fa-eye text-info"></i></a>
                    <a href="{{ route('admin.posts.edit',$post->id) }}" class="btn"
                        data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit text-warning"></i>
                    </a>

                    <button type="button" class="btn" data-toggle="modal"
                        data-target="#deletePostModal{{ $post->id }}" data-toggle="tooltip" data-placement="top"
                        title="Delete">
                        <i class="fa fa-trash text-danger"></i>
                    </button>
                    <button type="button"
                        class="btn {{ (!$post->deleted_at)?'btn-secondary':'btn-success' }} btn-sm"
                        data-toggle="modal" data-target="#publishPostModal{{ $post->id }}" data-toggle="tooltip"
                        data-placement="top"
                        title="{{ (!$post->deleted_at)?'Unpublish':'Publish' }}">
                        {{ (!$post->deleted_at)?'Unpublish':'Publish' }}
                    </button>
                </td>

            </tr>
            <!-- Post view modal -->
            <div class="modal fade" id="viewPostModal{{ $post->id }}" tabindex="-1" role="dialog"
                aria-labelledby="postViewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="postViewModalLabel">{{ $post->title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $post->image_url }}" class="img-fluid">
                                </div>
                                <div class="col-md-8">

                                    <p>
                                        <img src="{{ asset('img/' . $post->image) }}"
                                            alt="">
                                    </p>
                                    <p>
                                        Tags:
                                        @foreach($post->tags as $tag)
                                            {{ $tag->name }}
                                        @endforeach
                                    </p>
                                    {!! $post->content!!}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Post Edit Modal -->
            <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1"
                aria-labelledby="editPostModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editPostForm"
                                action="{{ route('admin.posts.update', $post->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $post->title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" id="editor" name="content"
                                        required>{{ $post->content }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <select class="form-control" id="tags" name="tags[]" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" @if (in_array($tag->id,
                                                $post->tags->pluck('id')->toArray())) selected @endif>{{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Post Modal -->
            <div class="modal fade" id="deletePostModal{{ $post->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this Post?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('admin.posts.destroy', $post->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Publish unpublish Post Modal -->
            <div class="modal fade" id="publishPostModal{{ $post->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Edit Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to
                            <span>
                                @if(!$post->deleted_at)
                                    Unpublish
                                @else
                                    Publish
                                @endif
                            </span>
                            this Post?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('admin.posts.publish', $post->id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>
</div>
@endsection
@section('script')
<!-- Datepicker -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
<script>
    $(function () {
        $("#from_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
        $("#to_date").datepicker({
            "dateFormat": "yy-mm-dd"
        });
    });

    // Reset
    $(document).on("click", "#reset", function (e) {
        e.preventDefault();
        location.reload();
        $("#from_date").val(''); // empty value
        $("#to_date").val('');

    });

    $(document).ready(
        function () {
            var table = $('#myTable').DataTable({
                ordering: false,
                lengthMenu: [5, 10, 15, 20, 25],

                "columns": [{
                    "data": "ID"
                }, {
                    "data": "Title"
                }, {
                    "data": "User"
                }, {
                    "data": "Tags"
                }, {
                    "data": "Date"
                }, {
                    "data": "Actions"
                }]
            });
            // Add date range filtering function
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var min = $('#from_date').val();
                var max = $('#to_date').val();
                var date = new Date(data[4]);
                if ((min === "" && max === "")

                    ||
                    (min <= date.toISOString() && max === "")

                    ||
                    (max >= date.toISOString() && min === "")

                    ||
                    (min <= date.toISOString() && max >= date
                        .toISOString())) {
                    return true;
                }
                return false;
            });

            // Attach date filter to input fields

            $('#from_date, #to_date').change(function () {
                table.draw();
            });

            // Clear datepicker when table is redrawn

            table.on('draw.dt', function () {
                $('#from_date').val();
                $('#to_date').val();
            });

        });
</script>
@endsection
