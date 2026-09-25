@extends('layouts.admin')
@section('title','Pickup_points')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Pickup Point</h5>
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
              <h5>Pickup Point list here</h5>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table class="table table-striped table-bordered nowrap table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Pickup Point</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Another Phone</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Data populated by DataTables via AJAX -->
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>SL</th>
                      <th>Pickup Point</th>
                      <th>Address</th>
                      <th>Phone</th>
                      <th>Another Phone</th>
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
                <h5 class="modal-title h4" id="myLargeModalLabel">Add New Pickup Point</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pickuppoint.store') }}" method="post" id="add-form">
              @csrf
              <div class="modal-body">
                  <div class="form-group">
                      <label for="pickup_point_name" class="col-form-label pt-0">Pickup Point <sup class="text-size-20 top-1">*</sup></label>
                      <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name" required placeholder="Pickup Poin Name">
                  </div>
                  <div class="form-group">
                      <label for="pickup_point_address" class="col-form-label pt-0">Address <sup class="text-size-20 top-1">*</sup></label>
                      <input type="text" class="form-control" id="pickup_point_address" name="pickup_point_address" required placeholder="Address">
                  </div>
                  <div class="form-group">
                      <label for="pickup_point_phone" class="col-form-label pt-0">Phone<sup class="text-size-20 top-1">*</sup></label>
                      <input type="text" class="form-control" id="pickup_point_phone" name="pickup_point_phone" required placeholder="Phone">
                  </div>
                  <div class="form-group">
                      <label for="pickup_point_phone_two" class="col-form-label pt-0">Another Phone<sup class="text-size-20 top-1">*</sup></label>
                      <input type="text" class="form-control" id="pickup_point_phone_two" name="pickup_point_phone_two" required placeholder="Another Phone">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">
                          <span class="loading d-none">Loading...</span> Submit
                      </button>
                  </div>
              </div>
            </form>
          
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="edit-Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Pickup Point</h5>
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
    $(function coupon() {
        var table = $('.ytable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pickuppoint.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'pickup_point_name', name: 'pickup_point_name' },
                { data: 'pickup_point_address', name: 'pickup_point_address' },
                { data: 'pickup_point_phone', name: 'pickup_point_phone' },
                { data: 'pickup_point_phone_two', name: 'pickup_point_phone_two' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

        // Edit coupon
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            $.get("pickuppoint/" + id + "/edit", function(data) {
                $('#edit-Modal .modal-body').html(data);
                $('#edit-Modal').modal('show');
            });
        });

        // Submit Edit form via AJAX
        $(document).on('submit', '#edit-form', function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            // Show loading indicator
            $('.loading').removeClass('d-none');
            $.ajax({
                url: url,
                type: 'PUT',
                data: request,
                success: function(data) {
                  if (data.success) {
                        toastr.success('Pickup point updated successfully!');
                        $('#edit-form')[0].reset(); // Reset form fields
                        $('#edit-Modal').modal('hide'); // Close modal
                        $('.loading').addClass('d-none'); // Hide loading indicator
                        table.ajax.reload();
                    }
                },
                error: function(data) {
                    toastr.error('Something went wrong!');
                }
            });
        });

        // Submit Store form via AJAX
        $('#add-form').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            var url = $(this).attr('action'); // Form action URL
            var request = $(this).serialize(); // Serialize form data
            // Show loading indicator
            $('.loading').removeClass('d-none');

            $.ajax({
                url: url,
                type: 'POST',
                data: request,
                success: function(data) {
                    toastr.success('Pickup Point inserted successfully!');
                    $('#add-form')[0].reset(); // Reset form fields
                    $('#addModal').modal('hide'); // Close modal
                    $('.loading').addClass('d-none'); // Hide loading indicator
                    table.ajax.reload();
                }
            });
        });
        // Delete without page load
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'pickuppoint/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                table.ajax.reload();
                                toastr.success(response.message);
                            }
                        },
                        error: function(response) {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the Pickup point.',
                                'error'
                            );
                        }
                    });
                } else {
                    Swal.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'info'
                    );
                }
            });
        });
    });
</script>
@endsection
