<x-mail::message>
# New inquiry from the website

**Name:** {{ $inquiry->name }}<br>
**Phone:** {{ $inquiry->phone }}<br>
**Product:** {{ $inquiry->product ?: '—' }}<br>
**Received:** {{ $inquiry->created_at->format('d M Y, h:i A') }}

**Message:**<br>
{{ $inquiry->message ?: '—' }}

<x-mail::button :url="route('admin.inquiries.show', $inquiry)">
Open in dashboard
</x-mail::button>
</x-mail::message>
