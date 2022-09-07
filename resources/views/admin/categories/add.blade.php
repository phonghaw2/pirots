@extends('admin.layouts.master')
@section('content')


<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Create a Categories</h1>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h2 class="m-0">Choose Category</h2>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <div class="btn-category main-category col-md-2">Main Category</div>
                            <div class="line"></div>
                            <div class="btn-category sub-category col-md-2">Sub Category</div>
                            <div class="line"></div>
                            <div class="btn-category child-category col-md-2">Child Category</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.categories.category')
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.28/dist/sweetalert2.all.min.js"></script>

    <script>
        function generateSlug(makeSlug , typeCate) {
            $.ajax({
                type: "POST",
                url: '{{ route('api.cate.slug.generate') }}',
                data: { makeSlug , typeCate },
                dataType: 'json',
                success: function (response) {
                    switch (response.data.typeCate) {
                        case 'main-category':
                            $('#mainSlug').val(response.data.slug);
                            $('#mainSlug').trigger('change');
                            break;
                        case 'sub-category':
                            $('#subSlug').val(response.data.slug);
                            $('#subSlug').trigger('change');
                            break;
                        case 'child-category':
                            $('#childSlug').val(response.data.slug);
                            $('#childSlug').trigger('change');
                            break;
                    }

                }
            });
        };
        $(document).ready(function () {
            $('.main-category').click(function (e) {
                $('.main-category-card').show();
                $('.sub-category-card').hide();
                $('.child-category-card').hide();
            });
            $('.sub-category').click(function (e) {
                $('.main-category-card').hide();
                $('.sub-category-card').show();
                $('.child-category-card').hide();
            });
            $('.child-category').click(function (e) {
                $('.main-category-card').hide();
                $('.sub-category-card').hide();
                $('.child-category-card').show();
            });
            $('.add-cate-form').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var actionUrl = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: "Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        })
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
            $(document).on('change', '#main-category, #sub-category , #child-category ', function () {
                let typeCate = $(this).attr('id');
                let makeSlug = $(this).val();
                generateSlug(makeSlug, typeCate);
            });
            $('#mainSlug').change(function () {

                $.ajax({
                    type: "GET",
                    url: '{{  route('api.cate.slug.check') }}',
                    data: { slug: $(this).val() },
                    dataType: 'json',
                    success: function (response) {
                        $('#main-category-submit').attr('disabled', false);
                    }
                });

            });
            $('#subSlug').change(function () {

                $.ajax({
                    type: "GET",
                    url: '{{  route('api.cate.slug.check') }}',
                    data: { slug: $(this).val() },
                    dataType: 'json',
                    success: function (response) {
                        $('#sub-category-submit').attr('disabled', false);
                    }
                });

            });
            $('#childSlug').change(function () {

                $.ajax({
                    type: "GET",
                    url: '{{  route('api.cate.slug.check') }}',
                    data: { slug: $(this).val() },
                    dataType: 'json',
                    success: function (response) {
                        $('#child-category-submit').attr('disabled', false);
                    }
                });

            });
            $('.select-mainCateId').change(function () {
                $('#select-subCateId').empty()
                const mainCateId = $(this).val();
                if (mainCateId) {
                    $('#select-subCateId').attr('disabled', false);
                    $.ajax({
                    async: false,
                    type: "GET",
                    url: '{{  route('api.categories') }}',
                    data: { parent_id: mainCateId },
                    dataType: 'json',
                    success: function (response) {
                        console.log(response.data);
                        $.each(response.data, function(index, each){
                            $('#select-subCateId').append(`
                                    <option value="${each}">
                                        ${index}
                                    </option>
                            `);
                        })
                    }
                });
                }


            });
        });
    </script>
@endpush
