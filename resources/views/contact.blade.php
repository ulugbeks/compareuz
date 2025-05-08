@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
<section class="contact">
    <div class="contact__container">
        <h1 class="contact__title section-title">Contact Us</h1>
        
        <div class="contact__content">
            <div class="contact__info">
                <div class="contact__info-item">
                    <div class="contact__info-icon _icon-location"></div>
                    <div class="contact__info-text">
                        <h3>Address</h3>
                        <p>123 Main Street, Tashkent<br>Uzbekistan, 100000</p>
                    </div>
                </div>
                
                <div class="contact__info-item">
                    <div class="contact__info-icon _icon-phone"></div>
                    <div class="contact__info-text">
                        <h3>Phone</h3>
                        <p>+998 XX XXX XX XX</p>
                    </div>
                </div>
                
                <div class="contact__info-item">
                    <div class="contact__info-icon _icon-envelop"></div>
                    <div class="contact__info-text">
                        <h3>Email</h3>
                        <p>info@{{ str_replace(['http://', 'https://', 'www.'], '', config('app.url')) }}</p>
                    </div>
                </div>
                
                <div class="contact__info-item">
                    <div class="contact__info-icon _icon-clock"></div>
                    <div class="contact__info-text">
                        <h3>Working Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday - Sunday: Closed</p>
                    </div>
                </div>
                
                <div class="contact__social">
                    <h3>Follow Us</h3>
                    <div class="contact__social-icons">
                        <a href="#" class="_icon-facebook"></a>
                        <a href="#" class="_icon-twitter"></a>
                        <a href="#" class="_icon-instagram"></a>
                        <a href="#" class="_icon-linkedin"></a>
                    </div>
                </div>
            </div>
            
            <div class="contact__form">
                <h2>Send Us a Message</h2>
                
                @if(session('success'))
                    <div class="contact__success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="name" placeholder="Your Name" 
                            class="input @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-wrapp">
                        <input autocomplete="off" type="email" name="email" placeholder="Your Email" 
                            class="input @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-wrapp">
                        <input autocomplete="off" type="text" name="subject" placeholder="Subject" 
                            class="input @error('subject') is-invalid @enderror" value="{{ old('subject') }}" required>
                        @error('subject')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-wrapp">
                        <textarea name="message" placeholder="Your Message" class="input @error('message') is-invalid @enderror" 
                            rows="5" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
        
        <div class="contact__map">
            <h2>Our Location</h2>
            <div class="contact__map-frame">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d191884.83988016075!2d69.1392822771922!3d41.28274893499154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8b0cc379e9c3%3A0xa5a9323b4aa5cb98!2sTashkent%2C%20Uzbekistan!5e0!3m2!1sen!2sin!4v1651123446409!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .contact__container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 15px;
    }
    
    .contact__title {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .contact__content {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        margin-bottom: 50px;
    }
    
    .contact__info {
        flex: 1;
        min-width: 300px;
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 10px;
    }
    
    .contact__info-item {
        display: flex;
        margin-bottom: 25px;
    }
    
    .contact__info-icon {
        font-size: 24px;
        color: #3498db;
        margin-right: 15px;
        min-width: 30px;
        text-align: center;
    }
    
    .contact__info-text h3 {
        margin-bottom: 5px;
        font-size: 18px;
    }
    
    .contact__social {
        margin-top: 30px;
    }
    
    .contact__social h3 {
        margin-bottom: 15px;
        font-size: 18px;
    }
    
    .contact__social-icons {
        display: flex;
        gap: 15px;
    }
    
    .contact__social-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #3498db;
        color: #fff;
        border-radius: 50%;
        font-size: 18px;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    
    .contact__social-icons a:hover {
        background-color: #2980b9;
    }
    
    .contact__form {
        flex: 2;
        min-width: 300px;
    }
    
    .contact__form h2 {
        margin-bottom: 20px;
        font-size: 22px;
    }
    
    .contact__success {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 14px;
        display: block;
        margin-top: 5px;
    }
    
    .contact__map {
        margin-top: 50px;
    }
    
    .contact__map h2 {
        margin-bottom: 20px;
        font-size: 22px;
        text-align: center;
    }
    
    .contact__map-frame {
        border-radius: 10px;
        overflow: hidden;
    }
    
    @media (max-width: 768px) {
        .contact__content {
            flex-direction: column;
        }
    }
</style>
@endsection