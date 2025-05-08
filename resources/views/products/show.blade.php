@extends('layouts.app')

@section('title', $product->name . ' - Price Comparison')

@section('content')
<section class="product-detail">
    <div class="products__container">
        <div class="product-detail__breadcrumbs">
            <a href="{{ route('home') }}">Home</a> / 
            <a href="{{ route('products', ['category' => $product->category->slug ?? '']) }}">{{ $product->category->name ?? 'Products' }}</a> / 
            <span>{{ $product->name }}</span>
        </div>
        
        <div class="product-detail__content">
            <div class="product-detail__left">
                <div class="product-detail__image">
                    <img src="{{ $product->image ?: asset('img/products/item-1.png') }}" alt="{{ $product->name }}">
                </div>
                <div class="product-detail__gallery">
                    <!-- Additional images could be displayed here -->
                </div>
            </div>
            
            <div class="product-detail__right">
                <h1 class="product-detail__title">{{ $product->name }}</h1>
                
                <div class="product-detail__info">
                    @if($product->manufacturer)
                        <div class="product-detail__info-item">
                            <span>Manufacturer:</span>
                            <strong>{{ $product->manufacturer }}</strong>
                        </div>
                    @endif
                    
                    @if($product->model)
                        <div class="product-detail__info-item">
                            <span>Model:</span>
                            <strong>{{ $product->model }}</strong>
                        </div>
                    @endif
                    
                    @if($product->ean)
                        <div class="product-detail__info-item">
                            <span>EAN:</span>
                            <strong>{{ $product->ean }}</strong>
                        </div>
                    @endif
                    
                    <div class="product-detail__info-item">
                        <span>Condition:</span>
                        <strong>{{ $product->used ? 'Used' : 'New' }}</strong>
                    </div>
                </div>
                
                <div class="product-detail__shops">
                    <h2>Available in {{ count($shopOffers ?? []) }} shops</h2>
                    
                    <div class="shop-offers">
                        @forelse($shopOffers ?? [] as $offer)
                            <div class="shop-offer">
                                <div class="shop-offer__left">
                                    <div class="shop-offer__logo">
                                        @if($offer->shop->banner)
                                            <img src="{{ asset($offer->shop->banner) }}" alt="{{ $offer->shop->shop_name }}">
                                        @else
                                            <img src="{{ asset('img/products/products-logo/item-1.jpg') }}" alt="{{ $offer->shop->shop_name }}">
                                        @endif
                                    </div>
                                    <div class="shop-offer__info">
                                        <div class="shop-offer__name">{{ $offer->shop->shop_name }}</div>
                                        <div class="shop-offer__rating">
                                            <div class="rating">
                                                <div class="rating__active" style="width: {{ ($offer->shop->rating ?? 0) * 20 }}%;"></div>
                                            </div>
                                            <span>{{ number_format($offer->shop->rating ?? 0, 1) }} ({{ $offer->shop->reviews_count ?? 0 }} reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="shop-offer__middle">
                                    <div class="shop-offer__stock">In Stock: {{ $offer->in_stock }}+</div>
                                    <div class="shop-offer__delivery">
                                        Delivery: {{ $offer->delivery_days ? $offer->delivery_days . ' days' : 'Contact shop' }}
                                    </div>
                                    @if($offer->delivery_cost)
                                        <div class="shop-offer__delivery-cost">
                                            Delivery Cost: ${{ number_format($offer->delivery_cost, 2) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="shop-offer__right">
                                    <div class="shop-offer__price">
                                        @if($offer->price_sale && $offer->price_sale < $offer->price)
                                            <div class="shop-offer__price-old">${{ number_format($offer->price, 2) }}</div>
                                            <div class="shop-offer__price-new">${{ number_format($offer->price_sale, 2) }}</div>
                                        @else
                                            <div class="shop-offer__price-new">${{ number_format($offer->price, 2) }}</div>
                                        @endif
                                    </div>
                                    <a href="{{ $offer->link ?? '#' }}" class="btn shop-offer__btn" target="_blank">Go to Shop</a>
                                </div>
                            </div>
                        @empty
                            <div class="shop-offers__empty">
                                <p>No offers available for this product at the moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        <div class="product-detail__description">
            <h2>Product Description</h2>
            <div class="product-detail__description-content">
                {{ $product->description ?? 'No description available for this product.' }}
            </div>
        </div>
        
        <div class="product-detail__related">
            <h2>Related Products</h2>
            <div class="products__items">
                @foreach($relatedProducts ?? [] as $relatedProduct)
                    <article class="products__item item-products">
                        <div class="item-products__main">
                            <a href="{{ route('products.show', $relatedProduct->id) }}" class="item-products__img">
                                <img src="{{ $relatedProduct->image ?: asset('img/products/item-1.png') }}" alt="{{ $relatedProduct->name }}">
                            </a>
                            <div class="item-products__wrapp">
                                <a href="{{ route('products.show', $relatedProduct->id) }}" class="item-products__title">{{ $relatedProduct->name }}</a>
                                <div class="item-products__category">{{ $relatedProduct->category->name ?? '' }}</div>
                                <div class="item-products__location _icon-location">Tashkent, Uzbekistan</div>
                                <div class="item-products__price">
                                    @if($relatedProduct->price_sale && $relatedProduct->price_sale < $relatedProduct->price)
                                        <span class="item-products__price-new">${{ number_format($relatedProduct->price_sale, 2) }}</span>
                                        <div class="item-products__price-old">${{ number_format($relatedProduct->price, 2) }}</div>
                                    @else
                                        <span class="item-products__price-new">${{ number_format($relatedProduct->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .product-detail__content {
        display: flex;
        margin-bottom: 30px;
    }
    .product-detail__left {
        width: 40%;
        padding-right: 30px;
    }
    .product-detail__right {
        width: 60%;
    }
    .product-detail__image {
        margin-bottom: 15px;
        text-align: center;
    }
    .product-detail__image img {
        max-width: 100%;
        height: auto;
    }
    .product-detail__title {
        font-size: 24px;
        margin-bottom: 20px;
    }
    .product-detail__info {
        margin-bottom: 30px;
    }
    .product-detail__info-item {
        margin-bottom: 10px;
        display: flex;
    }
    .product-detail__info-item span {
        width: 120px;
    }
    .shop-offers {
        margin-top: 20px;
    }
    .shop-offer {
        display: flex;
        border: 1px solid #eee;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 5px;
    }
    .shop-offer__left {
        width: 30%;
        display: flex;
        align-items: center;
    }
    .shop-offer__logo {
        width: 60px;
        height: 60px;
        margin-right: 15px;
    }
    .shop-offer__logo img {
        max-width: 100%;
        max-height: 100%;
    }
    .shop-offer__middle {
        width: 40%;
        padding: 0 15px;
    }
    .shop-offer__right {
        width: 30%;
        text-align: right;
    }
    .shop-offer__price-old {
        text-decoration: line-through;
        color: #999;
    }
    .shop-offer__price-new {
        font-size: 24px;
        font-weight: bold;
        color: #e74c3c;
    }
    .shop-offer__btn {
        margin-top: 10px;
    }
    .product-detail__description, 
    .product-detail__related {
        margin-top: 40px;
    }
    
    @media (max-width: 767px) {
        .product-detail__content {
            flex-direction: column;
        }
        .product-detail__left,
        .product-detail__right {
            width: 100%;
            padding-right: 0;
        }
        .shop-offer {
            flex-direction: column;
        }
        .shop-offer__left,
        .shop-offer__middle,
        .shop-offer__right {
            width: 100%;
            margin-bottom: 15px;
        }
        .shop-offer__right {
            text-align: left;
        }
    }
</style>
@endsection