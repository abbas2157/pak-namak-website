@extends('layouts.admin')

@section('title', 'My Account')

@section('content')
    <form method="POST" action="{{ route('admin.account.update') }}" class="card" style="max-width:720px">
        @csrf @method('PUT')
        <div class="form-grid">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field full">
                <h3 style="margin:10px 0 0;font-size:15px">Change password</h3>
                <div class="hint">Leave blank to keep your current password.</div>
            </div>
            <div class="field full">
                <label for="current_password">Current password</label>
                <input type="password" id="current_password" name="current_password" autocomplete="current-password">
                @error('current_password')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="password">New password</label>
                <input type="password" id="password" name="password" autocomplete="new-password">
                @error('password')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label for="password_confirmation">Confirm new password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
            </div>
        </div>
        <div class="form-actions"><button class="btn">Save</button></div>
    </form>
@endsection
