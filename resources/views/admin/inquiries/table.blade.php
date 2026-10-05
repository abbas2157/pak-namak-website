<div class="table-wrap">
    <table>
        <thead>
        <tr><th>Name</th><th>Phone</th><th>Product</th><th>Message</th><th>Received</th><th></th></tr>
        </thead>
        <tbody>
        @forelse($inquiries as $inquiry)
            <tr @class(['unread' => ! $inquiry->is_read])>
                <td>{{ $inquiry->name }}</td>
                <td><a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a></td>
                <td>{{ $inquiry->product ?: '—' }}</td>
                <td class="muted">{{ \Illuminate\Support\Str::limit($inquiry->message, 60) ?: '—' }}</td>
                <td class="muted" title="{{ $inquiry->created_at }}">{{ $inquiry->created_at->diffForHumans() }}</td>
                <td><div class="row-actions"><a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-light btn-sm">Open</a></div></td>
            </tr>
        @empty
            <tr><td colspan="6" class="empty">No inquiries yet. Messages sent from the Contact page will appear here.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
