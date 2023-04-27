@extends('admin/layouts/master') @section('content')
<!-- Post navigation -->
<div class="container mb-4 mt-4 p-3">
    <h5 class="col-md-6">Posts</h5>
    <div class="row mt-4">
        <div class="col-md-6">
            <a
                href="#"
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addPostModal"
            >
                Add New Post
            </a>
        </div>
        <div class="col-md-6">
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <div class="row">
                    <div class="col-md-8">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Enter keyword..."
                        />
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-block" type="button">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Post table -->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>First Post</td>
            <td>John Doe</td>
            <td>Tech</td>
            <td>Web Development, Laravel</td>
            <td>
                <a href="#" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Second Post</td>
            <td>Jane Doe</td>
            <td>Health</td>
            <td>Fitness, Nutrition</td>
            <td>
                <a href="#" class="btn btn-primary">Edit</a>
                <a href="#" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    </tbody>
</table>

<!-- add post modal -->
<div id="addPostModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Post</h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <textarea name="body" id="editor"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                >
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection
