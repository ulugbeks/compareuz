@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<section class="policy">
    <div class="policy__container">
        <h1 class="policy__title section-title">Privacy Policy</h1>
        
        <div class="policy__content">
            <p>Last updated: {{ date('F j, Y') }}</p>
            
            <h2>1. Introduction</h2>
            <p>Welcome to {{ config('app.name') }} ("we," "our," or "us"). We respect your privacy and are committed to protecting your personal data. This privacy policy will inform you about how we look after your personal data when you visit our website and tell you about your privacy rights and how the law protects you.</p>
            
            <h2>2. The Data We Collect About You</h2>
            <p>Personal data, or personal information, means any information about an individual from which that person can be identified. We may collect, use, store and transfer different kinds of personal data about you which we have grouped together as follows:</p>
            <ul>
                <li><strong>Identity Data</strong> includes first name, last name, username or similar identifier, title, and gender.</li>
                <li><strong>Contact Data</strong> includes email address, telephone numbers, and addresses.</li>
                <li><strong>Technical Data</strong> includes internet protocol (IP) address, browser type and version, time zone setting and location, browser plug-in types and versions, operating system and platform, and other technology on the devices you use to access this website.</li>
                <li><strong>Profile Data</strong> includes your username and password, purchases or orders made by you, your interests, preferences, feedback, and survey responses.</li>
                <li><strong>Usage Data</strong> includes information about how you use our website, products, and services.</li>
            </ul>
            
            <h2>3. How We Use Your Personal Data</h2>
            <p>We will only use your personal data when the law allows us to. Most commonly, we will use your personal data in the following circumstances:</p>
            <ul>
                <li>Where we need to perform the contract we are about to enter into or have entered into with you.</li>
                <li>Where it is necessary for our legitimate interests (or those of a third party) and your interests and fundamental rights do not override those interests.</li>
                <li>Where we need to comply with a legal obligation.</li>
            </ul>
            
            <h2>4. Data Security</h2>
            <p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used, or accessed in an unauthorized way, altered, or disclosed. In addition, we limit access to your personal data to those employees, agents, contractors, and other third parties who have a business need to know.</p>
            
            <h2>5. Data Retention</h2>
            <p>We will only retain your personal data for as long as reasonably necessary to fulfill the purposes we collected it for, including for the purposes of satisfying any legal, regulatory, tax, accounting, or reporting requirements.</p>
            
            <h2>6. Your Legal Rights</h2>
            <p>Under certain circumstances, you have rights under data protection laws in relation to your personal data, including the right to:</p>
            <ul>
                <li>Request access to your personal data.</li>
                <li>Request correction of your personal data.</li>
                <li>Request erasure of your personal data.</li>
                <li>Object to processing of your personal data.</li>
                <li>Request restriction of processing your personal data.</li>
                <li>Request transfer of your personal data.</li>
                <li>Right to withdraw consent.</li>
            </ul>
            
            <h2>7. Contact Us</h2>
            <p>If you have any questions about this privacy policy or our privacy practices, please contact us at:</p>
            <p>Email: privacy@{{ str_replace(['http://', 'https://', 'www.'], '', config('app.url')) }}</p>
            
            <h2>8. Changes to the Privacy Policy</h2>
            <p>We may update our privacy policy from time to time. We will notify you of any changes by posting the new privacy policy on this page and updating the "Last updated" date at the top of this policy.</p>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .policy__container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 15px;
    }
    
    .policy__title {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .policy__content {
        line-height: 1.6;
    }
    
    .policy__content h2 {
        margin-top: 30px;
        margin-bottom: 15px;
        font-size: 20px;
    }
    
    .policy__content p {
        margin-bottom: 15px;
    }
    
    .policy__content ul {
        margin-bottom: 15px;
        padding-left: 30px;
    }
    
    .policy__content li {
        margin-bottom: 10px;
    }
</style>
@endsection