<?php

namespace App\Http\Controllers;

use App\Models\Rubric;
use App\Models\Category;
use Illuminate\Http\Request;

class RubricController extends Controller
{
    /**
     * Display a listing of the rubrics.
     */
    public function index()
    {
        $rubrics = Rubric::with('category')->get();
        return view('rubrics.index', compact('rubrics'));
    }

    /**
     * Show the form for creating a new rubric.
     */
    public function create()
    {
        $categories = Category::all();
        return view('rubrics.create', compact('categories'));
    }

    /**
     * Store a newly created rubric in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'max_score' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        Rubric::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'max_score' => $request->max_score,
        ]);

        return redirect()->route('rubrics.index')
            ->with('success', 'Rubric created successfully.');
    }

    /**
     * Display the specified rubric.
     */
    public function show(Rubric $rubric)
    {
        return view('rubrics.show', compact('rubric'));
    }

    /**
     * Show the form for editing the specified rubric.
     */
    public function edit(Rubric $rubric)
    {
        $categories = Category::all();
        return view('rubrics.edit', compact('rubric', 'categories'));
    }

    /**
     * Update the specified rubric in storage.
     */
    public function update(Request $request, Rubric $rubric)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'max_score' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $rubric->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'max_score' => $request->max_score,
        ]);

        return redirect()->route('rubrics.index')
            ->with('success', 'Rubric updated successfully.');
    }

    /**
     * Remove the specified rubric from storage.
     */
    public function destroy(Rubric $rubric)
    {
        // Check if rubric has related marks
        if ($rubric->marks()->exists()) {
            return redirect()->route('rubrics.index')
                ->with('error', 'Cannot delete rubric because it has related marks.');
        }

        $rubric->delete();

        return redirect()->route('rubrics.index')
            ->with('success', 'Rubric deleted successfully.');
    }
}