@extends('layouts.admin')

@section('title', 'Dealer Leads')

@section('content')
    @php($statuses = \App\Models\DealerApplication::STATUSES)
    <div class="card">
        <div class="card-head">
            <div class="filters">
                <a href="{{ route('admin.dealers.index') }}" @class(['active' => ! request('status')])>All ({{ $counts->sum() }})</a>
                @foreach($statuses as $value => $label)
                    <a href="{{ route('admin.dealers.index', ['status' => $value]) }}" @class(['active' => request('status') === $value])>{{ $label }} ({{ $counts[$value] ?? 0 }})</a>
                @endforeach
            </div>
            <a href="{{ route('dealer') }}" target="_blank" class="btn btn-light btn-sm">View form ↗</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Business</th><th>Contact</th><th>City</th><th>Type</th><th>Volume</th><th>Status</th><th>Received</th><th></th></tr></thead>
                <tbody>
                @forelse($applications as $application)
                    <tr @class(['unread' => $application->status === 'new'])>
                        <td>{{ $application->business_name }}</td>
                        <td>{{ $application->name }}<div class="muted"><a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></div></td>
                        <td>{{ $application->city }}</td>
                        <td>{{ \Illuminate\Support\Str::before($application->label('business_type'), ' /') }}</td>
                        <td class="muted">{{ $application->label('monthly_volume') ?: '—' }}</td>
                        <td>
                            <span @class(['pill', 'pill-orange' => $application->status === 'new', 'pill-green' => $application->status === 'approved'])>{{ $application->label('status') }}</span>
                        </td>
                        <td class="muted" title="{{ $application->created_at }}">{{ $application->created_at->diffForHumans() }}</td>
                        <td><div class="row-actions"><a href="{{ route('admin.dealers.show', $application) }}" class="btn btn-light btn-sm">Open</a></div></td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="empty">No dealer applications yet. Applications from the "Become a Dealer" page will appear here.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $applications->links() }}
    </div>
@endsection
