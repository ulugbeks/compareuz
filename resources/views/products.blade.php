@extends('layouts.app')

@section('title', 'Products - Price Comparison')

@section('content')
<section class="products">
    <div class="products__container">
        <div class="products__top top-products">
            <div class="top-products__select select">
                <div class="select__top _icon-arrow-left">
                    Price
                </div>
                <form class="select__bottom" method="GET" action="{{ route('products.search') }}">
                    <input type="hidden" name="query" value="{{ request('query') }}">
                    <input autocomplete="off" type="text" name="price" class="input" value="{{ request('price') }}">
                    <button type="submit" class="btn">Apply</button>
                </form>
            </div>
            <div class="top-products__result">
                <b>{{ request('query') }}: </b>{{ $products->total() ?? 0 }} results
            </div>
        </div>
        <div class="products__items">
            @forelse($products ?? [] as $product)
            <article class="products__item item-products">
                <div class="item-products__top">
                    <a href="{{ $product->shop->website ?? '#' }}" class="item-products__top-link">
                        <div class="item-products__top-wrapp">
                            <div class="item-products__site">{{ $product->shop->shop_name ?? 'Shop' }}</div>
                            <div class="rating__wrapp">
                                <div class="rating rating_set item-products__rating">
                                    <div class="rating__body">
                                        <div class="rating__active" style="width: {{ ($product->shop->rating ?? 0) * 20 }}%;"></div>
                                        <div class="rating__items">
                                            <input type="radio" class="rating__item" value="1" name="rating">
                                            <input type="radio" class="rating__item" value="2" name="rating">
                                            <input type="radio" class="rating__item" value="3" name="rating">
                                            <input type="radio" class="rating__item" value="4" name="rating">
                                            <input type="radio" class="rating__item" value="5" name="rating">
                                        </div>
                                    </div>
                                    <div class="rating__value">{{ number_format($product->shop->rating ?? 0, 1) }}</div>
                                </div>
                                <div class="rating__qual">{{ $product->shop->reviews_count ?? 0 }}</div>
                            </div>
                        </div>
                        <div class="item-products__logo">
                            @if($product->shop->banner)
                                <img src="{{ asset($product->shop->banner) }}" alt="logo">
                            @else
                                <img src="{{ asset('img/products/products-logo/item-1.jpg') }}" alt="logo">
                            @endif
                        </div>
                    </a>
                    @if($product->sponsored)
                        <div class="item-products__advertising">Advertising</div>
                    @endif
                </div>
                <div class="item-products__main">
                    <a href="{{ route('products.show', $product->id) }}" class="item-products__img">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('img/products/item-1.png') }}" alt="{{ $product->name }}">
                        @endif
                    </a>
                    <div class="item-products__wrapp">
                        <a href="{{ route('products.show', $product->id) }}" class="item-products__title">{{ $product->name }}</a>
                        <div class="item-products__category">{{ $product->category->name ?? '' }}</div>
                        <div class="item-products__location _icon-location">Tashkent, Uzbekistan</div>
                        <div class="item-products__price">
                            @if($product->price_sale && $product->price_sale < $product->price)
                                <span class="item-products__price-new">${{ number_format($product->price_sale, 2) }}</span>
                                <div class="item-products__price-old">${{ number_format($product->price, 2) }}</div>
                            @else
                                <span class="item-products__price-new">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="item-products__stock">Quantity: {{ $product->in_stock }}+</div>
            </article>
            @empty
            <div class="products__empty">
                <h3>No products found.</h3>
                <p>Try changing your search criteria.</p>
            </div>
            @endforelse
        </div>
        
        @if(isset($products) && $products->hasPages())
        <div class="pagination">
            <button {{ $products->onFirstPage() ? 'disabled' : '' }} type="button" class="pagination__arrow _icon-arrow-left" onclick="window.location='{{ $products->previousPageUrl() }}'"></button>
            <ul class="pagination__list">
                @if($products->currentPage() > 3)
                    <li class="pagination__item">
                        <a href="{{ $products->url(1) }}" class="pagination__link">1</a>
                    </li>
                @endif
                
                @if($products->currentPage() > 4)
                    <li class="pagination__item">
                        <span class="pagination__link">...</span>
                    </li>
                @endif
                
                @foreach(range(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page)
                    <li class="pagination__item">
                        <a href="{{ $products->url($page) }}" class="pagination__link {{ $page == $products->currentPage() ? '_active' : '' }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                @if($products->currentPage() < $products->lastPage() - 3)
                    <li class="pagination__item">
                        <span class="pagination__link">...</span>
                    </li>
                @endif
                
                @if($products->currentPage() < $products->lastPage() - 2)
                    <li class="pagination__item">
                        <a href="{{ $products->url($products->lastPage()) }}" class="pagination__link">{{ $products->lastPage() }}</a>
                    </li>
                @endif
            </ul>
            <button {{ $products->hasMorePages() ? '' : 'disabled' }} type="button" class="pagination__arrow _icon-arrow-right" onclick="window.location='{{ $products->nextPageUrl() }}'"></button>
        </div>
        @endif
    </div>
</section>
@endsection