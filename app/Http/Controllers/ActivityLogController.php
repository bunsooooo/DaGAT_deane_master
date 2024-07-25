<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::orderBy('Timestamp', 'desc')->get();
        $activityLogs = ActivityLog::with('document', 'signatory')->get();
        return view('activitylogs.index', compact('activityLogs'));
        
    }

    public function create()
    {
        return view('activitylogs.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Docu_ID' => 'required',
            'Sign_ID' => 'required',
            'Timestamp' => 'required|date',
        ]);

        ActivityLog::create($validatedData);

        return redirect()->route('activitylogs.index')->with('success', 'Activity log created successfully.');
    }

    public function show(ActivityLog $activityLog)
    {
        return view('activitylogs.show', compact('activityLog'));
    }

    public function edit(ActivityLog $activityLog)
    {
        return view('activitylogs.edit', compact('activityLog'));
    }

    public function update(Request $request, ActivityLog $activityLog)
    {
        $validatedData = $request->validate([
            'Docu_ID' => 'required',
            'Sign_ID' => 'required',
            'Timestamp' => 'required|date',
        ]);

        $activityLog->update($validatedData);

        return redirect()->route('activitylogs.index')->with('success', 'Activity log updated successfully.');
    }

    public function destroy(ActivityLog $activityLog)
    {
        $activityLog->delete();

        return redirect()->route('activitylogs.index')->with('success', 'Activity log deleted successfully.');
    }
}
