@extends('homepage.layouts.master')
@section('content')


<div class="homepage-content-area">
    <div class="homepage-content-navbar">
        <ul class="navbar-categories">
            @foreach ($categories as $category)
                <li class="navbar-categories-item">
                    <x-category-item :category="$category" />
                </li>
            @endforeach
        </ul>

    </div>
</div>

@endsection



