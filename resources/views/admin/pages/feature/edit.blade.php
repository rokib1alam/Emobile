<form action="{{ route('feature.update', $feature->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="icon_class">Icon Class</label>
        <input type="text" class="form-control" name="icon_class" value="{{ $feature->icon_class }}" required>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $feature->title }}" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" required>{{ $feature->description }}</textarea>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
