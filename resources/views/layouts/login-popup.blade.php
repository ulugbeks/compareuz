<div id="login" aria-hidden="true" class="popup">
    <div class="popup__wrapper">
        <div class="popup__content">
            <button data-close type="button" class="popup__close _icon-close"></button>
            <div class="popup__main">
                <div class="popup__title section-title">Login</div>
                <form class="popup__form form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="email" data-error="Error!" placeholder="Email"
                            class="input" data-required>
                    </div>
                    <div class="input-wrapp">
                        <div class="input-password">
                            <input autocomplete="off" type="password" name="password" data-error="Error!" placeholder="Password"
                                class="input" data-required>
                            <button class="form__viewpass input-viewpass _icon-view" type="button"></button>
                        </div>
                    </div>
                    <button type="submit" class="btn popup__button">Login</button>
                </form>
                <a href="{{ route('register') }}" class="popup__link">Or create account</a>
            </div>
        </div>
    </div>
</div>

<div id="add-balance" aria-hidden="true" class="popup">
    <div class="popup__wrapper">
        <div class="popup__content">
            <button data-close type="button" class="popup__close _icon-close"></button>
            <div class="popup__main">
                <div class="popup__title section-title">Add Balance</div>
                <form class="popup__form form" method="POST" action="{{ route('shop.balance.add') }}">
                    @csrf
                    <div class="input-wrapp">
                        <input autocomplete="off" type="number" step="0.01" min="1" name="amount" data-error="Error!" placeholder="Amount"
                            class="input" data-required>
                    </div>
                    <div class="input-wrapp">
                        <select name="payment_method" class="input">
                            <option value="">Select Payment Method</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn popup__button">Add Funds</button>
                </form>
            </div>
        </div>
    </div>
</div>