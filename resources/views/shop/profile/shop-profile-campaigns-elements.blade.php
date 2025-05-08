@extends('layouts.app')

@section('title', 'Elements Campaign - Shop Profile')

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
                                <div class="item-campaigns__icon _icon-spinner4"></div>
                                <div class="item-campaigns__wrapp">
                                    <div class="item-campaigns__title">Highlight Elements</div>
                                    <div class="item-campaigns__text"><span>0.18 USD</span> per click</div>
                                    <div class="item-campaigns__text"><b>{{ $elementsClicks ?? 0 }}</b> clicks with current budget</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('shop.profile.campaigns.elements.create') }}" method="POST">
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
                            <textarea name="notes" class="input @error('notes') is-invalid @enderror"
                                placeholder="Notes for Administrator"></textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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