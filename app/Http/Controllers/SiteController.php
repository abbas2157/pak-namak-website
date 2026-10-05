<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\Order;
use App\Models\Product;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
    }

    public function shop()
    {
        $categories = Category::with(['products' => fn ($q) => $q->active()])
            ->orderBy('sort_order')
            ->get()
            ->filter(fn ($c) => $c->products->isNotEmpty());

        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.shop', compact('categories', 'faqs'));
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

        Inquiry::create($data);

        return back()->with('success', 'Thank you! We will contact you shortly. / شکریہ! ہم جلد آپ سے رابطہ کریں گے۔');
    }
}
