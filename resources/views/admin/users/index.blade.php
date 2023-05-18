@extends('admin.layouts.master')
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
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" class="fw-bold">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><span class="fw-bold">Users<span></li>
        </ol>
    </nav>
<div class="container mt-4 py-4">
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
    <!-- data table -->
    <table class="table table-bordered table-striped" id="myTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Registered Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status }}</td>
                    <td>
                        {{ Carbon::parse($user->created_at)->format('F d, Y h:i A') }}
                    </td>
                    <td>
                        <form method="post"
                            action="{{ route('admin.users.view', '@'.str_replace(' ', '', strtolower($user->name))) }}"
                            style="display: inline-block;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <button type="submit" class="btn" data-toggle="tooltip" title="View User"><i
                                    class="fa fa-eye text-info"></i></button>
                        </form>

                        <form action="{{route('admin.users.destroy',$user->id)}}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn"
                                onclick="return confirm('Are you sure you want to delete this user?')"
                                data-toggle="tooltip" title="Delete User"><i
                                    class="fa fa-trash text-danger"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@section('script')
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
                    "data": "Email"
                }, {
                    "data": "Status"
                }, {
                    "data": "Registered Date"
                }, {
                    "data": "Action"
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
