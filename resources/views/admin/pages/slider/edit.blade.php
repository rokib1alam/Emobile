<form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group mb-3">
        <label for="heading_text" class="col-form-label pt-0">Heading Text<sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" name="heading_text" value="{{ $slider->heading_text }}" required>
    </div>
    
    <div class="form-group mb-3">
        <label for="caption_text" class="col-form-label pt-0">Caption Text<sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" name="caption_text" value="{{ $slider->caption_text }}" required>
    </div>

    <!-- Current Media Previews -->
    <div class="form-group">
            <label for="brand_logo" class="col-form-label pt-0">Current Imge</label>
            <br>
            @if($slider->image_url)
            <img src="{{ asset($slider->image_url) }}" alt="Brand Logo" class="img-fluid" style="max-width: 100px;">
            @else
            <p>No Image uploaded.</p>
            @endif
    </div>
        <div class="form-group">
            <label for="image_url" class="col-form-label pt-0">Image</label>
            <input type="file" class="dropify" data-height="200" name="image_url">
            <small id="emailHelp" class="form-text text-muted">Upload a Image file (jpeg, png, jpg, gif, svg)</small>
        </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Changes</button>
    </div>
</form>