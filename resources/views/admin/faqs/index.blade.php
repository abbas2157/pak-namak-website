@extends('layouts.admin')

@section('title', 'FAQs')

@section('content')
    <div class="card">
        <div class="card-head">
            <h2>Frequently asked questions (FAQs page)</h2>
            <a href="{{ route('admin.faqs.create') }}" class="btn">+ Add FAQ</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th>#</th><th>Question</th><th>Status</th><th></th></tr></thead>
                <tbody>
                @forelse($faqs as $faq)
                    <tr>
                        <td>{{ $faq->sort_order }}</td>
                        <td>
                            <strong>{{ $faq->question }}</strong>
                            @if(str_contains($faq->answer.$faq->answer_ur, '['))<span class="pill pill-orange">Needs confirming</span>@endif
                        </td>
                        <td>@if($faq->is_active)<span class="pill pill-green">Visible</span>@else<span class="pill">Hidden</span>@endif</td>
                        <td><div class="row-actions">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-light btn-sm">Edit</a>
                            @include('admin.partials.delete', ['action' => route('admin.faqs.destroy', $faq), 'confirm' => 'Delete this FAQ?'])
                        </div></td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="empty">No FAQs yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
