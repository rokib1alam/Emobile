@extends('layouts.admin')
@section('title','Categorie')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Sub Category</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">+ Add New</button>
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
              <h5>All sub-categories list here</h5>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="cbtn-selectors" class="table table-striped table-bordered nowrap table-sm">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Sub Categorie Name</th>
                      <th>Sub Categorie Slug</th>
                      <th>Categorie Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subcategories as $subcategory )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$subcategory->subcategory_name}}</td>
                            <td>{{$subcategory->subcategory_slug}}</td>
                            <td>{{$subcategory->category->category_name}}</td>
                            <td class="d-flex">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm me-1 edit" data-id="{{ $subcategory->id }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm delete" data-id="{{$loop->iteration}}">
                                  <i class="fa fa-trash"></i>
                                </button>
                                <form id="delete-form-{{ $loop->iteration }}" action="{{ route('subcategory.destroy', $subcategory->id) }}" method="POST">
                                  @csrf
                                  @method("DELETE")
                                </form>
                            </td>
                        </tr>
                    @endforeach    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>SL</th>
                      <th>Sub Categorie Name</th>
                      <th>Sub Categorie Slug</th>
                      <th>Categorie Name</th>
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
  <!-- Category Insert Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Add New Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('subcategory.store')}}" method="post">
              @csrf
              <div class="modal-body">
                <div class="form-group">
                  <label for="category_name" class="col-form-label pt-0">Category Name <sup class="text-size-20 top-1">*</sup></label>
                    <select class="form-control" name="category_id" id="" required>
                      @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="subcategory_name" class="col-form-label pt-0">sub Category Name <sup class="text-size-20 top-1">*</sup></label>
                    <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" required>
                    <small id="emailHelp" class="form-text text-muted">This is your sub category</small>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </div>
            </form>
        </div>
    </div>
</div>

  <!-- Category Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title h4" id="myLargeModalLabel">Edit SubCategory</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>              
          <div class="modal-body">

          </div>
      </div>
  </div>
</div>
  <!-- Script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
    $('body').on('click', '.edit', function(){
      let subcat_id = $(this).data('id');
      $.get("subcategory/" + subcat_id + "/edit", function(data){
        $('.modal-body').html(data); 
      });
    });
  </script>
  
@endsection