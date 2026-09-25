@extends('layouts.admin')

@section('title', 'About Section')

@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ Breadcrumb ] -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">About Section</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        @can('create about')
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Add New</button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <!-- [ Main Content ] -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>All About Section Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap table-sm ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Heading</th>
                                        <th>Subheading</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Heading</th>
                                        <th>Subheading</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .pc-content -->
</div> <!-- .pc-container -->

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="add-form" action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add About Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Subheading</label>
                    <input type="text" name="subheading" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Heading</label>
                    <input type="text" name="heading" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Paragraph 1</label>
                    <textarea name="paragraph_1" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Paragraph 2</label>
                    <textarea name="paragraph_2" class="form-control" rows="3" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>About Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit About Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="edit-form-body">
                <!-- Edit form loads via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(function () {
    var table = $('.ytable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('about.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'heading', name: 'heading' },
            { data: 'subheading', name: 'subheading' },
            { data: 'image', name: 'image' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });

    // Load Edit Modal
    $('body').on('click', '.edit', function () {
        let id = $(this).data('id');
        $.get("{{ url('admin/about') }}/" + id + "/edit", function (data) {
            $('#edit-form-body').html(data);
            $('#editModal').modal('show');
        });
    });

    // Submit Edit Form
$(document).on('submit', '#edit-form', function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var formData = new FormData(form); // ✅ FormData নেওয়া হয়েছে
    var url = $(this).attr('action');

    $.ajax({
        url: url,
        type: 'POST', // PUT এর বদলে POST
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-HTTP-Method-Override': 'PUT' // Laravel এ PUT simulate করা
        },
        success: function (data) {
            if (data.success) {
                toastr.success(data.message);
                $('#editModal').modal('hide');
                $('.ytable').DataTable().ajax.reload();
            }
        },
        error: function () {
            toastr.error('Something went wrong.');
        }
    });
});

    // Submit Add Form
    $('#add-form').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                toastr.success(data.message);
                $('#add-form')[0].reset();
                $('#addModal').modal('hide');
                table.ajax.reload();
            },
            error: function () {
                toastr.error('Insert failed. Check your inputs.');
            }
        });
    });

    // Delete Item
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This content will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/about') }}/" + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            table.ajax.reload();
                            toastr.success(response.message);
                        }
                    },
                    error: function () {
                        toastr.error('Delete failed. Try again.');
                    }
                });
            }
        });
    });
});
</script>
@endsection
