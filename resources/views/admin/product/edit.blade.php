@extends('layouts.admin')

@section('title', 'Product Edit')

@section('admin_content')

<div class="pc-container">

    <div class="pc-content">

        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">

                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Update Product</h5>
                        </div>
                    </div>

                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="ph-duotone ph-house"></i>
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">
                                    Home
                                </a>
                            </li>

                            <li class="breadcrumb-item" aria-current="page">
                                Update Product
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ form-element ] start -->

        <form
            action="{{ route('product.update', $product->id) }}"
            method="post"
            id="add-form"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <!-- [ Main Content ] start -->

            <div class="row">

                <!-- ===================================================== -->
                <!-- LEFT SIDE -->
                <!-- ===================================================== -->

                <div class="col-sm-8">

                    <div class="card">

                        <div class="card-header bg-primary">
                            <h5 class="text-light">
                                Update Product
                            </h5>
                        </div>


                        <div class="card-body">

                            <div class="row">


                                <!-- Product Name -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Product Name
                                            <sup class="text-size-20 top-1">*</sup>
                                        </label>

                                        <div class="input-group">

                                            <input
                                                id="product_name"
                                                type="text"
                                                name="product_name"
                                                value="{{ $product->product_name }}"
                                                class="form-control"
                                                required
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Product Code -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Product Code
                                            <sup class="text-size-20 top-1">*</sup>
                                        </label>

                                        <div class="input-group">

                                            <input
                                                id="product_code"
                                                type="text"
                                                name="product_code"
                                                class="form-control"
                                                value="{{ $product->product_code }}"
                                                required
                                                placeholder="Product Code"
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Category / Subcategory -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Category/Subcategory
                                            <sup class="text-size-20 top-1">*</sup>
                                        </label>

                                        <div class="input-group">

                                            <select
                                                class="form-control"
                                                name="subcategory_id"
                                                id="subcategory_id"
                                                required
                                            >

                                                <option disabled>
                                                    ==choose category==
                                                </option>

                                                @foreach ($categories as $category)

                                                    <option
                                                        value="{{ $category->id }}"
                                                        style="color: blue"
                                                        disabled
                                                    >
                                                        {{ $category->category_name }}
                                                    </option>

                                                    @foreach ($subcategories as $subcategory)

                                                        @if ($subcategory->category_id == $category->id)

                                                            <option
                                                                value="{{ $subcategory->id }}"
                                                                {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}
                                                            >
                                                                ---- {{ $subcategory->subcategory_name }}
                                                            </option>

                                                        @endif

                                                    @endforeach

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>


                                <!-- Child Category -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Child Category
                                            <sup class="text-size-20 top-1">*</sup>
                                        </label>

                                        <div class="input-group">

                                            <select
                                                name="childcategory_id"
                                                id="childcategory_id"
                                                class="form-control"
                                            >

                                                <option value="">
                                                    == Select Child Category ==
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>


                                <!-- Brand -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Brand
                                            <sup class="text-size-20 top-1">*</sup>
                                        </label>

                                        <div class="input-group">

                                            <select
                                                name="brand_id"
                                                class="form-control"
                                            >

                                                @foreach ($brands as $brand)

                                                    <option
                                                        value="{{ $brand->id }}"
                                                        {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                    >
                                                        {{ $brand->brand_name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>


                                <!-- Pickup Point -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Pickup Point
                                        </label>

                                        <div class="input-group">

                                            <select
                                                name="pickup_point_id"
                                                class="form-control"
                                            >

                                                @foreach ($pickuppoints as $pickuppoint)

                                                    <option
                                                        value="{{ $pickuppoint->id }}"
                                                        {{ $product->pickup_point_id == $pickuppoint->id ? 'selected' : '' }}
                                                    >
                                                        {{ $pickuppoint->pickup_point_name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>


                                <!-- Unit -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Unit
                                            <sup class="text-size-20 top-1">*</sup>
                                        </label>

                                        <div class="input-group">

                                            <input
                                                type="text"
                                                class="form-control"
                                                name="unit"
                                                value="{{ $product->unit }}"
                                                required
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Tags -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Tags
                                        </label>

                                        <input
                                            type="text"
                                            name="tags"
                                            class="form-control"
                                            value="{{ $product->tags }}"
                                            data-role="tagsinput"
                                        >

                                    </div>

                                </div>


                                <!-- Purchase Price -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Purchase Price
                                        </label>

                                        <div class="input-group">

                                            <input
                                                id="purchase_price"
                                                type="text"
                                                name="purchase_price"
                                                value="{{ $product->purchase_price }}"
                                                class="form-control"
                                                placeholder="Purchase Price"
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Selling Price -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Selling Price
                                            <sup class="text-size-20 top-1">*</sup>
                                        </label>

                                        <div class="input-group">

                                            <input
                                                id="selling_price"
                                                type="text"
                                                name="selling_price"
                                                value="{{ $product->selling_price }}"
                                                class="form-control"
                                                required
                                                placeholder="Selling Price"
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Discount Price -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Discount Price
                                        </label>

                                        <div class="input-group">

                                            <input
                                                id="discount_price"
                                                type="text"
                                                name="discount_price"
                                                value="{{ $product->discount_price }}"
                                                class="form-control"
                                                placeholder="Discount Price"
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Stock -->
                                <div class="col-md-6">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Stock
                                        </label>

                                        <div class="input-group">

                                            <input
                                                id="stock_quantity"
                                                type="text"
                                                name="stock_quantity"
                                                value="{{ $product->stock_quantity }}"
                                                class="form-control"
                                            >

                                        </div>

                                    </div>

                                </div>


                                <!-- Size -->
                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="form-label">
                                            Size
                                        </label>

                                        <input
                                            id="size"
                                            type="text"
                                            name="size"
                                            value="{{ $product->size }}"
                                            class="form-control"
                                            data-role="tagsinput"
                                        >

                                    </div>

                                </div>


                                <!-- Description -->
                                <div class="col-md-12">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Page Details
                                        </label>

                                        <textarea
                                            class="form-control textarea"
                                            name="description"
                                            id="summernote"
                                            rows="4"
                                        >{{ $product->description }}</textarea>

                                    </div>

                                </div>


                                <!-- Video -->
                                <div class="col-md-12">

                                    <div class="mb-3">

                                        <label class="form-label">
                                            Video Embed Code
                                        </label>

                                        <textarea
                                            class="form-control textarea"
                                            name="video"
                                            rows="2"
                                        >{{ $product->video }}</textarea>

                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>

                </div>


                <!-- ===================================================== -->
                <!-- RIGHT SIDE -->
                <!-- ===================================================== -->

                <div class="col-sm-4">

                    <div class="card">

                        <div class="card-body">


                            <!-- ================================================= -->
                            <!-- PRODUCT COLORS -->
                            <!-- ================================================= -->

                            <div class="mb-4">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <h5 class="mb-0">
                                        Product Colors
                                    </h5>

                                    <button
                                        type="button"
                                        id="addColor"
                                        class="btn btn-primary btn-sm"
                                    >
                                        <i class="fa fa-plus"></i>
                                        Add Color
                                    </button>

                                </div>


                                <div id="colorContainer">


                                    @forelse ($product->colors as $index => $productColor)

                                        <div
                                            class="color-box border rounded p-3 mb-3"
                                            data-index="{{ $index }}"
                                        >

                                            <!-- Product Color ID -->
                                            <input
                                                type="hidden"
                                                name="colors[{{ $index }}][id]"
                                                value="{{ $productColor->id }}"
                                            >


                                            <!-- Color Name -->
                                            <div class="mb-3">

                                                <div class="d-flex justify-content-between">

                                                    <label class="form-label">
                                                        Color
                                                    </label>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm remove-color"
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </div>

                                                <input
                                                    type="text"
                                                    name="colors[{{ $index }}][color]"
                                                    value="{{ $productColor->color }}"
                                                    class="form-control"
                                                    placeholder="Example: Black"
                                                    required
                                                >

                                            </div>


                                            <!-- Thumbnail -->
                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Thumbnail
                                                </label>

                                                <input
                                                    type="file"
                                                    accept="image/*"
                                                    name="colors[{{ $index }}][thumbnail]"
                                                    class="form-control color-thumbnail"
                                                >


                                                @if ($productColor->thumbnail)

                                                    <div class="mt-2">

                                                        <img
                                                            src="{{ asset($productColor->thumbnail) }}"
                                                            alt="{{ $productColor->color }}"
                                                            width="120"
                                                            height="120"
                                                            style="object-fit: cover;"
                                                            class="border rounded"
                                                        >

                                                    </div>

                                                @endif

                                            </div>


                                            <!-- Gallery Images -->
                                            <div class="mb-2">

                                                <label class="form-label">
                                                    Gallery Images
                                                </label>

                                                <div
                                                    class="table-responsive"
                                                >

                                                    <table
                                                        class="table table-bordered mb-2 color-image-table"
                                                    >

                                                        <tbody>


                                                            @php

                                                                $colorImages =
                                                                    is_array($productColor->images)
                                                                        ? $productColor->images
                                                                        : json_decode(
                                                                            $productColor->images,
                                                                            true
                                                                        );

                                                            @endphp


                                                            @if (!empty($colorImages))

                                                                @foreach ($colorImages as $image)

                                                                    <tr>

                                                                        <td>

                                                                            <img
                                                                                src="{{ asset($image) }}"
                                                                                alt="Image"
                                                                                width="80"
                                                                                height="80"
                                                                                style="object-fit: cover;"
                                                                                class="border rounded"
                                                                            >

                                                                        </td>

                                                                        <td>

                                                                            <button
                                                                                type="button"
                                                                                class="btn btn-danger btn-sm remove-existing-image"
                                                                            >
                                                                                Remove
                                                                            </button>

                                                                        </td>

                                                                    </tr>

                                                                @endforeach

                                                            @endif


                                                            <tr>

                                                                <td>

                                                                    <input
                                                                        type="file"
                                                                        accept="image/*"
                                                                        name="colors[{{ $index }}][images][]"
                                                                        class="form-control"
                                                                    >

                                                                </td>

                                                                <td style="width:100px;">

                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-primary btn-sm add-image"
                                                                    >
                                                                        Add
                                                                    </button>

                                                                </td>

                                                            </tr>


                                                        </tbody>

                                                    </table>

                                                </div>

                                            </div>


                                        </div>

                                    @empty


                                        <!-- First Color -->

                                        <div
                                            class="color-box border rounded p-3 mb-3"
                                            data-index="0"
                                        >

                                            <div class="mb-3">

                                                <div class="d-flex justify-content-between">

                                                    <label class="form-label">
                                                        Color
                                                    </label>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm remove-color"
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </div>

                                                <input
                                                    type="text"
                                                    name="colors[0][color]"
                                                    class="form-control"
                                                    placeholder="Example: Black"
                                                    required
                                                >

                                            </div>


                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Thumbnail
                                                </label>

                                                <input
                                                    type="file"
                                                    accept="image/*"
                                                    name="colors[0][thumbnail]"
                                                    class="form-control"
                                                >

                                            </div>


                                            <div class="mb-2">

                                                <label class="form-label">
                                                    Gallery Images
                                                </label>

                                                <table
                                                    class="table table-bordered color-image-table"
                                                >

                                                    <tbody>

                                                        <tr>

                                                            <td>

                                                                <input
                                                                    type="file"
                                                                    accept="image/*"
                                                                    name="colors[0][images][]"
                                                                    class="form-control"
                                                                >

                                                            </td>

                                                            <td style="width:100px;">

                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary btn-sm add-image"
                                                                >
                                                                    Add
                                                                </button>

                                                            </td>

                                                        </tr>

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>

                                    @endforelse

                                </div>

                            </div>


                            <!-- ================================================= -->
                            <!-- FEATURED -->
                            <!-- ================================================= -->

                            <div class="card p-4">

                                <h6>
                                    Featured Product
                                </h6>

                                <input
                                    type="checkbox"
                                    name="featured"
                                    id="featured"
                                    value="1"
                                    data-toggle="switchbutton"
                                    {{ $product->featured ? 'checked' : '' }}
                                    data-onstyle="primary"
                                >

                            </div>


                            <!-- ================================================= -->
                            <!-- TODAY DEAL -->
                            <!-- ================================================= -->

                            <div class="card p-4">

                                <h6>
                                    Today Deal
                                </h6>

                                <input
                                    type="checkbox"
                                    name="today_deal"
                                    id="today_deal"
                                    value="1"
                                    data-toggle="switchbutton"
                                    {{ $product->today_deal ? 'checked' : '' }}
                                    data-onstyle="primary"
                                >

                            </div>


                            <!-- ================================================= -->
                            <!-- SLIDER -->
                            <!-- ================================================= -->

                            <div class="card p-4">

                                <h6>
                                    Slider Product
                                </h6>

                                <input
                                    type="checkbox"
                                    name="product_slider"
                                    id="product_slider"
                                    value="1"
                                    data-toggle="switchbutton"
                                    {{ $product->product_slider ? 'checked' : '' }}
                                    data-onstyle="primary"
                                >

                            </div>


                            <!-- ================================================= -->
                            <!-- STATUS -->
                            <!-- ================================================= -->

                            <div class="card p-4">

                                <h6>
                                    Status
                                </h6>

                                <input
                                    type="checkbox"
                                    name="status"
                                    id="status"
                                    value="1"
                                    data-toggle="switchbutton"
                                    {{ $product->status ? 'checked' : '' }}
                                    data-onstyle="primary"
                                >

                            </div>


                        </div>

                    </div>

                </div>


                <!-- Submit -->
                <div class="modal-footer">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Submit
                    </button>

                </div>

            </div>

            <!-- [ Main Content ] end -->

        </form>

        <!-- [ form-element ] end -->

    </div>

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>

$(document).ready(function () {


    /*
    |--------------------------------------------------------------------------
    | Child Category
    |--------------------------------------------------------------------------
    */

    function loadChildCategories(
        subcategoryId,
        selectedChildId = "{{ $product->childcategory_id }}"
    ) {

        if (!subcategoryId) {
            return;
        }

        $.ajax({

            url:
                "{{ url('/get-child-category/') }}/" +
                subcategoryId,

            type: 'GET',

            success: function (data) {

                $('#childcategory_id').empty();

                $('#childcategory_id').append(
                    '<option value="">== Select Child Category ==</option>'
                );

                $.each(
                    data,
                    function (key, item) {

                        $('#childcategory_id').append(

                            '<option value="' +
                            item.id +
                            '"' +
                            (
                                selectedChildId ==
                                item.id
                                    ? ' selected'
                                    : ''
                            ) +
                            '>' +
                            item.childcategory_name +
                            '</option>'

                        );

                    }
                );

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Load Existing Child Category
    |--------------------------------------------------------------------------
    */

    loadChildCategories(
        $('#subcategory_id').val()
    );


    /*
    |--------------------------------------------------------------------------
    | Change Subcategory
    |--------------------------------------------------------------------------
    */

    $('#subcategory_id').change(function () {

        loadChildCategories(
            $(this).val(),
            ''
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Color Index
    |--------------------------------------------------------------------------
    */

    var colorIndex =
        $('#colorContainer .color-box').length;


    /*
    |--------------------------------------------------------------------------
    | Add New Color
    |--------------------------------------------------------------------------
    */

    $('#addColor').click(function () {

        var index =
            colorIndex;

        var html = `

            <div
                class="color-box border rounded p-3 mb-3"
                data-index="${index}"
            >

                <div class="mb-3">

                    <div class="d-flex justify-content-between">

                        <label class="form-label">
                            Color
                        </label>

                        <button
                            type="button"
                            class="btn btn-danger btn-sm remove-color"
                        >
                            <i class="fa fa-trash"></i>
                        </button>

                    </div>

                    <input
                        type="text"
                        name="colors[${index}][color]"
                        class="form-control"
                        placeholder="Example: Black"
                        required
                    >

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Thumbnail
                    </label>

                    <input
                        type="file"
                        accept="image/*"
                        name="colors[${index}][thumbnail]"
                        class="form-control"
                    >

                </div>


                <div class="mb-2">

                    <label class="form-label">
                        Gallery Images
                    </label>

                    <table
                        class="table table-bordered color-image-table"
                    >

                        <tbody>

                            <tr>

                                <td>

                                    <input
                                        type="file"
                                        accept="image/*"
                                        name="colors[${index}][images][]"
                                        class="form-control"
                                    >

                                </td>

                                <td style="width:100px;">

                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm add-image"
                                    >
                                        Add
                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        `;

        $('#colorContainer').append(html);

        colorIndex++;

    });


    /*
    |--------------------------------------------------------------------------
    | Remove Color
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.remove-color',
        function () {

            $(this)
                .closest('.color-box')
                .remove();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Add More Gallery Image
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.add-image',
        function () {

            var table =
                $(this).closest(
                    '.color-image-table'
                );

            var colorBox =
                $(this).closest(
                    '.color-box'
                );

            var index =
                colorBox.data('index');


            var html = `

                <tr>

                    <td>

                        <input
                            type="file"
                            accept="image/*"
                            name="colors[${index}][images][]"
                            class="form-control"
                        >

                    </td>

                    <td>

                        <button
                            type="button"
                            class="btn btn-danger btn-sm remove-new-image"
                        >
                            Remove
                        </button>

                    </td>

                </tr>

            `;

            table.find('tbody').append(html);

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Remove New Gallery Image Input
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.remove-new-image',
        function () {

            $(this)
                .closest('tr')
                .remove();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Remove Existing Gallery Image - UI only
    |--------------------------------------------------------------------------
    */

    $(document).on(
        'click',
        '.remove-existing-image',
        function () {

            $(this)
                .closest('tr')
                .remove();

        }
    );


});

</script>

@endsection
