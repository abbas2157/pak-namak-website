<x-mail::message>
# New dealer application

**Name:** {{ $application->name }}<br>
**Phone:** {{ $application->phone }}<br>
**Business:** {{ $application->business_name }} ({{ $application->label('business_type') }})<br>
**City / area:** {{ $application->city }}<br>
**Interested in:** {{ $application->label('interest') ?: '—' }}<br>
**Expected volume:** {{ $application->label('monthly_volume') ?: '—' }}

**Message:**<br>
{{ $application->message ?: '—' }}

<x-mail::button :url="route('admin.dealers.show', $application)">
Open in dashboard
</x-mail::button>
</x-mail::message>
