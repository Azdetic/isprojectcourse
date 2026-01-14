@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Privacy Policy</h1>
        <div class="prose prose-lg max-w-none text-gray-700">
            <p class="lead">Last updated: {{ now()->format('F j, Y') }}</p>
            
            <h2>1. Introduction</h2>
            <p>Welcome to TMarket. We are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our platform.</p>

            <h2>2. Information We Collect</h2>
            <p>We may collect information about you in a variety of ways. The information we may collect on the platform includes:</p>
            <ul>
                <li><strong>Personal Data:</strong> Personally identifiable information, such as your name, shipping address, email address, and telephone number, and demographic information, such as your age, gender, hometown, and interests, that you voluntarily give to us when you register with the platform.</li>
                <li><strong>Derivative Data:</strong> Information our servers automatically collect when you access the platform, such as your IP address, your browser type, your operating system, your access times, and the pages you have viewed directly before and after accessing the platform.</li>
            </ul>

            <h2>3. Use of Your Information</h2>
            <p>Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience. Specifically, we may use information collected about you via the platform to:</p>
            <ul>
                <li>Create and manage your account.</li>
                <li>Process your transactions and facilitate sales between users.</li>
                <li>Email you regarding your account or order.</li>
                <li>Monitor and analyze usage and trends to improve your experience with the platform.</li>
            </ul>

            <h2>4. Security of Your Information</h2>
            <p>We use administrative, technical, and physical security measures to help protect your personal information. While we have taken reasonable steps to secure the personal information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable, and no method of data transmission can be guaranteed against any interception or other type of misuse.</p>

            <h2>5. Contact Us</h2>
            <p>If you have questions or comments about this Privacy Policy, please contact us at: support@tmarket.telkomuniversity.ac.id</p>
        </div>
    </div>
</div>
@endsection
