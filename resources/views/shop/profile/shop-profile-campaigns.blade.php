@extends('layouts.app')

@section('title', 'Campaigns - Shop Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('shop.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">Campaigns</h1>
                <p>Select one of the campaigns you are interested in</p>
                <div class="profile__campaigns campaigns-profile">
                    <div class="campaigns-profile__items">
                        <div class="campaigns-profile__item item-campaigns">
                            <div class="item-campaigns__inner">
                                <div class="item-campaigns__icon _icon-spinner4"></div>
                                <div class="item-campaigns__wrapp">
                                    <div class="item-campaigns__title">Highlight Elements</div>
                                    <div class="item-campaigns__text"><span>0.18 USD</span> per click</div>
                                    <div class="item-campaigns__text"><b>{{ $highlightClicks ?? 0 }}</b> clicks with current budget</div>
                                </div>
                            </div>
                            <a href="{{ route('shop.profile.campaigns.elements') }}" class="item-campaigns__btn btn">Select</a>
                        </div>
                        <div class="campaigns-profile__item item-campaigns">
                            <div class="item-campaigns__inner">
                                <div class="item-campaigns__icon _icon-menu"></div>
                                <div class="item-campaigns__wrapp">
                                    <div class="item-campaigns__title">Banner Campaign</div>
                                    <div class="item-campaigns__text"><span>0.00005 USD</span> per click</div>
                                    <div class="item-campaigns__text"><b>{{ $bannerClicks ?? 0 }}</b> clicks with current budget</div>
                                </div>
                            </div>
                            <a href="{{ route('shop.profile.campaigns.banner') }}" class="item-campaigns__btn btn">Select</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection