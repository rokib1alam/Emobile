<form action="{{ route('fact.update', $fact->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="icon_class">Icon Class</label>
        <input type="text" class="form-control" name="icon_class" value="{{ $fact->icon_class }}" required>
    </div>

    <div class="form-group">
        <label for="count_number">Count Number</label>
        <input type="text" class="form-control" name="count_number" value="{{ $fact->count_number }}" required>
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $fact->title }}" required>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
