<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bug;
use Illuminate\Http\Request;

class BugController extends Controller
{
    public function index()
    {
        $bugs = Bug::with('user')->paginate(10);
        return view('admin.bugs.index', compact('bugs'));
    }
    
    public function show($id)
    {
        $bug = Bug::with('user')->findOrFail($id);
        return view('admin.bugs.show', compact('bug'));
    }
    
    public function update(Request $request, $id)
    {
        $bug = Bug::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:new,in_progress,resolved,closed',
            'admin_notes' => 'nullable|string',
        ]);
        
        $bug->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);
        
        return redirect()->route('admin.bugs.index')
                         ->with('success', 'Bug report updated successfully');
    }
    
    public function destroy($id)
    {
        $bug = Bug::findOrFail($id);
        $bug->delete();
        
        return redirect()->route('admin.bugs.index')
                         ->with('success', 'Bug report deleted successfully');
    }
}