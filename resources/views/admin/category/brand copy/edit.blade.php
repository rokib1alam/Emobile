<!-- edit.blade.php -->
<form id="editForm" method="post" action="{{ route('article.update', $article->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="e_title" class="col-form-label pt-0">Title <sup class="text-size-20 top-1">*</sup></label>
                <input type="text" class="form-control" id="e_title" value="{{$article->title}}" name="title" required>
            </div>
            <div class="form-group col-md-6">
                <label for="e_category_id" class="col-form-label pt-0">Category <sup class="text-size-20 top-1">*</sup></label>
                <select class="form-control" id="e_category_id" name="category_id" required>
                    @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="e_excerpt" class="col-form-label pt-0">Excerpt <sup class="text-size-20 top-1">*</sup></label>
                <textarea class="form-control" id="e_excerpt" name="excerpt"  required>{{ $article->excerpt }}</textarea>
            </div>
            <div class="form-group">
                <label for="e_content" class="col-form-label pt-0">Content <sup class="text-size-20 top-1">*</sup></label>
                <textarea class="form-control" id="e_content" name="content" required>{{$article->content}}</textarea>
            </div>
            <div class="form-group">
                    <label for="image" class="col-form-label pt-0">Current Image</label>
                    <br>
                    @if($article->image)
                    <img src="{{ asset($article->image) }}" alt="img" class="img-fluid" style="max-width: 100px;">
                    @else
                    <p>No logo uploaded.</p>
                    @endif
                </div>
            <div class="form-group">
                <label for="e_image" class="col-form-label pt-0">Image <sup class="text-size-20 top-1">*</sup></label>
                <input type="file" class="dropify" id="e_image" name="image">
                <img id="existing_image" src="" width="100" alt="Existing Image">
            </div>
            <div class="form-group">
                <label for="e_published_at" class="col-form-label pt-0">Published At</label>
                <input type="datetime-local" class="form-control" id="e_published_at" name="published_at" value="{{$article->published_at}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
      </div>
    </div>
</form> 
<script src="{{asset('/')}}admin/assets/fileuploads/js/fileupload.js"></script>
<script src="{{asset('/')}}admin/assets/fileuploads/js/file-upload.js"></script>