<form action="{{ route('choose-us.update', $chooseUs->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="icon">Icon</label>
        <input type="text" class="form-control" name="icon" value="{{ $chooseUs->icon }}" required>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $chooseUs->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" required>{{ $chooseUs->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" name="status" required>
            <option value="1" {{ $chooseUs->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $chooseUs->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
