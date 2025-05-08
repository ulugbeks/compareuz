@extends('layouts.app')

@section('title', 'Banner Campaign - Shop Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('shop.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">Create Campaign</h1>
                <p>Select the required data</p>
                <div class="profile__campaigns-page">
                    <div class="profile__campaigns campaigns-profile">
                        <div class="campaigns-profile__item item-campaigns">
                            <div class="item-campaigns__inner">
                                <div class="item-campaigns__icon _icon-menu"></div>
                                <div class="item-campaigns__wrapp">
                                    <div class="item-campaigns__title">Banner Campaign</div>
                                    <div class="item-campaigns__text"><span>0.00005 USD</span> per click</div>
                                    <div class="item-campaigns__text"><b>{{ $bannerClicks ?? 0 }}</b> clicks with current budget</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('shop.profile.campaigns.banner.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="start_date" data-error="Error!"
                                placeholder="Start date" class="input @error('start_date') is-invalid @enderror" required>
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="end_date" data-error="Error!"
                                placeholder="End date" class="input @error('end_date') is-invalid @enderror" required>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="campaign_name" data-error="Error!"
                                placeholder="Campaign name" class="input @error('campaign_name') is-invalid @enderror" required>
                            @error('campaign_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="campaign_link" data-error="Error!"
                                placeholder="Campaign link" class="input @error('campaign_link') is-invalid @enderror" required>
                            @error('campaign_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <textarea name="notes" class="input @error('notes') is-invalid @enderror"
                                placeholder="Notes for Administrator"></textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-section">
                            <div class="form-title">Upload Photos</div>
                            <p><b>Banner 1200x150 pixels</b></p>
                            <div class="form-file">
                                <input id="formBanner" accept=".jpg, .png, .gif" autocomplete="off"
                                    type="file" name="banner" class="form-file__input @error('banner') is-invalid @enderror">
                                <button class="info-profile__btn input">Select file</button>
                                <ul id="formPrewBanner" class="form-file__prew"></ul>
                                @error('banner')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <p><b>Rectangle 600x314 pixels</b></p>
                            <div class="form-file">
                                <input id="formRectangle" accept=".jpg, .png, .gif" autocomplete="off"
                                    type="file" name="rectangle" class="form-file__input @error('rectangle') is-invalid @enderror">
                                <button class="info-profile__btn input">Select file</button>
                                <ul id="formPrewRectangle" class="form-file__prew"></ul>
                                @error('rectangle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <p><b>Square 600x600 pixels</b></p>
                            <div class="form-file">
                                <input id="formSquare" accept=".jpg, .png, .gif" autocomplete="off"
                                    type="file" name="square" class="form-file__input @error('square') is-invalid @enderror">
                                <button class="info-profile__btn input">Select file</button>
                                <ul id="formPrewSquare" class="form-file__prew"></ul>
                                @error('square')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <span class="note">* After campaign approval, a confirmation message will be sent to your account email and you can view the campaign status in the Active Campaigns section</span>
                        <button type="submit" class="btn">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection