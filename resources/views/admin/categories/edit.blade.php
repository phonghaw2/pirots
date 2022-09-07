@extends('admin.layouts.master')
@section('content')


<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Edit Categories</h1>
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
                        @foreach ($categories as $category)
                            <div class="edit-category">
                                <button class="main-cate-btn">
                                    {{ $category->name }}
                                </button>
                                <span class="countMain">(Sub-category: {{ $category->countCate($category->id) }}) </span>
                                <a class="edit-btn" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                    <i class='bx bx-edit' ></i>
                                </a>
                                <ul class="mx-5 sub-cate-list ">
                                    @foreach ($category->children as $subCate)
                                        <div>
                                            <li class="btn btn-outline-secondary rounded-pill mb-3 sub-cate-btn">
                                                {{ $subCate->name }}
                                            </li>
                                            <span class="countMain">(Child-category: {{ $subCate->countCate($subCate->id) }}) </span>
                                            <a class="edit-btn" data-id="{{ $subCate->id }}" data-name="{{ $subCate->name }}">
                                                <i class='bx bx-edit' ></i>
                                            </a>
                                            <ul class="mx-5 child-cate-list">
                                                @foreach ($subCate->children  as $child)
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 382.975 382.975" style="enable-background:new 0 0 382.975 382.975;" xml:space="preserve">
                                                        <polygon points="358.098,296.762 271.885,210.548 271.885,282.008 54.877,282.008 54.877,0 24.877,0 24.877,312.008   271.885,312.008 271.885,382.975 "/>
                                                    </svg>
                                                    <li class="btn btn-warning rounded-pill mb-3">
                                                        {{ $child->name }}
                                                    </li>
                                                    <a class="edit-btn" data-id="{{ $child->id }}" data-name="{{ $child->name }}">
                                                        <i class='bx bx-edit' ></i>
                                                    </a>
                                                </div>

                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.categories.edit-modal')
@endsection
@push('js')
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
    $(document).ready(function () {
        $('.main-cate-btn').click(function (e) {
            $(this).closest('.edit-category').find('.sub-cate-list').toggleClass('active');
        });

        $('.sub-cate-btn').click(function (e) {
            $(this).closest('div').find('.child-cate-list').toggleClass('active');
        });

        $('.edit-btn').click(function (e) {
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('.box-lightbox').addClass('open');
            $('#name-cate').attr('placeholder', name);
            $('#id-cate').val(id);
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
                    $('#updateCategory').attr('disabled', false);
                }
            });

        });
        $('#edit-cate-form').submit(function (e) {
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
                            title: "Change Saved",
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
