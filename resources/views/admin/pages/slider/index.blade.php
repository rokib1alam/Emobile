@extends('layouts.admin')

@section('title', 'Slider')

@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Slider</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            @can('create slider')
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
            <!-- HTML5 Export Buttons table start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header table-card-header">
                        <h5>All Sliders List</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table id="" class="table table-striped table-bordered nowrap table-sm ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Heading Text</th>
                                        <th>Caption Text</th>
                                        <th>Video</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data populated by DataTables via AJAX -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Heading Text</th>
                                        <th>Caption Text</th>
                                        <th>Video</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- HTML5 Export Buttons end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<!-- Insert Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add New Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('slider.store') }}" method="post" id="add-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="heading_text" class="col-form-label pt-0">Heading Text<sup class="text-size-20 top-1">*</sup></label>
                        <input type="text" class="form-control" id="heading_text" name="heading_text" required>
                        <small id="emailHelp" class="form-text text-muted">This is your Slider Heading Text</small>
                    </div>

                    <div class="form-group">
                        <label for="caption_text" class="col-form-label pt-0">Caption Text<sup class="text-size-20 top-1">*</sup></label>
                        <input type="text" class="form-control" id="caption_text" name="caption_text" required>
                        <small id="emailHelp" class="form-text text-muted">This is your Slider Caption Text</small>
                    </div>

                    <div class="form-group">
                        <label for="video_url" class="col-form-label pt-0">Video URL<sup class="text-size-20 top-1">*</sup></label>
                        <input type="file" class="form-control" name="video_url" accept="video/*">
                        <small id="videoHelp" class="form-text text-muted">Upload a video file (mp4, mov, ogg, qt)</small>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
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
                <h5 class="modal-title" id="editModalLabel">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Edit form content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(function slider(){
        var table = $('.ytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('slider.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'heading_text', name: 'heading_text' },
                { data: 'caption_text', name: 'caption_text' },
                { data: 'video_url', name: 'video_url' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });

    // For Edit Slider
    $('body').on('click', '.edit', function() {
        let id = $(this).data('id');
        $.get("slider/" + id + "/edit", function(data) {
            $('.modal-body').html(data);
        });
    });
</script>

@endsection
