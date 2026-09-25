<!-- edit.blade.php -->
<form id="editForm" method="post" action="{{ route('campaing.update', $campaing->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="title" class="col-form-label pt-0">Campaing Title <sup class="text-size-20 top-1">*</sup></label>
              <input type="text" class="form-control" id="title" name="title" value="{{ $campaing->title }}" required>
              <small id="emailHelp" class="form-text text-muted">This is campaing title/name</small>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <label for="start_date" class="col-form-label pt-0">Start Date <sup class="text-size-20 top-1">*</sup></label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $campaing->start_date }}" required>
            </div>
         
          <div class="col-lg-6">
            <label for="end_date" class="col-form-label pt-0">End Date <sup class="text-size-20 top-1">*</sup></label>
              <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $campaing->end_date }}" required>
          </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <label for="status" class="col-form-label pt-0">Status <sup class="text-size-20 top-1">*</sup></label>
                <select class="form-control" id="status" name="status">
                  <option value="1" {{ $campaing->status == 1 ? 'selected' : '' }}>Active</option>
                  <option value="0" {{ $campaing->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-lg-6">
              <label for="discount" class="col-form-label pt-0">Discount (%)<sup class="text-size-20 top-1">*</sup></label>
                <input type="text" class="form-control" id="discount" name="discount"  value="{{ $campaing->discount }}" required>
                <small id="emailHelp" class="form-text text-danger">Discount parcentage are apply for all product selling price</small>
            </div>
          </div>
          <div class="form-group">
            <label for="brand_logo" class="col-form-label pt-0">Current campaing banner</label>
            <br>
            @if($campaing->image)
            <img src="{{ asset($campaing->image) }}" alt="Brand Logo" class="img-fluid" style="max-width: 100px;">
            @else
            <p>No logo uploaded.</p>
            @endif
          </div>
          <div class="form-group">
            <label for="image" class="col-form-label pt-0">Image</label>
            <input type="file" class="dropify" data-height="200" name="image">
            <small id="emailHelp" class="form-text text-muted">This is your campaing banner.</small>
          </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
<script src="{{asset('/')}}admin/assets/fileuploads/js/fileupload.js"></script>
<script src="{{asset('/')}}admin/assets/fileuploads/js/file-upload.js"></script>
