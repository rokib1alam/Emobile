@extends('layouts.admin')
@section('title', 'Ads Manager')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Ads Manager</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Add New Banner</button>
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
                        <h5>All Ads Banner List</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap table-sm ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Title</th>
                                        <th>Discount Text</th>
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data populated by DataTables via AJAX -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>Title</th>
                                        <th>Discount Text</th>
                                        <th>Position</th>
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
        <!-- [ Main Content ] end -->
    </div>
</div>

<!-- Insert Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add New Ad Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('ads.store') }}" method="post" id="add-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="category_id" class="col-form-label pt-0">Category <sup class="text-danger">*</sup></label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="" disabled selected>-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name ?? $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="banner_position" class="col-form-label pt-0">Banner Position <sup class="text-danger">*</sup></label>
                            <select class="form-control" id="banner_position" name="banner_position" required>
                                <option value="1">Banner 1 (Top Banner)</option>
                                <option value="2">Banner 2 (Bottom Banner)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="title" class="col-form-label pt-0">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="e.g. Special Offer">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="discount_text" class="col-form-label pt-0">Discount Text</label>
                            <input type="text" class="form-control" id="discount_text" name="discount_text" placeholder="e.g. 20% Off">
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <label for="link" class="col-form-label pt-0">Custom Link (Optional)</label>
                            <input type="url" class="form-control" id="link" name="link" placeholder="https://example.com/product">
                        </div>
                        <div class="form-group col-md-12 mb-3">
                            <label for="image" class="col-form-label pt-0">Banner Image <sup class="text-danger">*</sup></label>
                            <input type="file" class="form-control dropify" id="image" name="image" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Ad Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="edit_modal_body">
                <!-- Edit form content will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function ads(){
        var table = $('.ytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ads.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'category_name', name: 'category.name' },
                { data: 'title', name: 'title' },
                { data: 'discount_text', name: 'discount_text' },
                { data: 'banner_position', name: 'banner_position' },
                { data: 'image', name: 'image' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

    // For Edit Ads Banner (Fixed Route URL)
    $('body').on('click', '.edit', function() {
        let id = $(this).data('id');
        
        // Blade Route Helper দিয়ে সঠিক URL ডায়নামিক তৈরি করা হলো
        let url = "{{ route('ads.edit', ':id') }}";
        url = url.replace(':id', id);

        $.get(url, function(data) {
            $('#edit_modal_body').html(data);
        }).fail(function(xhr) {
            alert('Data load failed! Check route or console.');
        });
    });

    // Delete confirmation handling
    $('body').on('click', '.delete', function() {
        let id = $(this).data('id');
        if (confirm('Are you sure you want to delete this ad banner?')) {
            $('#delete-form-' + id).submit();
        }
    });
</script>

@endsection