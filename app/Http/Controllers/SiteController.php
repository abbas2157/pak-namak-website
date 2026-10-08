<?php

namespace App\Http\Controllers;

use App\Mail\DealerApplicationReceived;
use App\Mail\InquiryReceived;
use App\Models\Category;
use App\Models\DealerApplication;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
    }

    public function products()
    {
        $categories = Category::with(['products' => fn ($q) => $q->active()])
            ->orderBy('sort_order')
            ->get()
            ->filter(fn ($c) => $c->products->isNotEmpty());

        return view('site.products', compact('categories'));
    }

    public function faqs()
    {
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.faqs', compact('faqs'));
    }

    public function about()
    {
        $team = TeamMember::orderBy('sort_order')->get();

        return view('site.about', compact('team'));
    }

    public function contact()
    {
        $products = Product::active()->orderBy('sort_order')->pluck('name');

        return view('site.contact', compact('products'));
    }

    public function submitContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:30',
            'product' => 'nullable|string|max:120',
            'message' => 'nullable|string|max:2000',
        ]);

        $inquiry = Inquiry::create($data);

        // The inquiry is already saved, so a mail failure must not lose it or break the form.
        if ($to = Setting::get('notify_email')) {
            try {
                Mail::to($to)->send(new InquiryReceived($inquiry));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return back()->with('success', 'Thank you! We will contact you shortly. / شکریہ! ہم جلد آپ سے رابطہ کریں گے۔');
    }

    public function dealer()
    {
        return view('site.dealer');
    }

    public function submitDealer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:30',
            'business_name' => 'required|string|max:150',
            'business_type' => ['required', Rule::in(array_keys(DealerApplication::BUSINESS_TYPES))],
            'city' => 'required|string|max:120',
            'interest' => ['nullable', Rule::in(array_keys(DealerApplication::INTERESTS))],
            'monthly_volume' => ['nullable', Rule::in(array_keys(DealerApplication::VOLUMES))],
            'message' => 'nullable|string|max:2000',
        ]);

        $application = DealerApplication::create($data);

        if ($to = Setting::get('notify_email')) {
            try {
                Mail::to($to)->send(new DealerApplicationReceived($application));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return back()->with('success', 'Thank you! Our team will call you within 2 working days. / شکریہ! ہماری ٹیم دو کاروباری دنوں میں آپ سے رابطہ کرے گی۔');
    }

    public function privacy()
    {
        return view('site.privacy');
    }

    public function terms()
    {
        return view('site.terms');
    }

    public function sitemap()
    {
        $pages = [
            [route('home'), '1.0'],
            [route('products'), '0.9'],
            [route('faqs'), '0.7'],
            [route('about'), '0.6'],
            [route('dealer'), '0.7'],
            [route('privacy'), '0.2'],
            [route('terms'), '0.2'],
            [route('contact'), '0.8'],
        ];

        return response()->view('site.sitemap', [
            'pages' => $pages,
            'lastmod' => max(Product::max('updated_at'), Faq::max('updated_at')) ?? now(),
        ])->header('Content-Type', 'application/xml');
    }
}
