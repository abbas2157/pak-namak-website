<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DealerApplication;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'inquiries_total' => Inquiry::count(),
            'inquiries_unread' => Inquiry::where('is_read', false)->count(),
            'inquiries_month' => Inquiry::where('created_at', '>=', now()->startOfMonth())->count(),
            'dealers_new' => DealerApplication::where('status', 'new')->count(),
            'products_active' => Product::active()->count(),
            'categories' => Category::count(),
            'faqs' => Faq::where('is_active', true)->count(),
        ];

        $recentInquiries = Inquiry::latest()->take(8)->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries'));
    }
}
