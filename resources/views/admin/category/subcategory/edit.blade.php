{{-- <form id="editForm" method="post">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="category_name" class="col-form-label pt-0">Category Name <sup class="text-size-20 top-1">*</sup></label>
            <select class="form-control" name="category_id" id="" required>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="subcategory_name" class="col-form-label pt-0">Subcategory Name <sup class="text-size-20 top-1">*</sup></label>
          <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{$subcategories->subcategory_name}}" required>
          <input type="hidden" class="form-control" id="subcategory_id" name="id">
            <small id="emailHelp" class="form-text text-muted">This is your main category</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
</form> --}}

<form id="editForm" method="post" action="{{ route('subcategory.update', $subcategory->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="category_name" class="col-form-label pt-0">Category Name <sup class="text-size-20 top-1">*</sup></label>
        <select class="form-control" name="category_id" id="" required>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{$category->category_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="subcategory_name" class="col-form-label pt-0">Subcategory Name <sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{ $subcategory->subcategory_name }}" required>
        <input type="hidden" class="form-control" id="subcategory_id" name="id" value="{{ $subcategory->id }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>