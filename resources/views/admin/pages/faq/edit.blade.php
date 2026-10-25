<form action="{{ route('faq.update', $faq->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit FAQ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="form-group mb-3">
                <label for="question">Question</label>
                <input type="text" class="form-control" name="question" value="{{ $faq->question }}" required>
            </div>
            
            <div class="form-group mb-3">
                <label for="answer">Answer</label>
                <!-- সঠিক নিয়ম: textarea এর মাঝখানে ডেটা দিতে হবে -->
                <textarea class="form-control" name="answer" rows="5" required>{{ $faq->answer }}</textarea>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>           