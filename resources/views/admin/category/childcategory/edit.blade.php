<!-- edit.blade.php -->
<form id="editForm" method="post" action="{{ route('childcategory.update', $childcategory->id) }}">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="subcategory_id">Category/Subcategory <sup class="text-size-20 top-1">*</sup></label>
            <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @foreach ($subcategories as $subcategory)
                            @if ($subcategory->category_id == $category->id)
                                <option value="{{ $subcategory->id }}" {{ $childcategory->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                    ---- {{ $subcategory->subcategory_name }}
                                </option>
                            @endif
                        @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="childcategory_name">Child Category Name <sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" value="{{ $childcategory->childcategory_name }}" required>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
