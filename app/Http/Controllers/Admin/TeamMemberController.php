<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->get();

        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.form', ['member' => new TeamMember]);
    }

    public function store(Request $request)
    {
        TeamMember::create($this->validated($request));

        return redirect()->route('admin.team.index')->with('success', 'Team member added.');
    }

    public function edit(TeamMember $member)
    {
        return view('admin.team.form', compact('member'));
    }

    public function update(Request $request, TeamMember $member)
    {
        $member->update($this->validated($request, $member));

        return redirect()->route('admin.team.index')->with('success', 'Team member updated.');
    }

    public function destroy(TeamMember $member)
    {
        $this->deletePhoto($member->photo);
        $member->delete();

        return redirect()->route('admin.team.index')->with('success', 'Team member removed.');
    }

    private function validated(Request $request, ?TeamMember $member = null): array
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'title' => 'required|string|max:120',
            'bio' => 'nullable|string|max:2000',
            'bio_ur' => 'nullable|string|max:2000',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:4096',
        ]);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('photo')) {
            $this->deletePhoto($member?->photo);
            $data['photo'] = $request->file('photo')->store('team', 'public');
        } else {
            unset($data['photo']);
        }

        return $data;
    }

    private function deletePhoto(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'images/')) {
            Storage::disk('public')->delete($path);
        }
    }
}
