<form action="{{ route('about.update', $about->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="subheading" class="col-form-label pt-0">Subheading<sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="subheading" name="subheading" value="{{ $about->subheading }}" required>
            <small class="form-text text-muted">This is your About Subheading </small>
        </div>

        <div class="form-group">
            <label for="heading" class="col-form-label pt-0">Heading<sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="heading" name="heading" value="{{ $about->heading }}" required>
            <small class="form-text text-muted">This is your About Heading</small>
        </div>

        <div class="form-group">
            <label for="paragraph_1" class="col-form-label pt-0">Paragraph 1</label>
            <textarea class="form-control" name="paragraph_1" rows="3" required>{{ $about->paragraph_1 }}</textarea>
        </div>

        <div class="form-group">
            <label for="paragraph_2" class="col-form-label pt-0">Paragraph 2</label>
            <textarea class="form-control" name="paragraph_2" rows="3" required>{{ $about->paragraph_2 }}</textarea>
        </div>

        <div class="form-group">
            <label for="current_image" class="col-form-label pt-0">Current Image</label><br>
            @if($about->image)
                <img src="{{ asset($about->image) }}" width="200" alt="Current Image">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="image" class="col-form-label pt-0">Upload New Image (Optional)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
            <small class="form-text text-muted">You can upload a new image (Optional)</small>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update About</button>
        </div>
    </div>
</form>

{{-- Optional File Upload JS (if you're using plugin for file uploads) --}}
<script src="{{ asset('/') }}admin/assets/fileuploads/js/fileupload.js"></script>
<script src="{{ asset('/') }}admin/assets/fileuploads/js/file-upload.js"></script>
