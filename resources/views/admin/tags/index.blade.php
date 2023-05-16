@extends('admin/layouts/master')
@section('page_title','admin')
@section('link')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endsection
@section('content')
@php
    use Carbon\Carbon;
    $no = 1;
@endphp
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 p-3">
            <!-- Tag navigation -->
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h3 class="mb-0 ">Topic</h3>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTagModal">
                    <i class="bi bi-plus-square me-2"></i>New Topic
                </button>
            </div>
            <!-- date input -->
            <table class="row mb-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn btn-primary text-white" id="basic-addon1"><i
                                            class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" id="from_date" placeholder="Start Date"
                                    readonly>
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
                            <input type="submit" class="btn btn-outline-danger fw-bold" name="" id="reset"
                                value="Reset">
                        </div>
                    </div>
                </div>
            </table>
            <!-- data table -->
            <table class="table table-bordered table-striped" id="myTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @isset($tags)
                        @foreach($tags as $tag)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $tag->name }}</td>
                                <td>
                                    {{ Carbon::parse($tag->created_at)->format('F d, Y h:i A') }}
                                </td>
                                <td>
                                    {{ Carbon::parse($tag->updated_at)->format('F d, Y h:i A') }}
                                </td>
                                <td>
                                    <form method="post"
                                        action="{{ route('admin.tags.view', str_replace(' ', '-', strtolower($tag->name))) }}"
                                        style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $tag->id }}">
                                        <button type="submit" class="btn" data-toggle="tooltip" data-placement="top"
                                            title="View Tag"><i class="fa fa-eye text-info"></i></button>
                                    </form>
                                    <button type="button" class="btn" data-toggle="modal"
                                        data-target="#editTagModal{{ $tag->id }}" data-toggle="tooltip"
                                        data-placement="top" title="Edit Tag"><i
                                            class="fa fa-edit text-primary"></i></button>
                                    <button type="button" class="btn" data-toggle="modal"
                                        data-target="#deleteTagModal{{ $tag->id }}" data-toggle="tooltip"
                                        data-placement="top" title="Delete Tag"><i
                                            class="fa fa-trash text-danger"></i></button>
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
                    "data": "No"
                }, {
                    "data": "Name"
                }, {
                    "data": "Created At"
                }, {
                    "data": "Updated At"
                }, {
                    "data": "Actions"
                }]
            });
            // Add date range filtering function
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var min = $('#from_date').val();
                var max = $('#to_date').val();
                var date = new Date(data[2, 3]);
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
