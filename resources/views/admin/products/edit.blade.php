@extends('admin.layouts.master')
@push('css')

@endpush
@section('content')


<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Edit product</h1>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h2 class="m-0">Just do it!</h2>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form action="{{ route('admin.products.update',$product->id) }}" method="post" id="edit-product-form" class="form-horizontal col-lg-12 mb-5 d-flex" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="col-4">
                                <div class="upload-file px-5">
                                    <img src="{{ asset('img/products/'.$product->feature_image) }}" width="100%" id='old-image'>
                                    <label for="feature_image" class="upload-file-label">
                                        <i class='bx bx-image-add'></i>
                                        Change image
                                    </label>
                                    <input type="file" name="feature_image" id="feature_image"
                                            oninput = "pic.src= window.URL.createObjectURL(this.files[0])">
                                    <img id="pic" width="100%" >
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row mb-3">
                                    <div class="row">
                                        <h3 class="product-category col-md-4">{{ $product->category->name }}</h3>
                                        <button type="button" class="btn btn-outline-dark mb-3 col-md-3" id="trigger-change"> Change Category</button>
                                    </div>
                                    <div class="change-category row">
                                        <div class="col-md-3">
                                            <label class="form-label" for="select-MainCate">Main Category</label>
                                            <select class="form-select" id="select-MainCate" ></select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="select-SubCate">Sub Category</label>
                                            <select class="form-select" id="select-SubCate" ></select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label" for="select-ChildCate">Child Category</label>
                                            <select class="form-select" id="select-ChildCate" name="category_id" disabled></select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="form-label" for="product-name">Name</label>
                                        <input type="text" class="form-control" id="product-name"  name="name" value="{{ $product->name }}">
                                    </div>
                                    <div class=" col-md-6">
                                        <label class="form-label" for="product-price">Price</label>
                                        <input type="number" class="form-control" id="product-price" name="price" step="0.01" value="{{ $product->price }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="product-color">Color</label>
                                    <input type="text" class="form-control" id="product-color" name="color" value="{{ $product->color }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="product-size">Size</label>
                                    <input type="text" class="form-control" id="product-size" name="size" value="{{ $product->size }}">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" maxlength="500" rows="3" name="description" id="product-description" placeholder="Description : " width="100%">
                                       {{ $product->description }}
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
<script>
    function GetCateById(id ,name) {
        $(`#select-${name}Cate`).empty();
        $(`#select-${name}Cate`).append(`<option>Choose...</option>`);
        $.ajax({
            async: false,
            type: "GET",
            url: '{{  route('api.categories') }}',
            data: { parent_id: id },
            dataType: 'json',
            success: function (response) {
                $.each(response.data, function(index, each){
                    $(`#select-${name}Cate`).append(`
                            <option value="${each}">
                                ${index}
                            </option>
                    `);
                })
            }
        });
    };
    $(document).ready(function () {
        $('#trigger-change').click(function () {
            $('.change-category').addClass('active');
            $('#select-MainCate').empty();
            $('#select-MainCate').append(`<option>Choose...</option>`);
                $.ajax({
                url: '{{ route('api.cate.main') }}',
                dataType: 'json',
                success: function (response) {
                    $.each(response.data, function(index, each){
                        $('#select-MainCate').append(`
                                <option value="${each}">
                                    ${index}
                                </option>
                        `);
                    })
                }
                });
        });
        $('#select-MainCate').change(function () {
            const CateId = $(this).val();
            if (CateId) {
                GetCateById(CateId , 'Sub' );
            }
        });
        $('#select-SubCate').change(function () {
            const CateId = $(this).val();
            if (CateId) {
                $('#select-ChildCate').attr('disabled', false);
                GetCateById(CateId , 'Child' );
            }
        });
        $('.upload-file-label').click(function () {
            $('#old-image').hide();
        });
        $('#edit-product-form').submit(function (e) {
            e.preventDefault();
                var form = $(this);
                var actionUrl = form.attr('action');
                var formData = new FormData($(form)[0]);
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: formData,
                    dataType: 'json',
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: "Successfully!",
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.location.reload(true);
                            };
                        });
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.responseJSON.message,

                        });
                    }
                });
            });
    });
</script>
@endpush

