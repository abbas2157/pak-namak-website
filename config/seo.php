<?php

// Default <title> and meta description per public page, keyed by route name.
// Each can be overridden from Dashboard -> SEO (stored as seo_{key}_title / seo_{key}_description).
// Keep titles under ~60 characters and descriptions under ~160 so Google shows them in full.

return [
    'pages' => [
        'home' => [
            'label' => 'Home',
            'title' => 'Pak Namak — Salt & Masala Wholesaler, Multan & Vehari',
            'description' => 'Pak Namak & Masala Jaat, Melsi: finely ground rock salt, Dalla Namak, Khulla Namak, packed salt and Masala Jaat for shops, restaurants and homes.',
        ],
        'products' => [
            'label' => 'Products',
            'title' => 'Salt Prices & Pack Sizes — 250g to 50kg Bags | Pak Namak',
            'description' => 'Salt in 50kg, 10kg and 5kg bags, retail packets from 250g to 700g, plus chilli, turmeric, garam masala and dhania. Wholesale and retail rates on request.',
        ],
        'faqs' => [
            'label' => 'FAQs',
            'title' => 'Salt & Masala FAQs — Wholesale, Packing, Delivery | Pak Namak',
            'description' => 'Answers about our salt types, carton sizes, Dalla Namak, wholesale rates, custom packing, ordering, storage and becoming a Pak Namak dealer.',
        ],
        'about' => [
            'label' => 'About Us',
            'title' => 'About Pak Namak & Masala Jaat — Salt Processing Since 2024',
            'description' => 'A family-owned salt and masala business run by three brothers since 2024. Meet the team behind Pak Namak & Masala Jaat (PVT) Limited, Melsi.',
        ],
        'dealer' => [
            'label' => 'Become a Dealer',
            'title' => 'Become a Salt & Masala Dealer in South Punjab | Pak Namak',
            'description' => 'Apply to become a Pak Namak dealer or distributor. Dealer rates on salt and masala, consistent quality and reliable delivery across South Punjab.',
        ],
        'privacy' => [
            'label' => 'Privacy Policy',
            'title' => 'Privacy Policy | Pak Namak & Masala Jaat',
            'description' => 'How Pak Namak & Masala Jaat collects, uses and protects the information you share through our website contact and dealer forms.',
        ],
        'terms' => [
            'label' => 'Terms & Conditions',
            'title' => 'Terms & Conditions | Pak Namak & Masala Jaat',
            'description' => 'Terms for using the Pak Namak website, including product information, prices, orders, delivery and dealer applications.',
        ],
        'contact' => [
            'label' => 'Contact Us',
            'title' => 'Contact / Wholesale Enquiries — Pak Namak, Melsi Multan Road',
            'description' => 'Call or WhatsApp +92 307 8479818, email info@paknamak.pk, or visit our facility on Melsi–Multan Road for salt and masala orders and bulk enquiries.',
        ],
    ],

    'default_description' => 'Pak Namak & Masala Jaat — trusted supplier of high-quality salt, Dalla Namak, Khulla Namak, packed salt and premium Masala Jaat in Melsi, Punjab.',

    // Google tag already used by the WordPress site (Site Kit); kept so analytics history continues.
    'google_tag_id' => 'GT-WRGF5J2S',
];
