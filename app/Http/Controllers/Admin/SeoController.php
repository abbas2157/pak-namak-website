<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function edit()
    {
        return view('admin.seo', [
            'pages' => config('seo.pages'),
            'values' => Setting::all_cached(),
            'defaultTagId' => config('seo.google_tag_id'),
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'google_site_verification' => 'nullable|string|max:120',
            'google_tag_id' => ['nullable', 'regex:/^(G|GT|AW|UA)-[A-Z0-9-]+$/i'],
        ];
        foreach (array_keys(config('seo.pages')) as $key) {
            $rules["seo_{$key}_title"] = 'nullable|string|max:120';
            $rules["seo_{$key}_description"] = 'nullable|string|max:320';
        }

        $data = $request->validate($rules, [
            'google_tag_id.regex' => 'The Google tag ID should look like G-XXXXXXX or GT-XXXXXXX.',
        ]);

        // Accept the full <meta> tag pasted from Search Console as well as the bare code.
        if (! empty($data['google_site_verification']) && preg_match('/content="([^"]+)"/', $data['google_site_verification'], $m)) {
            $data['google_site_verification'] = $m[1];
        }

        Setting::put(array_map(fn ($v) => $v === null ? '' : trim($v), $data));

        return back()->with('success', 'SEO settings saved.');
    }
}
