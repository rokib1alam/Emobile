@extends('layouts.admin')
@section('title','Product')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Product</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <a href="{{route('product.create')}}" class="breadcrumb">
                            <button class="btn btn-primary" >+ Add New</button>
                        </a>
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
              <h5>All Product list here</h5>
            </div><br>
            {{-- For Category --}}
            <div class="card-body row">
              <div class="form-group col-3">
                <label for="">Category</label>
                <select name="category_id" id="category_id" class="form-control submitable">
                  <option value="">All</option>
                  @foreach ($categories as $category )
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                  @endforeach
                </select>
              </div>
              {{-- For Brand --}}
              <div class="form-group col-3">
                <label for="">Brand</label>
                <select name="brand_id" id="brand_id" class="form-control submitable">
                  <option value="">All</option>
                  @foreach ($brands as $brand )
                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                  @endforeach
                </select>
              </div>
              {{-- For Warehouse --}}
              <div class="form-group col-3">
                <label for="">Warehouse</label>
                <select name="warehouse" id="warehouse" class="form-control submitable">
                  <option value="">All</option>
                  @foreach ($warehouses as $warehouse )
                    <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}</option>
                  @endforeach
                </select>
              </div>
              {{-- For Status --}}
              <div class="form-group col-3">
                <label for="">Status</label>
                <select name="status" id="status" class="form-control submitable">
                  <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="" class="table table-striped table-bordered nowrap table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Subcategory</th>
                      <th>Brand</th>
                      <th>Featured</th>
                      <th>Today Deal</th>
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
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Category</th>
                      <th>Subcategory</th>
                      <th>Brand</th>
                      <th>Featured</th>
                      <th>Today Deal</th>
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

  <!-- Script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript">
  $(function products(){
      table=$('.ytable').DataTable({
        processing: true,
        serverSide: true,
        searching:true,
        ajax: {
            url:"{{route('product.index')}}",
            data:function (e){
              e.category_id=$("#category_id").val();              
              e.brand_id=$("#brand_id").val();              
              e.status=$("#status").val();              
              e.warehouse=$("#warehouse").val();              
            }
          },
          columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'thumbnail', name: 'thumbnail' },
                { data: 'product_name', name: 'product_name' },
                { data: 'product_code', name: 'product_code' },
                { data: 'category_name', name: 'category_name' },
                { data: 'subcategory_name', name: 'subcategory_name' },
                { data: 'brand_name', name: 'brand_name' },  
                { data: 'featured', name: 'featured' },  
                { data: 'today_deal', name: 'today_deal' },  
                { data: 'status', name: 'status' },  
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
      });

      // Deactive Featured
      $('body').on('click', '.deactive_featurd', function(e) {
        e.preventDefault();
          var id = $(this).data('id');
          var url = "{{ url('/product/not-featured') }}/" + id; // Assuming your route is correctly defined
          $.ajax({
              url: url,
              type: 'GET',
              success: function(data) {
                  toastr.success('Product is no longer featured.');
                  table.ajax.reload(); // Reload DataTable on success
              },
              error: function(xhr) {
                  toastr.error('Failed to update feature status.');
              }
          });
      });
    // Active Featured
      $('body').on('click', '.active_featurd', function(e) {
        e.preventDefault();
          var id = $(this).data('id');
          var url = "{{ url('/product/active-featured') }}/" + id; // Assuming your route is correctly defined
          $.ajax({
              url: url,
              type: 'GET',
              success: function(data) {
                  toastr.success('Product Featured Active.');
                  table.ajax.reload(); // Reload DataTable on success
              },
              error: function(xhr) {
                  toastr.error('Failed to update feature status.');
              }
          });
      });
    // Deactive Deal
      $('body').on('click', '.deactive_deal', function(e) {
        e.preventDefault();
          var id = $(this).data('id');
          var url = "{{ url('/product/not-deal') }}/" + id; // Assuming your route is correctly defined
          $.ajax({
              url: url,
              type: 'GET',
              success: function(data) {
                  toastr.success('Product is no longer featured.');
                  table.ajax.reload(); // Reload DataTable on success
              },
              error: function(xhr) {
                  toastr.error('Failed to update feature status.');
              }
          });
      });
    // Active Deal
      $('body').on('click', '.active_deal', function(e) {
        e.preventDefault();
          var id = $(this).data('id');
          var url = "{{ url('/product/active-deal') }}/" + id; // Assuming your route is correctly defined
          $.ajax({
              url: url,
              type: 'GET',
              success: function(data) {
                  toastr.success('Product Deal Active.');
                  table.ajax.reload(); // Reload DataTable on success
              },
              error: function(xhr) {
                  toastr.error('Failed to update Deal.');
              }
          });
      });
    // Deactive Status
      $('body').on('click', '.deactive_status', function(e) {
        e.preventDefault();
          var id = $(this).data('id');
          var url = "{{ url('/product/not-status') }}/" + id; // Assuming your route is correctly defined
          $.ajax({
              url: url,
              type: 'GET',
              success: function(data) {
                  toastr.success('Product is no longer featured.');
                  table.ajax.reload(); // Reload DataTable on success
              },
              error: function(xhr) {
                  toastr.error('Failed to update feature status.');
              }
          });
      });
    // Active Featured
      $('body').on('click', '.active_status', function(e) {
        e.preventDefault();
          var id = $(this).data('id');
          var url = "{{ url('/product/active-status') }}/" + id; // Assuming your route is correctly defined
          $.ajax({
              url: url,
              type: 'GET',
              success: function(data) {
                  toastr.success('Product Status Active.');
                  table.ajax.reload(); // Reload DataTable on success
              },
              error: function(xhr) {
                  toastr.error('Failed to update status.');
              }
          });
      });

    // Delete Product 
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
                      url: 'product/' + id,
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
                              'There was an error deleting the product.',
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
    //Submitable class call for every change
  $(document).on('change','.submitable',function(){
    $('.ytable').DataTable().ajax.reload();
  });
  </script>
  
@endsection