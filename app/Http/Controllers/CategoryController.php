<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id', 'name')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $validated = $request->validated();
        $category = Category::create([
            'name' => $validated['name']
        ]);
        return redirect()->route('categories.index')->with(['success' => 'The category was successfully added']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Category::find($id);
        if (empty($data)) {
            return redirect()->route('categories.index')->with(['error' => 'Unable to access data']);
        }
        return view('categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateCategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $data = Category::find($id);
        $data->update([
            'name' => $validated['name'] ?? $data->name
        ]);
        return redirect()->route('categories.index')->with(['success' => 'The Category has been successfully edited.']);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Category::where('id', '=', $id)->Delete();
        return redirect()->route('categories.index')->with(key: ['success' => 'The category has been successfully deleted']);
    }
}
