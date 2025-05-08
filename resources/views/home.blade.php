@extends('layouts.app')

@section('title', 'Home - Price Comparison')

@section('content')
<section class="banner">
    <img src="{{ asset('img/banner/main.jpg') }}" alt="banner" class="banner__bg">
    <div class="banner__container">
        <h1 class="banner__title">
            Find <span>Best Deals</span> Your Ultimate Price <span>Comparison</span> Hub
        </h1>
        <form action="{{ route('products.search') }}" class="search-form">
            <input autocomplete="off" type="text" name="query" placeholder="Start typing to find products & stores..." class="input search-form__input">
            <button class="search-form__btn btn _icon-search"></button>
        </form>
    </div>
</section>
<section class="products">
    <div class="products__container">
        <h2 class="products__title section-title">Trending Products</h2>
        <div class="products__items">
            <!-- Sample product items - in production, these will be loaded from the database -->
            <article class="products__item item-products">
                <div class="item-products__main">
                    <a href="#" class="item-products__img">
                        <img src="{{ asset('img/products/item-1.png') }}" alt="product">
                    </a>
                    <div class="item-products__wrapp">
                        <a href="#" class="item-products__title">Apple iPhone 15 Pro Max</a>
                        <div class="item-products__location _icon-location">Tashkent, Uzbekistan</div>
                        <div class="item-products__price">
                            <span class="item-products__price-new">$200.00</span>
                            <div class="item-products__price-old">$400.00</div>
                        </div>
                    </div>
                </div>
            </article>
            <!-- More products will be added dynamically -->
        </div>
        <!-- Pagination -->
        <div class="pagination">
            <button disabled type="button" class="pagination__arrow _icon-arrow-left"></button>
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="" class="pagination__link _active">1</a>
                </li>
                <li class="pagination__item">
                    <a href="" class="pagination__link">2</a>
                </li>
                <li class="pagination__item">
                    <span class="pagination__link">...</span>
                </li>
                <li class="pagination__item">
                    <a href="" class="pagination__link">9</a>
                </li>
                <li class="pagination__item">
                    <a href="" class="pagination__link">10</a>
                </li>
            </ul>
            <button type="button" class="pagination__arrow _icon-arrow-right"></button>
        </div>
    </div>
</section>
@endsection