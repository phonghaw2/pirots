@extends('admin.layouts.master')
@section('content')


<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Products</h1>
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="main-title">
                        <h2 class="m-0">All Products</h2>
                    </div>

                <form  class="form-inline" id="form-filter" style="display:flex">
                    <div class="form-group me-3 col-2">
                        <label for="status">Status</label>
                        <select class="form-control select-filter"name="status" id="status">
                            <option selected>All</option>
                            @foreach ($status as $key => $value)
                            <option value="{{ $value }}"
                            @if ((string)$value == $selectedStatus)
                            selected
                            @endif>
                            {{ $key }}
                        </option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group me-3 col-2">
                        <label for="">Filter by Category</label>
                        <select class="form-control select-category-type" name="select-category-type" id="select-category-type">
                            <option selected>All</option>
                            <option >Main</option>
                            <option >Sub</option>
                            <option >Child</option>
                        </select>
                    </div>
                    <div class="form-group me-3 col-2" id="select-main">
                        <label for="">Main Category</label>
                        <select class="form-control select-filter" name="MainCate" id="MainCate" disabled>
                            <option>Choose...</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if ($category->id == $selectedMainCate)
                                selected
                                @endif>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group me-3 col-2" id="select-sub">
                        <div class="input-group mb-3">
                            <label class="input-group-text" >Main</label>
                            <select class="form-select select-mainCateId" >
                                <option >Choose...</option>
                                @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                @endforeach
                            </select>
                        </div>
                        <label for="SubCate">Sub Category</label>
                        <select class="form-control select-filter SubCate" name="SubCate" id="SubCate" disabled>
                        </select>
                    </div>
                    <div class="form-group me-3 col-2" id="select-child">
                        <div class="input-group mb-3">
                            <label class="input-group-text" >Main</label>
                            <select class="form-select select-mainCateId" >
                                <option >Choose...</option>
                                @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" >Sub</label>
                            <select class="form-control select-subCateId SubCate"  >
                            </select>
                        </div>
                        <label for="ChildCate">Child Category</label>
                        <select class="form-control select-filter" name="ChildCate" id="ChildCate" disabled>
                        </select>
                    </div>
                </form>

                </div>
            <div class="white_card_body">
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $each)
                            <tr>
                                <th scope="row">
                                    <a href="">
                                        {{ $each->id }}
                                    </a>
                                </th>
                                <td>
                                    <img src="{{ asset('img/products/'.$each->feature_image) }}" alt="" height="100">
                                </td>
                                <td>
                                    {{ $each->name }}
                                </td>
                                <td>
                                    {{ $each->category->name }}
                                </td>
                                <td>
                                    {{ $each->status_name }}
                                </td>
                                <td>
                                    <a  class="btn btn-success show-btn" data-id="{{ $each->id }}">
                                        <i class='bx bx-detail'></i>
                                        View
                                    </a>
                                </td>
                                <td>
                                    {{ $each->created_at }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="...">
                        <ul class="pagination pagination-rounded">
                            {{ $data->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('admin.products.modal')
@endsection

@push('js')

<script>
    function selectCateType() {
        const CateType = $('.select-category-type option:selected').val();
        switch (CateType){
            case 'Main':
                $('#select-main').show();
                $('#MainCate').attr('disabled', false);
                $('#select-sub').hide();
                $('#SubCate').attr('disabled', true);
                $('#select-child').hide();
                $('#ChildCate').attr('disabled', true);
                break;
            case 'Sub':
                $('#select-main').hide();
                $('#MainCate').attr('disabled', true);
                $('#select-sub').show();
                $('#SubCate').attr('disabled', false);
                $('#select-child').hide();
                $('#ChildCate').attr('disabled', true);
                break;
            case 'Child':
                $('#select-main').hide();
                $('#MainCate').attr('disabled', true);
                $('#select-sub').hide();
                $('#SubCate').attr('disabled', true);
                $('#select-child').show();
                $('#ChildCate').attr('disabled', false);
                break;
        }
    }
    $(document).ready(function () {
        $('.select-filter').change(function () {
            $('#form-filter').submit();
        });
        let searchParams = new URLSearchParams(window.location.search);
        if(searchParams.has('select-category-type')){
            let param = searchParams.get('select-category-type');
            $('.select-category-type').val(param).attr("selected", true);
            selectCateType();
        };

        $('.select-category-type').change(function () {
            selectCateType();
        });

        $('.select-mainCateId').change(function () {
                $('.SubCate').empty();
                $('.SubCate').append(`<option>Choose...</option>`);
                const mainCateId = $(this).val();
                if (mainCateId) {
                    $.ajax({
                    async: false,
                    type: "GET",
                    url: '{{  route('api.categories') }}',
                    data: { parent_id: mainCateId },
                    dataType: 'json',
                    success: function (response) {
                        $.each(response.data, function(index, each){
                            $('.SubCate').append(`
                                    <option value="${each}">
                                        ${index}
                                    </option>
                            `);
                        })
                    }
                });
                }


        });
        $('.select-subCateId').change(function () {
                $('#ChildCate').empty();
                $('#ChildCate').append(`<option>Choose...</option>`);
                const subCateId = $(this).val();
                if (subCateId) {
                    $.ajax({
                    async: false,
                    type: "GET",
                    url: '{{  route('api.categories') }}',
                    data: { parent_id: subCateId },
                    dataType: 'json',
                    success: function (response) {
                        $.each(response.data, function(index, each){
                            $('#ChildCate').append(`
                                    <option value="${each}">
                                        ${index}
                                    </option>
                            `);
                        })
                    }
                });
                }


        });
        $('.show-btn').click(function (e) {
            let id = $(this).data('id');
            GetDataByID(id);
            $('.box-lightbox').addClass('open');


        });

        $('.js-lightbox-close').click(function (e) {
            $('.box-lightbox').removeClass('open');

        });

    });
    function GetDataByID(id){
        $.ajax({
            async: false,
            url: "{{ route('api.product.show') }}",
            data: {id : id},
            dataType: 'json',
            success: function (response) {
                $('#product-name').html(response.data.name);
                $('#product-category').html(response.data.category.name);
                $('#product-price').html(response.data.price);
                $('#product-status').html(response.data.status);
                $('#product-description').html('Description : ' +response.data.description);
                $('#product-color').html('Color : ' + response.data.color);
                $('#product-size').html('Size : ' + response.data.size);
                $('#product-image').attr('src', '{{ asset('img/products') }}/' + response.data.feature_image);

            }
        });
    }
</script>
@endpush

{{-- // let string = '';
// string += `{{ asset("img/products/" `;
// string += response.data.feature_image;
// string += `) }}` ;
// $('#product-image').src = string; --}}
