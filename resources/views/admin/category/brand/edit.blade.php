<!-- edit.blade.php -->
<form id="editForm" method="post" action="{{ route('brand.update', $brand->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="brand_name">Brand Name <sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $brand->brand_name }}" required>
        </div>
        <div class="form-group">
            <label for="brand_logo" class="col-form-label pt-0">Current Brand Logo</label>
            <br>
            @if($brand->brand_logo)
            <img src="{{ asset($brand->brand_logo) }}" alt="Brand Logo" class="img-fluid" style="max-width: 100px;">
            @else
            <p>No logo uploaded.</p>
            @endif
        </div>
        <div class="form-group">
            <label for="brand_logo" class="col-form-label pt-0">Brand Logo</label>
            <input type="file" class="dropify" data-height="200" name="brand_logo">
            <small id="emailHelp" class="form-text text-muted">Upload a new Brand Logo if needed.</small>
        </div>
        <div class="form-group">
            <label for="brand_logo" class="col-form-label pt-0">Home Page Show <sup class="text-size-20 top-1">*</sup></label>
            <select class="form-control" name="front_page">
              <option value="1" {{ $brand->front_page == 1 ? 'selected' : '' }}>Yes</option>
              <option value="0" {{ $brand->front_page == 0 ? 'selected' : '' }}>No</option>
            </select>
            <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home page</small>
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form> 
<script src="{{asset('/')}}admin/assets/fileuploads/js/fileupload.js"></script>
<script src="{{asset('/')}}admin/assets/fileuploads/js/file-upload.js"></script>