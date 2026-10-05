@extends('layouts.admin')

@section('title', 'Team')

@section('content')
    <div class="card">
        <div class="card-head">
            <h2>Leadership team (About Us page)</h2>
            <a href="{{ route('admin.team.create') }}" class="btn">+ Add member</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr><th></th><th>Name</th><th>Title</th><th>Order</th><th></th></tr></thead>
                <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>@if($member->photo_url)<img src="{{ $member->photo_url }}" alt="" class="avatar">@endif</td>
                        <td><strong>{{ $member->name }}</strong></td>
                        <td>{{ $member->title }}</td>
                        <td>{{ $member->sort_order }}</td>
                        <td><div class="row-actions">
                            <a href="{{ route('admin.team.edit', $member) }}" class="btn btn-light btn-sm">Edit</a>
                            @include('admin.partials.delete', ['action' => route('admin.team.destroy', $member), 'confirm' => 'Remove this team member?'])
                        </div></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">No team members yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
