<form action="{{ route('category.update', $category->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="category_name" class="col-form-label pt-0">Category Name <sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $category->category_name }}" required>
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