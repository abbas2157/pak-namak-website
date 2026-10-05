@extends('layouts.site')

@section('title', 'Privacy Policy')

@php($company = $settings['site_name'] ?? 'Pak Namak & Masala Jaat (PVT) Limited')
@php($email = $settings['email'] ?? 'info@paknamak.pk')
@php($phone = $settings['phone'] ?? '+92 307 8479818')

@section('legal_body')
    <p>This policy explains what information {{ $company }} ("we", "us") collects through this website, how we use it, and the choices you have.</p>

    <h2>Information we collect</h2>
    <ul>
        <li><strong>Contact form:</strong> your name, phone number, the product you are asking about and your message.</li>
        <li><strong>Dealer application form:</strong> your name, phone number, business name and type, city, products of interest, expected monthly volume and any message you add.</li>
        <li><strong>Website usage:</strong> we use Google Analytics to understand how visitors use the site (pages viewed, approximate location, device and browser). Google may set cookies for this.</li>
    </ul>
    <p>We do not ask for payment card details, CNIC numbers or passwords on this website.</p>

    <h2>How we use your information</h2>
    <ul>
        <li>To reply to your enquiry, share rates and arrange orders or delivery.</li>
        <li>To review dealer and distributor applications and contact you about them.</li>
        <li>To improve the website and our products based on how the site is used.</li>
    </ul>
    <p>We do not sell or rent your personal information. We do not send marketing messages unless you have asked us to keep in touch.</p>

    <h2>Who we share it with</h2>
    <p>Your details are seen only by our own team. We use a small number of service providers to run the website: our web host, our email provider (for form notifications) and Google Analytics. They process data on our behalf and only for these purposes. We may also disclose information if required by Pakistani law.</p>

    <h2>Cookies</h2>
    <p>The site uses a session cookie needed for the forms to work securely, and Google Analytics cookies to measure visits. You can block or delete cookies in your browser settings; the website will still work, but analytics will not count your visit.</p>

    <h2>How long we keep it</h2>
    <p>We keep enquiries and dealer applications for as long as needed to respond and to maintain our business relationship with you, and then delete them. You can ask us to delete your details sooner at any time.</p>

    <h2>Your choices</h2>
    <p>You can ask us what information we hold about you, ask us to correct it, or ask us to delete it. Contact us using the details below and we will respond within a reasonable time.</p>

    <h2>Changes to this policy</h2>
    <p>We may update this policy from time to time. The "Last updated" date at the top shows when it was last changed.</p>

    <h2>Contact us</h2>
    <p>{{ $company }}<br>
        <span lang="ur">{{ $settings['address'] ?? '' }}</span><br>
        Phone / WhatsApp: {{ $phone }}<br>
        Email: <a href="mailto:{{ $email }}">{{ $email }}</a></p>
@endsection

@section('content')
    @include('site.partials.legal-page', ['heading' => 'Privacy Policy', 'updated' => '5 October 2026'])
    @include('site.partials.contact-section')
@endsection
