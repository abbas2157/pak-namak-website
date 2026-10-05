@extends('layouts.admin')

@section('title', 'Inquiries')

@section('content')
    <div class="card">
        <div class="card-head">
            <div class="filters">
                <a href="{{ route('admin.inquiries.index') }}" @class(['active' => request('filter') !== 'unread'])>All</a>
                <a href="{{ route('admin.inquiries.index', ['filter' => 'unread']) }}" @class(['active' => request('filter') === 'unread'])>Unread</a>
            </div>
        </div>
        @include('admin.inquiries.table')
        {{ $inquiries->links() }}
    </div>
@endsection
