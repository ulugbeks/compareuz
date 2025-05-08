<footer class="footer">
    <div class="footer__container">
        <div class="footer__top">
            <a href="{{ route('home') }}" class="footer__logo">
                LOGO
            </a>
            <ul class="footer__menu">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('trending') }}">Trending</a></li>
            </ul>
        </div>
        <div class="footer__bottom">
            <div class="footer__copy">
                Copyright {{ date('Y') }}. All rights reserved
            </div>
            <div class="footer__wrapp">
                <a href="{{ route('privacy') }}">Privacy Policy</a>
                <a href="{{ route('terms') }}">Terms & Conditions</a>
            </div>
        </div>
    </div>
</footer>