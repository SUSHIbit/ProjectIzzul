<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Document;
use App\Models\Rubric;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    /**
     * Display a listing of documents available for evaluation.
     */
    public function index()
    {
        $documents = Document::with(['category', 'user', 'marks'])
            ->get()
            ->map(function ($document) {
                $document->marked = $document->marks()->where('user_id', auth()->id())->exists();
                return $document;
            });
            
        return view('marks.index', compact('documents'));
    }

    /**
     * Show the form for creating new marks for a document.
     */
    public function create(Document $document)
    {
        // Check if document already has marks from this user
        if ($document->marks()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('marks.index')
                ->with('error', 'You have already evaluated this document.');
        }

        $rubrics = Rubric::where('category_id', $document->category_id)->get();
        
        if ($rubrics->isEmpty()) {
            return redirect()->route('marks.index')
                ->with('error', 'No rubrics found for this document category.');
        }

        return view('marks.create', compact('document', 'rubrics'));
    }

    /**
     * Store new marks for a document.
     */
    public function store(Request $request, Document $document)
    {
        // Check if document already has marks from this user
        if ($document->marks()->where('user_id', auth()->id())->exists()) {
            return redirect()->route('marks.index')
                ->with('error', 'You have already evaluated this document.');
        }

        $rubrics = Rubric::where('category_id', $document->category_id)->get();
        
        foreach ($rubrics as $rubric) {
            $request->validate([
                "score_{$rubric->id}" => ['required', 'integer', 'min:0', 'max:' . $rubric->max_score],
                "feedback_{$rubric->id}" => ['nullable', 'string'],
            ]);

            Mark::create([
                'document_id' => $document->id,
                'user_id' => auth()->id(),
                'rubric_id' => $rubric->id,
                'score' => $request->input("score_{$rubric->id}"),
                'feedback' => $request->input("feedback_{$rubric->id}"),
            ]);
        }

        return redirect()->route('marks.index')
            ->with('success', 'Document evaluated successfully.');
    }

    /**
     * Display a summary of all marks.
     */
    public function summary(Request $request)
    {
        $categoryId = $request->input('category_id');
        $title = $request->input('title');

        $query = Document::with(['category', 'user', 'marks.rubric']);
        
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        if ($title) {
            $query->where('title', 'like', "%{$title}%");
        }
        
        $documents = $query->get();
        $categories = Category::all();
        
        // Calculate total score for each document
        foreach ($documents as $document) {
            $document->total_score = $document->marks->sum('score');
            $document->max_possible_score = 0;
            
            // Group marks by document for display
            $document->marks_by_rubric = $document->marks->groupBy('rubric_id');
            
            // Calculate max possible score
            foreach ($document->marks as $mark) {
                $document->max_possible_score += $mark->rubric->max_score;
            }
            
            // Calculate percentage
            $document->score_percentage = $document->max_possible_score > 0 
                ? round(($document->total_score / $document->max_possible_score) * 100, 2) 
                : 0;
        }

        return view('marks.summary', compact('documents', 'categories', 'categoryId', 'title'));
    }
}