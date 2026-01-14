@extends('layouts.app')

@section('title', 'Terms of Service')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Terms of Service</h1>
        <div class="prose prose-lg max-w-none text-gray-700">
            <p class="lead">Last updated: {{ now()->format('F j, Y') }}</p>

            <h2>1. Agreement to Terms</h2>
            <p>By using our platform, TMarket, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use the platform.</p>

            <h2>2. User Accounts</h2>
            <p>You must be a student of Telkom University to create an account. You are responsible for safeguarding your account and for all activities that occur under it. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>

            <h2>3. User Conduct</h2>
            <p>You agree not to use the platform to:</p>
            <ul>
                <li>Post or transmit any content that is illegal, fraudulent, or for any other unauthorized purpose.</li>
                <li>Engage in any activity that would interfere with or disrupt the platform.</li>
                <li>Attempt to impersonate another user or person.</li>
            </ul>
            <p>We are a platform for connecting buyers and sellers. We are not a party to any transaction between users. We do not guarantee the quality, safety, or legality of items advertised.</p>

            <h2>4. Termination</h2>
            <p>We may terminate or suspend your account and bar access to the platform immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms.</p>
            
            <h2>5. Governing Law</h2>
            <p>These Terms shall be governed and construed in accordance with the laws of Indonesia, without regard to its conflict of law provisions.</p>
            
            <h2>6. Contact Us</h2>
            <p>If you have any questions about these Terms, please contact us at: support@tmarket.telkomuniversity.ac.id</p>
        </div>
    </div>
</div>
@endsection
