<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public const FIELDS = [
        'site_name' => ['Company name', 'required|string|max:150'],
        'tagline_ur' => ['Tagline (Urdu)', 'nullable|string|max:150'],
        'hero_text_ur' => ['Home intro text (Urdu)', 'nullable|string|max:2000'],
        'founded_year' => ['Founded year', 'nullable|string|max:10'],
        'phone' => ['Phone', 'required|string|max:30'],
        'whatsapp' => ['WhatsApp number (digits only, with country code)', 'nullable|regex:/^\d{8,15}$/'],
        'email' => ['Email', 'required|email|max:150'],
        'address' => ['Address', 'nullable|string|max:300'],
        'map_url' => ['Google Maps link', 'nullable|url|max:500'],
        'facebook' => ['Facebook URL', 'nullable|url|max:255'],
        'instagram' => ['Instagram URL', 'nullable|url|max:255'],
        'youtube' => ['YouTube URL', 'nullable|url|max:255'],
        'tiktok' => ['TikTok URL', 'nullable|url|max:255'],
        'whatsapp_link' => ['WhatsApp link (social icon)', 'nullable|url|max:255'],
        'order_url' => ['Salt order page link (Order Now menu)', 'nullable|url|max:500'],
        'spice_order_url' => ['Masala order page link (Order Now menu)', 'nullable|url|max:500'],
        'notify_email' => ['Send contact-form alerts to (email)', 'nullable|email|max:150'],
        'map_embed_url' => ['Google Maps embed link (Contact page map)', 'nullable|url|max:1000'],
    ];

    public function edit()
    {
        return view('admin.settings', ['fields' => self::FIELDS, 'values' => Setting::all_cached()]);
    }

    public function update(Request $request)
    {
        $data = $request->validate(array_map(fn ($f) => $f[1], self::FIELDS));
        Setting::put($data);

        return back()->with('success', 'Settings saved.');
    }
}
