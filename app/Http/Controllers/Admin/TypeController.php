<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'label' => 'required|string|unique:types',
                'color' => 'nullable|hex_color'
            ],
            [
                'label.required' => 'Type label must be mandatory',
                'label.unique' => 'There cannot be two types with the same label',
                'color.hex_color' => 'Invalid color code'
            ]
        );

        $type = new Type();

        $type->fill($data);

        $type->save();

        return to_route('admin.types.index')->with('type', 'success')->with('message', 'New type successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->validate(
            [
                'label' => ['required', 'string', Rule::unique('types')->ignore($type->id)],
                'color' => 'nullable|hex_color'
            ],
            [
                'label.required' => 'Type label must be mandatory',
                'label.unique' => 'There cannot be two types with the same label',
                'color.hex_color' => 'Invalid color code'
            ]
        );

        $type->update($data);

        return to_route('admin.types.index')->with('type', 'success')->with('message', 'Type successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return to_route('admin.types.index')->with('type', 'danger')->with('message', "Type $type->label deleted");
    }
}
