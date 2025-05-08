@extends('layouts.app')

@section('title', 'Shop Information - Shop Profile')

@section('content')
<section class="profile">
    <div class="profile__container">
        <div class="profile__wrapp">
            @include('shop.profile.sidebar')
            <div class="profile__block">
                <h1 class="profile__title section-title">
                    Shop Information
                </h1>
                <p>
                    Here you can change the basic information about your shop
                </p>
                <form action="{{ route('shop.profile.info.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-section">
                        <div class="form-title">Basic Information</div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="shop_name" data-error="Error!"
                                placeholder="Shop name" class="input @error('shop_name') is-invalid @enderror"
                                value="{{ $shopProfile->shop_name ?? '' }}" required>
                            @error('shop_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="company_name" data-error="Error!"
                                placeholder="Company name" class="input @error('company_name') is-invalid @enderror"
                                value="{{ $shopProfile->company_name ?? '' }}" required>
                            @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="registration_number" data-error="Error!"
                                placeholder="Registration number" class="input @error('registration_number') is-invalid @enderror"
                                value="{{ $shopProfile->registration_number ?? '' }}" required>
                            @error('registration_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="address" data-error="Error!"
                                placeholder="Address" class="input @error('address') is-invalid @enderror"
                                value="{{ $shopProfile->address ?? '' }}" required>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="tel" name="contact_number" data-error="Error!"
                                placeholder="Сontact number" class="input @error('contact_number') is-invalid @enderror"
                                value="{{ $shopProfile->contact_number ?? '' }}" required>
                            @error('contact_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="tel" name="public_number" data-error="Error!"
                                placeholder="Public number" class="input @error('public_number') is-invalid @enderror"
                                value="{{ $shopProfile->public_number ?? '' }}" required>
                            @error('public_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="website" data-error="Error!"
                                placeholder="Website" class="input @error('website') is-invalid @enderror"
                                value="{{ $shopProfile->website ?? '' }}" required>
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="xml_link" data-error="Error!"
                                placeholder="Link to XML" class="input @error('xml_link') is-invalid @enderror"
                                value="{{ $shopProfile->xml_link ?? '' }}">
                            @error('xml_link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="form-title">Payment Methods</div>
                        <div class="checkbox">
                            <input id="payment_cash" data-error="Error" class="checkbox__input" type="checkbox"
                                value="1" name="payment_cash" {{ isset($paymentMethods) && in_array('cash', $paymentMethods) ? 'checked' : '' }}>
                            <label for="payment_cash" class="checkbox__label"><span class="checkbox__text">Cash</span></label>
                        </div>
                        <div class="checkbox">
                            <input id="payment_card" data-error="Error" class="checkbox__input" type="checkbox"
                                value="1" name="payment_card" {{ isset($paymentMethods) && in_array('card', $paymentMethods) ? 'checked' : '' }}>
                            <label for="payment_card" class="checkbox__label"><span class="checkbox__text">Card</span></label>
                        </div>
                        <div class="checkbox">
                            <input id="payment_transfer" data-error="Error" class="checkbox__input" type="checkbox"
                                value="1" name="payment_transfer" {{ isset($paymentMethods) && in_array('transfer', $paymentMethods) ? 'checked' : '' }}>
                            <label for="payment_transfer" class="checkbox__label"><span class="checkbox__text">Bank Transfer</span></label>
                        </div>
                        <div class="checkbox">
                            <input id="payment_leasing" data-error="Error" class="checkbox__input" type="checkbox"
                                value="1" name="payment_leasing" {{ isset($paymentMethods) && in_array('leasing', $paymentMethods) ? 'checked' : '' }}>
                            <label for="payment_leasing" class="checkbox__label"><span class="checkbox__text">Leasing</span></label>
                        </div>
                        <div class="input-wrapp">
                            <textarea name="payment_description" class="input @error('payment_description') is-invalid @enderror"
                                placeholder="Payment description">{{ $shopProfile->payment_description ?? '' }}</textarea>
                            @error('payment_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="form-title">Delivery</div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="delivery_tashkent" data-error="Error!"
                                placeholder="Delivery in Tashkent" class="input @error('delivery_tashkent') is-invalid @enderror"
                                value="{{ $shopProfile->delivery_tashkent ?? '' }}">
                            @error('delivery_tashkent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="delivery_parcel" data-error="Error!"
                                placeholder="Delivery using parcel services" class="input @error('delivery_parcel') is-invalid @enderror"
                                value="{{ $shopProfile->delivery_parcel ?? '' }}">
                            @error('delivery_parcel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <textarea name="delivery_description" class="input @error('delivery_description') is-invalid @enderror"
                                placeholder="Delivery description">{{ $shopProfile->delivery_description ?? '' }}</textarea>
                            @error('delivery_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="form-title">Working Hours</div>
                        <p><b>Monday</b></p>
                        <div class="select-wrapp">
                            <span>From</span>
                            <select name="monday_from" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['monday']['from'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['monday']['from'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                            <span>To</span>
                            <select name="monday_to" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['monday']['to'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['monday']['to'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                        </div>
                        <p><b>Tuesday</b></p>
                        <div class="select-wrapp">
                            <span>From</span>
                            <select name="tuesday_from" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['tuesday']['from'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['tuesday']['from'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                            <span>To</span>
                            <select name="tuesday_to" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['tuesday']['to'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['tuesday']['to'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Repeat similar blocks for Wednesday through Sunday -->
                        
                        <p><b>Wednesday</b></p>
                        <div class="select-wrapp">
                            <span>From</span>
                            <select name="wednesday_from" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['wednesday']['from'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['wednesday']['from'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                            <span>To</span>
                            <select name="wednesday_to" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['wednesday']['to'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['wednesday']['to'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <p><b>Thursday</b></p>
                        <div class="select-wrapp">
                            <span>From</span>
                            <select name="thursday_from" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['thursday']['from'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['thursday']['from'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                            <span>To</span>
                            <select name="thursday_to" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['thursday']['to'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['thursday']['to'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <p><b>Friday</b></p>
                        <div class="select-wrapp">
                            <span>From</span>
                            <select name="friday_from" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['friday']['from'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['friday']['from'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                            <span>To</span>
                            <select name="friday_to" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['friday']['to'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['friday']['to'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <p><b>Saturday</b></p>
                        <div class="select-wrapp">
                            <span>From</span>
                            <select name="saturday_from" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['saturday']['from'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['saturday']['from'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                            <span>To</span>
                            <select name="saturday_to" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['saturday']['to'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['saturday']['to'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <p><b>Sunday</b></p>
                        <div class="select-wrapp">
                            <span>From</span>
                            <select name="sunday_from" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['sunday']['from'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['sunday']['from'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                            <span>To</span>
                            <select name="sunday_to" class="form">
                                <option value="-" {{ isset($workingHours) && $workingHours['sunday']['to'] == '-' ? 'selected' : '' }}>-</option>
                                @foreach(range(9, 21) as $hour)
                                    <option value="{{ $hour }}.00" {{ isset($workingHours) && $workingHours['sunday']['to'] == $hour.'.00' ? 'selected' : '' }}>{{ $hour }}.00</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="form-title">Social Media</div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="facebook" data-error="Error!"
                                placeholder="Link to Facebook" class="input @error('facebook') is-invalid @enderror"
                                value="{{ $shopProfile->facebook ?? '' }}">
                            @error('facebook')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="twitter" data-error="Error!"
                                placeholder="Link to Twitter" class="input @error('twitter') is-invalid @enderror"
                                value="{{ $shopProfile->twitter ?? '' }}">
                            @error('twitter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="youtube" data-error="Error!"
                                placeholder="Link to Youtube" class="input @error('youtube') is-invalid @enderror"
                                value="{{ $shopProfile->youtube ?? '' }}">
                            @error('youtube')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="instagram" data-error="Error!"
                                placeholder="Link to Instagram" class="input @error('instagram') is-invalid @enderror"
                                value="{{ $shopProfile->instagram ?? '' }}">
                            @error('instagram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="linkedin" data-error="Error!"
                                placeholder="Link to Linkedin" class="input @error('linkedin') is-invalid @enderror"
                                value="{{ $shopProfile->linkedin ?? '' }}">
                            @error('linkedin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-wrapp">
                            <input autocomplete="off" type="text" name="telegram" data-error="Error!"
                                placeholder="Link to Telegram" class="input @error('telegram') is-invalid @enderror"
                                value="{{ $shopProfile->telegram ?? '' }}">
                            @error('telegram')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-section">
                        <div class="form-title">Banner</div>
                        <div class="form-file">
                            <input id="formBanner" accept=".jpg, .png, .gif" autocomplete="off"
                                type="file" name="banner" class="form-file__input @error('banner') is-invalid @enderror">
                            <button class="info-profile__btn input">Select file</button>
                            <ul id="formPrew" class="form-file__prew">
                                @if(isset($shopProfile) && $shopProfile->banner)
                                    <li><img src="{{ asset($shopProfile->banner) }}" alt=""></li>
                                @endif
                            </ul>
                            @error('banner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn">Save</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection