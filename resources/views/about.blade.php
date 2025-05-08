@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<section class="about">
    <div class="about__container">
        <h1 class="about__title section-title">About Us</h1>
        
        <div class="about__content">
            <div class="about__image">
                <img src="{{ asset('img/about.jpg') }}" alt="About {{ config('app.name') }}">
            </div>
            
            <div class="about__text">
                <h2>Our Mission</h2>
                <p>At {{ config('app.name') }}, our mission is to help consumers make informed purchasing decisions by providing transparent and comprehensive price comparisons across various retailers in Uzbekistan.</p>
                
                <h2>Who We Are</h2>
                <p>We are a team of tech enthusiasts and consumer advocates who believe in the power of information. Our platform aggregates product data from hundreds of online and offline retailers across Uzbekistan, making it easy for you to find the best deals on the products you need.</p>
                
                <h2>What We Offer</h2>
                <ul>
                    <li><strong>Comprehensive Product Comparisons:</strong> We track thousands of products across multiple categories, from electronics to household goods.</li>
                    <li><strong>Real-Time Price Updates:</strong> Our system regularly updates prices to ensure you're seeing the most current information.</li>
                    <li><strong>User Reviews:</strong> Read authentic reviews from other shoppers to make informed decisions.</li>
                    <li><strong>Shop Information:</strong> Detailed information about retailers, including location, working hours, and payment methods.</li>
                    <li><strong>Price History:</strong> Track price changes over time to identify trends and the best time to buy.</li>
                </ul>
                
                <h2>For Retailers</h2>
                <p>We offer retailers the opportunity to showcase their products to our growing user base. Through our campaign features, retailers can highlight their best deals and increase their visibility on our platform.</p>
                
                <h2>Our Values</h2>
                <ul>
                    <li><strong>Transparency:</strong> We believe in providing clear, unbiased information.</li>
                    <li><strong>Accuracy:</strong> We strive for the most accurate and up-to-date price information.</li>
                    <li><strong>User-Focused:</strong> Our platform is designed with our users' needs at the forefront.</li>
                    <li><strong>Innovation:</strong> We continuously improve our platform to enhance the user experience.</li>
                </ul>
                
                <h2>Contact Us</h2>
                <p>Have questions, suggestions, or feedback? We'd love to hear from you:</p>
                <p>Email: info@{{ str_replace(['http://', 'https://', 'www.'], '', config('app.url')) }}</p>
                <p>Phone: +998 XX XXX XX XX</p>
                <p>Address: Tashkent, Uzbekistan</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .about__container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 15px;
    }
    
    .about__title {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .about__content {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
    }
    
    .about__image {
        flex: 1;
        min-width: 300px;
    }
    
    .about__image img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
    
    .about__text {
        flex: 2;
        min-width: 300px;
        line-height: 1.6;
    }
    
    .about__text h2 {
        margin-top: 20px;
        margin-bottom: 15px;
        font-size: 22px;
    }
    
    .about__text p {
        margin-bottom: 15px;
    }
    
    .about__text ul {
        margin-bottom: 15px;
        padding-left: 30px;
    }
    
    .about__text li {
        margin-bottom: 10px;
    }
    
    @media (max-width: 768px) {
        .about__content {
            flex-direction: column;
        }
        
        .about__image {
            text-align: center;
        }
        
        .about__image img {
            max-width: 500px;
        }
    }
</style>
@endsection