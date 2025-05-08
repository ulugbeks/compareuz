@extends('layouts.app')

@section('title', 'Terms and Conditions')

@section('content')
<section class="terms">
    <div class="terms__container">
        <h1 class="terms__title section-title">Terms and Conditions</h1>
        
        <div class="terms__content">
            <p>Last updated: {{ date('F j, Y') }}</p>
            
            <h2>1. Introduction</h2>
            <p>Welcome to {{ config('app.name') }} ("we," "our," or "us"). These Terms and Conditions govern your use of our website and services. By using our website, you accept these terms and conditions in full. If you disagree with these terms and conditions or any part of these terms and conditions, you must not use our website.</p>
            
            <h2>2. License to Use Website</h2>
            <p>Unless otherwise stated, we or our licensors own the intellectual property rights in the website and material on the website. Subject to the license below, all these intellectual property rights are reserved.</p>
            <p>You may view, download for caching purposes only, and print pages from the website for your own personal use, subject to the restrictions set out below and elsewhere in these terms and conditions.</p>
            
            <h2>3. Acceptable Use</h2>
            <p>You must not use our website in any way that causes, or may cause, damage to the website or impairment of the availability or accessibility of the website; or in any way which is unlawful, illegal, fraudulent, or harmful, or in connection with any unlawful, illegal, fraudulent, or harmful purpose or activity.</p>
            <p>You must not use our website to copy, store, host, transmit, send, use, publish, or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit, or other malicious computer software.</p>
            
            <h2>4. Limitations of Liability</h2>
            <p>We will not be liable to you in respect of any losses arising out of any event or events beyond our reasonable control. We will not be liable to you in respect of any business losses, including (without limitation) loss of or damage to profits, income, revenue, use, production, anticipated savings, business, contracts, commercial opportunities, or goodwill.</p>
            
            <h2>5. Indemnity</h2>
            <p>You hereby indemnify us and undertake to keep us indemnified against any losses, damages, costs, liabilities, and expenses (including, without limitation, legal expenses and any amounts paid by us to a third party in settlement of a claim or dispute on the advice of our legal advisers) incurred or suffered by us arising out of any breach by you of any provision of these terms and conditions, or arising out of any claim that you have breached any provision of these terms and conditions.</p>
            
            <h2>6. Breaches of These Terms and Conditions</h2>
            <p>Without prejudice to our other rights under these terms and conditions, if you breach these terms and conditions in any way, we may take such action as we deem appropriate to deal with the breach, including suspending your access to the website, prohibiting you from accessing the website, blocking computers using your IP address from accessing the website, contacting your internet service provider to request that they block your access to the website, and/or bringing court proceedings against you.</p>
            
            <h2>7. Variation</h2>
            <p>We may revise these terms and conditions from time-to-time. Revised terms and conditions will apply to the use of our website from the date of the publication of the revised terms and conditions on our website. Please check this page regularly to ensure you are familiar with the current version.</p>
            
            <h2>8. Assignment</h2>
            <p>We may transfer, sub-contract, or otherwise deal with our rights and/or obligations under these terms and conditions without notifying you or obtaining your consent. You may not transfer, sub-contract, or otherwise deal with your rights and/or obligations under these terms and conditions.</p>
            
            <h2>9. Severability</h2>
            <p>If a provision of these terms and conditions is determined by any court or other competent authority to be unlawful and/or unenforceable, the other provisions will continue in effect. If any unlawful and/or unenforceable provision would be lawful or enforceable if part of it were deleted, that part will be deemed to be deleted, and the rest of the provision will continue in effect.</p>
            
            <h2>10. Entire Agreement</h2>
            <p>These terms and conditions constitute the entire agreement between you and us in relation to your use of our website and supersede all previous agreements in respect of your use of our website.</p>
            
            <h2>11. Governing Law and Jurisdiction</h2>
            <p>These terms and conditions will be governed by and construed in accordance with the laws of Uzbekistan, and any disputes relating to these terms and conditions will be subject to the exclusive jurisdiction of the courts of Uzbekistan.</p>
        </div>
    </div>
</section>
@endsection

@section('custom-css')
<style>
    .terms__container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 15px;
    }
    
    .terms__title {
        margin-bottom: 30px;
        text-align: center;
    }
    
    .terms__content {
        line-height: 1.6;
    }
    
    .terms__content h2 {
        margin-top: 30px;
        margin-bottom: 15px;
        font-size: 20px;
    }
    
    .terms__content p {
        margin-bottom: 15px;
    }
</style>
@endsection