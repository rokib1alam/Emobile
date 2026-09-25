@extends('layouts.admin')
@section('title','Campaing')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Campaing</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Add New</button>
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
              <h5>All Campaing list</h5>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Start Date</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Discount(%)</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Data populated by DataTables via AJAX -->
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>SL</th>
                      <th>Start Date</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Discount(%)</th>
                      <th>Status</th>
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
                <h5 class="modal-title h4" id="myLargeModalLabel">Add New Campaing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('campaing.store')}}" method="post" id="add-form" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="form-group">
                  <label for="title" class="col-form-label pt-0">Campaing Title <sup class="text-size-20 top-1">*</sup></label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    <small id="emailHelp" class="form-text text-muted">This is campaing title/name</small>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="start_date" class="col-form-label pt-0">Start Date <sup class="text-size-20 top-1">*</sup></label>
                      <input type="date" class="form-control" id="start_date" name="start_date" required>
                  </div>
                  <div class="col-lg-6">
                    <label for="end_date" class="col-form-label pt-0">End Date <sup class="text-size-20 top-1">*</sup></label>
                      <input type="date" class="form-control" id="end_date" name="end_date" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <label for="status" class="col-form-label pt-0">Status <sup class="text-size-20 top-1">*</sup></label>
                      <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                  </div>
                  <div class="col-lg-6">
                    <label for="discount" class="col-form-label pt-0">Discount (%)<sup class="text-size-20 top-1">*</sup></label>
                      <input type="text" class="form-control" id="discount" name="discount" required>
                      <small id="emailHelp" class="form-text text-danger">Discount parcentage are apply for all product selling price</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="image" class="col-form-label pt-0">Image <sup class="text-size-20 top-1">*</sup></label>
                  <input type="file" class="dropify" data-height="200" name="image" />
                  <small id="emailHelp" class="form-text text-muted">This is your campaing banner</small>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"> <span class="d-none"> loading ......</span> Submit</button>
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
              <h5 class="modal-title" id="editModalLabel">Edit Campaign</h5>
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
    $(function camping(){
      var table=$('.ytable').DataTable({
        processing: true,
            serverSide: true,
            ajax: "{{ route('campaing.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'start_date', name: 'start_date' },
                { data: 'title', name: 'title' },
                // { data: 'image', name: 'image', render:function(data, type, full,meta){
                //   return "<img src=\"" +data+ "\" height=\"30\" />";
                // } },
                { data: 'image', name: 'image' },
                { data: 'discount', name: 'discount' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: true, searchable: true }
            ]
      });
    });
// For Edit Child Category
    $('body').on('click', '.edit', function() {
        let id = $(this).data('id');
        $.get("campaing/" + id + "/edit", function(data) {
          $('.modal-body').html(data);
          
            
        });
    });
  </script>
  
@endsection