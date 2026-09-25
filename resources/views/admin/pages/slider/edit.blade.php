<form action="{{ route('slider.update', $slider->id) }}" method="post" id="edit-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="heading_text" class="col-form-label pt-0">Heading Text<sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="heading_text" name="heading_text" value="{{ $slider->heading_text }}" required>
            <small id="headingHelp" class="form-text text-muted">This is your Slider Heading Text</small>
        </div>

        <div class="form-group">
            <label for="caption_text" class="col-form-label pt-0">Caption Text<sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="caption_text" name="caption_text" value="{{ $slider->caption_text }}" required>
            <small id="captionHelp" class="form-text text-muted">This is your Slider Caption Text</small>
        </div>

        <div class="form-group">
            <label for="current_video" class="col-form-label pt-0">Current Video</label>
            <br>
            @if($slider->video_url)
                <video controls width="200">
                    <source src="{{ asset($slider->video_url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @else
                <p>No video uploaded.</p>
            @endif
        </div>

        <div class="col-md-12">
            <label for="video_url" class="col-form-label pt-0">Upload New Video (Optional)</label>
            <input type="file" class="form-control" name="video_url" accept="video/*">
            <small id="videoHelp" class="form-text text-muted">You can upload a new video for the slider (Optional)</small>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update Slider</button>
        </div>
    </div>
</form>

{{-- For file upload script --}}
<script src="{{ asset('/') }}admin/assets/fileuploads/js/fileupload.js"></script>
<script src="{{ asset('/') }}admin/assets/fileuploads/js/file-upload.js"></script>
