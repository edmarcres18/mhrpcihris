<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Section;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::with('section')->orderBy('sort_order')->get();
        return view('policies.index', compact('policies'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('policies.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'sort_order' => 'required|integer',
            'section_id' => 'required|exists:sections,id',
        ]);

        Policy::create($validatedData);

        return redirect()->route('policies.index')->with('success', 'Policy created successfully.');
    }

    public function edit(Policy $policy)
    {
        $sections = Section::all();
        return view('policies.edit', compact('policy', 'sections'));
    }

    public function update(Request $request, Policy $policy)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'sort_order' => 'required|integer',
            'section_id' => 'required|exists:sections,id',
        ]);

        $policy->update($validatedData);

        return redirect()->route('policies.index')->with('success', 'Policy updated successfully.');
    }

    public function destroy(Policy $policy)
    {
        $policy->delete();

        return redirect()->route('policies.index')->with('success', 'Policy deleted successfully.');
    }

    public function showPolicy()
    {
        $policies = Policy::with('section')
            ->join('sections', 'policies.section_id', '=', 'sections.id')
            ->orderBy('sections.section_number')
            ->orderBy('policies.sort_order')
            ->select('policies.*', 'sections.name as section_name', 'sections.section_number')
            ->get()
            ->groupBy(function ($policy) {
                return 'Section ' . $policy->section_number . ': ' . $policy->section_name;
            });

        return view('policies.policies', compact('policies'));
    }
}
