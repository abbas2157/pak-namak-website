@extends('layouts.admin')

@section('title', 'Dealer: '.$application->business_name)

@section('content')
    @php($digits = preg_replace('/\D/', '', $application->phone))
    @php($wa = str_starts_with($digits, '0') ? '92'.substr($digits, 1) : $digits)
    <div class="card">
        <dl class="details">
            <dt>Business</dt><dd>{{ $application->business_name }}</dd>
            <dt>Type</dt><dd>{{ $application->label('business_type') }}</dd>
            <dt>Contact person</dt><dd>{{ $application->name }}</dd>
            <dt>Phone</dt><dd><a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></dd>
            <dt>City / area</dt><dd>{{ $application->city }}</dd>
            <dt>Interested in</dt><dd>{{ $application->label('interest') ?: '—' }}</dd>
            <dt>Monthly volume</dt><dd>{{ $application->label('monthly_volume') ?: '—' }}</dd>
            <dt>Received</dt><dd>{{ $application->created_at->format('d M Y, h:i A') }}</dd>
            <dt>Message</dt><dd>{{ $application->message ?: '—' }}</dd>
        </dl>
        <div class="form-actions">
            <a href="tel:{{ $application->phone }}" class="btn">Call</a>
            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="btn btn-accent">WhatsApp</a>
            <a href="{{ route('admin.dealers.index') }}" class="btn btn-light">Back</a>
            <form method="POST" action="{{ route('admin.dealers.destroy', $application) }}" onsubmit="return confirm('Delete this application?')" style="margin-left:auto">
                @csrf @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.dealers.update', $application) }}" class="card" style="max-width:720px">
        @csrf @method('PUT')
        <div class="card-head"><h2>Follow-up</h2></div>
        <div class="form-grid">
            <div class="field">
                <label for="status">Status</label>
                <select id="status" name="status">
                    @foreach(\App\Models\DealerApplication::STATUSES as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $application->status) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field full">
                <label for="admin_notes">Internal notes</label>
                <textarea id="admin_notes" name="admin_notes" placeholder="Rates offered, call outcome, next step...">{{ old('admin_notes', $application->admin_notes) }}</textarea>
                @error('admin_notes')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="form-actions"><button class="btn">Save</button></div>
    </form>
@endsection
