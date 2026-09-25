<!-- edit.blade.php -->
<form id="editForm" method="post" action="{{ route('warehouse.update', $warehouse->id) }}">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="form-group">
            <label for="warehouse_name" class="col-form-label pt-0">Warehouse Name <sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" value="{{$warehouse->warehouse_name}}" required placeholder="Warehouse Name">
        </div>
        <div class="form-group">
            <label for="warehouse_address" class="col-form-label pt-0">Warehouse Address <sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" value="{{$warehouse->warehouse_address}}" required placeholder="Warehouse Address">
        </div>
        <div class="form-group">
            <label for="warehouse_phone" class="col-form-label pt-0">Warehouse Phone <sup class="text-size-20 top-1">*</sup></label>
            <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" value="{{$warehouse->warehouse_phone}}" required placeholder="Warehouse Phone">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
