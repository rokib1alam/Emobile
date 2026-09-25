@extends('layouts.admin')
@section('title','Article')
@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Article</h5>
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
              <h5>All Article list here</h5>
            </div>
            <div class="card-body">
              <div class="dt-responsive table-responsive">
                <table id="" class="table table-striped table-bordered nowrap table-sm ytable">
                  <thead>
                    <tr>
                      <th>SL</th>
                      <th>Title</th>
                      <th>Category Name</th>
                      <th>Excerpt</th>
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
                      <th>Title</th>
                      <th>Category Name</th>
                      <th>Excerpt</th>
                      <th>Image</th>
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
                <h5 class="modal-title h4" id="myLargeModalLabel">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('article.store')}}" method="post" id="add-form" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="form-group col-md-6">
                      <label for="e_title" class="col-form-label pt-0">Title <sup class="text-size-20 top-1">*</sup></label>
                      <input type="text" class="form-control" id="e_title" name="title" required>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="e_category_id" class="col-form-label pt-0">Category <sup class="text-size-20 top-1">*</sup></label>
                      <select class="form-control" id="e_category_id" name="category_id" required>
                          @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="e_excerpt" class="col-form-label pt-0">Excerpt <sup class="text-size-20 top-1">*</sup></label>
                      <textarea class="form-control" id="e_excerpt" name="excerpt" required></textarea>
                  </div>
                  <div class="form-group">
                      <label for="e_content" class="col-form-label pt-0">Content <sup class="text-size-20 top-1">*</sup></label>
                      <textarea class="form-control" id="e_content" name="content" required></textarea>
                  </div>
                  <div class="form-group">
                      <label for="e_image" class="col-form-label pt-0">Image <sup class="text-size-20 top-1">*</sup></label>
                      <input type="file" class="dropify" id="e_image" name="image">
                  </div>
                  <div class="form-group">
                      <label for="e_published_at" class="col-form-label pt-0">Published At</label>
                      <input type="datetime-local" class="form-control" id="e_published_at" name="published_at">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
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
              <h5 class="modal-title" id="editModalLabel">Edit Article</h5>
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
    $(function article(){
      var table=$('.ytable').DataTable({
        processing: true,
            serverSide: true,
            ajax: "{{ route('article.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'title', name: 'title' },
                { data: 'category_name', name: 'category_name' },
                { data: 'content', name: 'content' },
                { data: 'image', name: 'image' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
      });
    });
// For Edit Child Category
    $('body').on('click', '.edit', function() {
        let id = $(this).data('id');
        $.get("article/" + id + "/edit", function(data) {
            $('.modal-body').html(data);
        });
    });

  //dropify image
 
  </script>
  
@endsection