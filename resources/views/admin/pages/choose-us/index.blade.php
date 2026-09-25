@extends('layouts.admin')

@section('title', 'Choose Us')

@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Choose Us</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            @can('create choose_us')
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Add New</button>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header table-card-header">
                        <h5>All Choose Us List</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap table-sm ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data populated by DataTables -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('choose-us.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Choose Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" name="icon" required>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Choose Us</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="edit-form-body">
                <!-- Edit form content will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script type="text/javascript">
    $(function () {
        var table = $('.ytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('choose-us.index') }}",
                dataSrc: 'data'
            },
            language: {
                emptyTable: `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 40px 0;">
                        <img src="{{ asset('admin/images/no_data.svg') }}" alt="No Data" style="width: 80px; height:80px; margin-bottom: 15px;" />
                        <div style="font-size: 16px; color: #555;"><b>No data available</b><br/><p>Please add new entity regarding this table</p></div>
                    </div>
                `
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'icon', name: 'icon' },
                { data: 'title', name: 'title' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

    // Load edit form
    $('body').on('click', '.edit', function () {
        let id = $(this).data('id');
        $.get("choose-us/" + id + "/edit", function (data) {
            $('#edit-form-body').html(data);
        });
    });
</script>

@endsection
