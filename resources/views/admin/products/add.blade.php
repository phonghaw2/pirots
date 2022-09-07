@extends('admin.layouts.master')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')


<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Add a new product</h1>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h2 class="m-0">Please fill out the information completely</h2>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form action="{{ route('admin.products.store') }}" method="post" id="add-product-form" class="form-horizontal col-lg-12 mb-5 d-flex" enctype="multipart/form-data">
                            @csrf
                            <div class="col-4">
                                <div class="upload-file px-5">
                                    <label for="feature_image" class="upload-file-label">
                                        <i class='bx bx-image-add'></i>
                                        Image
                                    </label>
                                    <input type="file" name="feature_image" id="feature_image"
                                            oninput = "pic.src= window.URL.createObjectURL(this.files[0])">
                                    <img id="pic" width="100%" >
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row mb-3">
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
                                        <select class="form-select" id="select-ChildCate" name="category_id"></select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label class="form-label" for="product-name">Name</label>
                                        <input type="text" class="form-control" id="product-name"  name="name" value="">
                                    </div>
                                    <div class=" col-md-6">
                                        <label class="form-label" for="product-price">Price</label>
                                        <input type="number" class="form-control" id="product-price" name="price" step="0.01">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="product-color">Color</label>
                                    <input type="text" class="form-control" id="product-color" name="color">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="product-size">Size</label>
                                    <input type="text" class="form-control" id="product-size" name="size">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" maxlength="500" rows="3" name="description" id="product-description" placeholder="Description : " width="100%"></textarea>
                                </div>
                                <input type="hidden" class="form-control" id="product-status" name="status" value="1">
                                <button type="submit" class="btn btn-primary">Add product</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.products.add-cate-modal')
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>
<script>
    function generateSlug(makeSlug) {
            $.ajax({
                type: "POST",
                url: '{{ route('api.cate.slug.generate') }}',
                data: { makeSlug },
                dataType: 'json',
                success: function (response) {
                    $('#slug-cate').val(response.data.slug);
                    $('#slug-cate').trigger('change');
                }
            });
        };
    function GetCateById(id , name ,tags) {
        $(`#select-${name}Cate`).select2({
            tags : tags ,
            ajax: {
                url: '{{ route('api.categories') }}',
                data: function (params) {
                    var query = {
                        q: params.term,
                        parent_id : id
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (index, each) {
                            return {
                                text: each,
                                id: index
                            }
                        })
                    };
                }
            },
        });
    }
    $(document).ready(function () {
        $('#select-MainCate').select2({
            ajax: {
                url: '{{ route('api.cate.main') }}',
                data: function (params) {
                    var query = {
                        q: params.term,
                    };
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (index, each) {
                            return {
                                text: each,
                                id: index
                            }
                        })
                    };
                }
            },
        });

        $('#select-SubCate').select2();
        $('#select-ChildCate').select2();

        $('#select-MainCate').change(function () {
            const CateId = $(this).val();
            if (CateId) {
                GetCateById(CateId , 'Sub' , );
            }
        });

        $('#select-SubCate').change(function () {
            const CateId = $(this).val();
            if (CateId) {
                GetCateById(CateId , 'Child' , 'true');
            }
        });

        $('#select-ChildCate').change(function () {
            $.ajax({
                type: 'GET',
                url: "{{ route('api.cate.checkExists') }}/" + $('#select-ChildCate option:selected').text(),
                dataType: 'json',
                success: function (response) {
                    if(!response.data) {
                        let id = $('#select-SubCate').val();
                        Swal.fire({
                            title: 'Category does not exist',
                            text: "Add New Category ?",
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Add it!'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $('.box-lightbox').addClass('open');
                                $('#id-cate').val(id);
                            } else {
                                $('#select-ChildCate').empty();
                            }
                        });
                    }
                }
            });
        });

        $('.js-lightbox-close').click(function (e) {
            $('.box-lightbox').removeClass('open');

        });

        $(document).on('change', '#name-cate', function () {
                let makeSlug = $(this).val();
                generateSlug(makeSlug);
        });

        $('#slug-cate').change(function () {

            $.ajax({
                type: "GET",
                url: '{{  route('api.cate.slug.check') }}',
                data: { slug: $(this).val() },
                dataType: 'json',
                success: function (response) {
                    $('#addChildCate').attr('disabled', false);
                }
            });

        });
        $('#add-product-form').submit(function (e) {
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
                        $('.box-lightbox').removeClass('open');
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
