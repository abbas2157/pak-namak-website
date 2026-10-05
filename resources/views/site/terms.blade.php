@extends('layouts.site')

@section('title', 'Terms & Conditions')

@php($company = $settings['site_name'] ?? 'Pak Namak & Masala Jaat (PVT) Limited')
@php($email = $settings['email'] ?? 'info@paknamak.pk')
@php($phone = $settings['phone'] ?? '+92 307 8479818')

@section('legal_body')
    <p>These terms apply to your use of this website, operated by {{ $company }} ("we", "us"). By using the site you agree to them.</p>

    <h2>Information on this website</h2>
    <p>We work to keep product details, pack sizes and other information accurate, but it is provided for general information and may change without notice. Product photos are for illustration; packaging can vary between batches.</p>

    <h2>Prices and orders</h2>
    <ul>
        <li>Unless a price is shown, rates are given on request because they depend on quantity, pack size and current market rates.</li>
        <li>A quote is valid only for the date and quantity it was given for.</li>
        <li>An order is confirmed only after our team confirms it with you by phone. We may decline or limit an order, for example when stock is not available.</li>
        <li>Payment, advance and delivery terms are agreed for each order. First-time bulk orders may require an advance.</li>
    </ul>

    <h2>Delivery</h2>
    <p>Delivery times shared with you are estimates. Deliveries outside our direct delivery area are sent through third-party goods transport, and their timing depends on the transport company. Please check goods on arrival and tell us about any damage or shortage as soon as possible.</p>

    <h2>Dealer and distributor applications</h2>
    <p>Sending a dealer application does not create a dealership or any obligation for either side. Dealership terms are agreed separately and in writing.</p>

    <h2>Use of this website</h2>
    <p>Please do not misuse the site, for example by sending spam through the forms, trying to access the admin area, or interfering with how the site works.</p>

    <h2>Our content</h2>
    <p>The Pak Namak name, logo, photos and text on this website belong to {{ $company }}. You may share links to our pages, but please do not copy our content or use our brand without permission.</p>

    <h2>Links to other websites</h2>
    <p>The site links to services such as Facebook, TikTok, YouTube, WhatsApp and Google Maps. We are not responsible for the content or privacy practices of those services.</p>

    <h2>Liability</h2>
    <p>To the extent allowed by law, we are not liable for any indirect loss arising from use of this website or reliance on its information. Nothing in these terms limits any rights you have under Pakistani consumer protection law.</p>

    <h2>Governing law</h2>
    <p>These terms are governed by the laws of Pakistan, and any dispute is subject to the courts of Punjab.</p>

    <h2>Changes</h2>
    <p>We may update these terms from time to time. The "Last updated" date at the top shows when they were last changed.</p>

    <h2>Contact us</h2>
    <p>Phone / WhatsApp: {{ $phone }}<br>
        Email: <a href="mailto:{{ $email }}">{{ $email }}</a></p>
@endsection

@section('content')
    @include('site.partials.legal-page', ['heading' => 'Terms & Conditions', 'updated' => '5 October 2026'])
    @include('site.partials.contact-section')
@endsection
