<form action="{{ route('service.update', $service->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="title" class="col-form-label pt-0">Title<sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $service->title }}" required>
            <small class="form-text text-muted">This is your Service Title</small>
        </div>

        <div class="form-group">
            <label for="description" class="col-form-label pt-0">Description<sup class="text-size-20 top-1">*</sup></label>
            <textarea class="form-control" name="description" id="description" rows="3" required>{{ $service->description }}</textarea>
            <small class="form-text text-muted">Short description of the service</small>
        </div>

        <div class="form-group">
            <label for="current_image" class="col-form-label pt-0">Current Image</label><br>
            @if($service->image)
                <img src="{{ asset($service->image) }}" alt="Service Image" style="max-width: 120px;">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label pt-0">Upload New Image (Optional)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
            <small class="form-text text-muted">You can upload a new image for the service (Optional)</small>
        </div>

        <div class="form-group">
            <label for="status" class="col-form-label pt-0">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="1" {{ $service->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $service->status == 0 ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update Service</button>
        </div>
    </div>
</form>

{{-- Optional JS for file upload if needed --}}
<script src="{{ asset('admin/assets/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ asset('admin/assets/fileuploads/js/file-upload.js') }}"></script>
