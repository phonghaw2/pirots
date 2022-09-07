
    <div class="row main-category-card">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h2 class="m-0">Add main category</h2>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.addMain') }}" method="post" class="add-cate-form">
                            @csrf
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Main Category</label>
                                <input type="text" name="name" class="form-control" id="main-category" placeholder="Ex: Sales..." maxlength="25">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="slug">slug</label>
                                <input type="text" name="slug" id="mainSlug" class="form-control" >
                            </div>
                            <button class="btn btn-primary" id="main-category-submit" disabled>ADD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- SUB CATEGORY --}}
    <div class="row sub-category-card">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h2 class="m-0">Add sub category</h2>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <form action="{{ route('admin.categories.addSub') }}" method="post" class="add-cate-form">
                            @csrf
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="mainCateId">Select Main Category</label>
                                <select name="mainCateId" class="form-control">
                                    <option selected></option>
                                        @foreach ($categories as $category)
                                            @if ($category->parent_id === null)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Sub Category</label>
                                <input type="text" name="name" class="form-control"  id="sub-category" placeholder="Ex: Sales..." maxlength="25">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="slug">slug</label>
                                <input type="text" name="slug" id="subSlug" class="form-control" >
                            </div>
                            <button class="btn btn-primary" id="sub-category-submit" disabled>ADD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- CHILD CATEGORY --}}
    <div class="row child-category-card">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h2 class="m-0">Add child category</h2>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="card-body">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" >Select Main Category</label>
                            <select  class="form-control select-mainCateId" >
                                <option selected></option>
                                    @foreach ($categories as $category)
                                        @if ($category->parent_id === null)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </option>
                            </select>
                        </div>
                        <form action="{{ route('admin.categories.addChild') }}" method="post"  class="add-cate-form">
                            @csrf
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="subCateID">Select Child Category</label>
                                <select name="subCateID" id="select-subCateId" class="form-control" disabled></select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="name">Child Category</label>
                                <input type="text" name="name" class="form-control" id="child-category" placeholder="Ex: Sales..." maxlength="25">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="slug">slug</label>
                                <input type="text" name="slug"  id="childSlug" class="form-control" >
                            </div>
                            <button class="btn btn-primary" id="child-category-submit" disabled>ADD</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

