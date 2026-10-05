<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DealerApplication;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DealerController extends Controller
{
    public function index(Request $request)
    {
        $applications = DealerApplication::when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $counts = DealerApplication::selectRaw('status, count(*) as c')->groupBy('status')->pluck('c', 'status');

        return view('admin.dealers.index', compact('applications', 'counts'));
    }

    public function show(DealerApplication $dealer)
    {
        return view('admin.dealers.show', ['application' => $dealer]);
    }

    public function update(Request $request, DealerApplication $dealer)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(DealerApplication::STATUSES))],
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $dealer->update($data);

        return back()->with('success', 'Application updated.');
    }

    public function destroy(DealerApplication $dealer)
    {
        $dealer->delete();

        return redirect()->route('admin.dealers.index')->with('success', 'Application deleted.');
    }
}
