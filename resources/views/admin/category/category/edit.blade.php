<form id="editForm" method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="category_name" class="col-form-label pt-0">Category Name <sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
    </div>

    <div class="form-group">
        <label class="col-form-label pt-0">Current Category Image</label>
        <br>
        @if($category->category_image && file_exists($category->category_image))
            <img src="{{ asset($category->category_image) }}" alt="Category Image" class="img-fluid mb-2" style="max-width: 100px;">
        @else
            <p class="text-muted">No image uploaded.</p>
        @endif
    </div>

    <div class="form-group">
        <label for="category_image" class="col-form-label pt-0">Category Image</label>
        <input type="file" class="dropify" data-height="200" name="category_image">
        <small class="form-text text-muted">Upload a Category image if needed.</small>
    </div>

    <div class="form-group">
        <label for="icon" class="col-form-label pt-0">Icon <sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="icon" name="icon" value="{{ $category->icon }}" required>
    </div>

    <div class="form-group">
        <label for="home_page" class="col-form-label pt-0">Home Page <sup class="text-size-20 top-1">*</sup></label>
        <select class="form-control" id="home_page" name="home_page">
            <option value="1" {{ $category->home_page == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ $category->home_page == 0 ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>