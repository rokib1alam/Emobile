<form id="editForm" method="post" action="{{ route('ads.update', $ads->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="modal-body">
        <div class="row">

            <!-- Category ID -->
            <div class="form-group col-md-6 mb-3">
                <label for="e_category_id" class="col-form-label pt-0">Category <sup class="text-danger">*</sup></label>
                <select class="form-control" id="e_category_id" name="category_id" required>
                    <option value="" disabled>-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $ads->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name ?? $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Banner Position -->
            <div class="form-group col-md-6 mb-3">
                <label for="e_banner_position" class="col-form-label pt-0">Banner Position <sup class="text-danger">*</sup></label>
                <select class="form-control" id="e_banner_position" name="banner_position" required>
                    <option value="1" {{ $ads->banner_position == '1' ? 'selected' : '' }}>Banner 1 (Top Banner)</option>
                    <option value="2" {{ $ads->banner_position == '2' ? 'selected' : '' }}>Banner 2 (Bottom Banner)</option>
                </select>
            </div>

            <!-- Title -->
            <div class="form-group col-md-6 mb-3">
                <label for="e_title" class="col-form-label pt-0">Title</label>
                <input type="text" class="form-control" id="e_title" value="{{ $ads->title }}" name="title" placeholder="Title">
            </div>

            <!-- Discount Text -->
            <div class="form-group col-md-6 mb-3">
                <label for="e_discount_text" class="col-form-label pt-0">Discount Text</label>
                <input type="text" class="form-control" id="e_discount_text" value="{{ $ads->discount_text }}" name="discount_text" placeholder="Discount Text">
            </div>

            <!-- Link -->
            <div class="form-group col-md-12 mb-3">
                <label for="e_link" class="col-form-label pt-0">Custom Link (Optional)</label>
                <input type="url" class="form-control" id="e_link" value="{{ $ads->link }}" name="link" placeholder="https://example.com">
            </div>

            <!-- Current Image -->
            <div class="form-group col-md-12 mb-3">
                <label class="col-form-label pt-0 d-block">Current Image</label>
                @if($ads->image && file_exists(public_path($ads->image)))
                    <img src="{{ asset($ads->image) }}" alt="Current Image" class="img-fluid rounded border" style="max-width: 120px;">
                @else
                    <span class="badge bg-light-warning text-warning">No Image Uploaded</span>
                @endif
            </div>

            <!-- Image Upload -->
            <div class="form-group col-md-12 mb-3">
                <label for="e_image" class="col-form-label pt-0">Change Image (Optional)</label>
                <input type="file" class="form-control dropify" id="e_image" name="image">
            </div>

        </div>
    </div>

    <div class="modal-footer px-0 pb-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Ads</button>
    </div>
</form>

<script src="{{ asset('/') }}admin/assets/fileuploads/js/fileupload.js"></script>
<script src="{{ asset('/') }}admin/assets/fileuploads/js/file-upload.js"></script>