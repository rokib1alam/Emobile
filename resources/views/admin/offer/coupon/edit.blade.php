
<!-- edit.blade.php -->
<form action="{{ route('coupon.update', $coupon->id) }}" method="post" id="edit-form">
  @csrf
  @method('PUT')
  <div class="form-group">
      <label for="coupon_code">Coupon Code</label>
      <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{ $coupon->coupon_code }}" required>
  </div>
  <div class="form-group">
      <label for="type">Coupon Type</label>
      <select name="type" class="form-control">
          <option value="1" {{ $coupon->type == 1 ? 'selected' : '' }}>Fixed</option>
          <option value="2" {{ $coupon->type == 2 ? 'selected' : '' }}>Percentage</option>
      </select>
  </div>
  <div class="form-group">
      <label for="coupon_amount">Amount</label>
      <input type="text" class="form-control" id="coupon_amount" name="coupon_amount" value="{{ $coupon->coupon_amount }}" required>
  </div>
  <div class="form-group">
      <label for="valid_date">Valid Date</label>
      <input type="date" class="form-control" id="valid_date" name="valid_date" value="{{ $coupon->valid_date }}" required>
  </div>
  <div class="form-group">
      <label for="status">Coupon Status</label>
      <select name="status" class="form-control">
          <option value="Active" {{ $coupon->status == 'Active' ? 'selected' : '' }}>Active</option>
          <option value="Inactive" {{ $coupon->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
      </select>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">
          <span class="loading d-none">Loading...</span> Submit
      </button>
  </div>
</form>
