@extends('layouts.admin')

@section('title', 'Inquiry from '.$inquiry->name)

@section('content')
    @php($digits = preg_replace('/\D/', '', $inquiry->phone))
    @php($wa = str_starts_with($digits, '0') ? '92'.substr($digits, 1) : $digits)
    <div class="card">
        <dl class="details">
            <dt>Name</dt><dd>{{ $inquiry->name }}</dd>
            <dt>Phone</dt><dd><a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a></dd>
            <dt>Product</dt><dd>{{ $inquiry->product ?: '—' }}</dd>
            <dt>Received</dt><dd>{{ $inquiry->created_at->format('d M Y, h:i A') }}</dd>
            <dt>Message</dt><dd>{{ $inquiry->message ?: '—' }}</dd>
        </dl>
        <div class="form-actions">
            <a href="tel:{{ $inquiry->phone }}" class="btn">Call</a>
            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn btn-accent">WhatsApp</a>
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-light">Back</a>
            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" onsubmit="return confirm('Delete this inquiry?')" style="margin-left:auto">
                @csrf @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
