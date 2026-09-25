<!-- edit.blade.php -->
<form action="{{ route('pickuppoint.update', $pickuppoint->id) }}" method="post" id="edit-form">
  @csrf
  @method('PUT')
  <div class="modal-body">
    <div class="form-group">
        <label for="pickup_point_name" class="col-form-label pt-0">Pickup Point <sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="pickup_point_name" value="{{ $pickuppoint->pickup_point_name }}" name="pickup_point_name" required placeholder="Pickup Poin Name">
    </div>
    <div class="form-group">
        <label for="pickup_point_address" class="col-form-label pt-0">Address <sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="pickup_point_address" value="{{ $pickuppoint->pickup_point_address }}" name="pickup_point_address" required placeholder="Address">
    </div>
    <div class="form-group">
        <label for="pickup_point_phone" class="col-form-label pt-0">Phone<sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="pickup_point_phone" value="{{ $pickuppoint->pickup_point_phone }}" name="pickup_point_phone" required placeholder="Phone">
    </div>
    <div class="form-group">
        <label for="pickup_point_phone_two" class="col-form-label pt-0">Another Phone<sup class="text-size-20 top-1">*</sup></label>
        <input type="text" class="form-control" id="pickup_point_phone_two" value="{{ $pickuppoint->pickup_point_phone_two }}" name="pickup_point_phone_two" required placeholder="Another Phone">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">
            <span class="loading d-none">Loading...</span> Submit
        </button>
    </div>
</div>
</form>
