

<nav class="sidebar vertical-scroll dark_sidebar ps-container ps-theme-default ps-active-y" data-ps-id="b2030928-623a-f174-5ee2-7ae130b2b976">
    <div class="logo d-flex justify-content-between">
        <a href="index.html"><img src="img/logo_white.png" alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu" class="metismenu">
        <li class="sidebar_menu_li" >
            <a class="has-arrow" href="" aria-expanded="true">
                <div class="icon_menu">
                    <img src="img/menu-icon/dashboard.svg" alt="">
                </div>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar_menu_li" >
            <a class="has-arrow" href="{{ route('admin.logout') }}" aria-expanded="true">
                <div class="icon_menu">
                    <i class='bx bx-door-open' ></i>
                </div>
                <span>log out</span>
            </a>
        </li>
        <li class="sidebar_menu_li" >
            <a class="has-arrow" href="{{ route('admin.password') }}" aria-expanded="true">
                <div class="icon_menu">
                    <i class='bx bx-revision' ></i>
                </div>
                <span>Change Password</span>
            </a>
        </li>
        <li class="sidebar_menu_li" >
            <a class="has-arrow" href="#" aria-expanded="true">
                <div class="icon_menu">
                    <img src="img/menu-icon/dashboard.svg" alt="">
                </div>
                <span>Categories</span>
                <i class="fa-solid fa-caret-right drop-icon"></i>
            </a>
            <ul class="mm-collapse">
                <li><a href="{{ route('admin.categories.add') }}">Add category</a></li>
                <li><a href="{{ route('admin.categories.edit') }}">Edit </a></li>
            </ul>
        </li>
        <li class="sidebar_menu_li" >
            <a class="has-arrow" href="#" aria-expanded="true">
                <div class="icon_menu">
                    <i class='bx bxs-t-shirt' ></i>
                </div>
                <span>Products</span>
                <i class="fa-solid fa-caret-right drop-icon"></i>
            </a>
            <ul class="mm-collapse">
                <li><a href="{{ route('admin.products.all') }}">All Products</a></li>
                <li><a href="{{ route('admin.products.add') }}">Add Product</a></li>

            </ul>
        </li>




    </ul>
</nav>
