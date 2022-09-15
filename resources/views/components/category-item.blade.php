<a href="" class="main-category-link pi-btn">
    <span class="main-cate-btn">{{ $category->name }}</span>
</a>
    <ul class="sub-category-list dropdown-navbar">
        @foreach ($category->children as $subCate)
                <li class="sub-category-item">
                    <span class="sub-cate-btn">{{ $subCate->name }}</span>
                    <ul class="child-category-list">
                        <li class="child-category-item">
                            <a href="" class="child-category-link ">
                                <span class="child-cate-btn">View all</span>
                            </a>
                        </li>
                        @foreach ($subCate->children as $childCate)
                                <li class="child-category-item">
                                    <a href="" class="child-category-link ">
                                        <span class="child-cate-btn">{{ $childCate->name }}</span>
                                    </a>
                                </li>
                        @endforeach
                    </ul>
                </li>

        @endforeach
    </ul>

