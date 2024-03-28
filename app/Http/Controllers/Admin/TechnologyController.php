<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'label' => 'required|string|unique:technologies',
                'color' => 'nullable|hex_color',
                'icon' => 'nullable|unique:technologies'
            ],
            [
                'label.required' => 'Technology label must be mandatory',
                'label.unique' => 'There cannot be two technologies with the same label',
                'color.hex_color' => 'Invalid color code',
                'icon' => 'There cannot be two technologies with the same icon'
            ]
        );

        $technology = new Technology();

        $technology->fill($data);

        $technology->save();

        return to_route('admin.technologies.index')->with('type', 'success')->with('message', 'New technology successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        $data = $request->validate(
            [
                'label' => ['required', 'string', Rule::unique('technologies')->ignore($technology->id)],
                'color' => 'nullable|hex_color',
                'icon' => ['nullable', Rule::unique('technologies')->ignore($technology->id)]
            ],
            [
                'label.required' => 'Technology label must be mandatory',
                'label.unique' => 'There cannot be two technologies with the same label',
                'color.hex_color' => 'Invalid color code',
                'icon' => 'There cannot be two technologies with the same icon'
            ]
        );

        $technology->update($data);

        return to_route('admin.technologies.index')->with('type', 'success')->with('message', 'Technology successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();

        return to_route('admin.technologies.index')->with('type', 'danger')->with('message', "Technology $technology->label deleted");
    }
}
