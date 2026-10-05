@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
    <div class="stats">
        <div class="stat accent"><div class="num">{{ $stats['inquiries_unread'] }}</div><div class="lbl">Unread inquiries</div></div>
        <div class="stat"><div class="num">{{ $stats['inquiries_month'] }}</div><div class="lbl">Inquiries this month</div></div>
        <div class="stat"><div class="num">{{ $stats['inquiries_total'] }}</div><div class="lbl">Total inquiries</div></div>
        <div class="stat"><div class="num">{{ $stats['products_active'] }}</div><div class="lbl">Active products</div></div>
        <div class="stat"><div class="num">{{ $stats['categories'] }}</div><div class="lbl">Categories</div></div>
        <div class="stat"><div class="num">{{ $stats['faqs'] }}</div><div class="lbl">Published FAQs</div></div>
    </div>

    <div class="card">
        <div class="card-head">
            <h2>Latest inquiries</h2>
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-light btn-sm">View all</a>
        </div>
        @include('admin.inquiries.table', ['inquiries' => $recentInquiries])
    </div>
@endsection
