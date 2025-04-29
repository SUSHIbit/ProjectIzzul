<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Document;
use App\Models\Rubric;
use App\Models\Category;
use App\Models\User;
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

        $query = Document::with(['category', 'user', 'marks.rubric', 'marks.user']);
        
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        if ($title) {
            $query->where('title', 'like', "%{$title}%");
        }
        
        $documents = $query->get();
        $categories = Category::all();
        
        // Process each document to include evaluation data by lecturer
        foreach ($documents as $document) {
            // Group marks by user (lecturer)
            $document->marks_by_lecturer = $document->marks->groupBy('user_id');
            
            // Calculate total score, max score, and percentage for each lecturer's evaluation
            foreach ($document->marks_by_lecturer as $userId => $marks) {
                $totalScore = $marks->sum('score');
                $maxPossibleScore = 0;
                
                // Calculate max possible score for this set of marks
                foreach ($marks as $mark) {
                    $maxPossibleScore += $mark->rubric->max_score;
                }
                
                // Store the calculations with the marks
                $document->marks_by_lecturer[$userId]->total_score = $totalScore;
                $document->marks_by_lecturer[$userId]->max_possible_score = $maxPossibleScore;
                $document->marks_by_lecturer[$userId]->score_percentage = $maxPossibleScore > 0 
                    ? round(($totalScore / $maxPossibleScore) * 100, 2) 
                    : 0;
                
                // Group marks by rubric for display
                $document->marks_by_lecturer[$userId]->marks_by_rubric = $marks->groupBy('rubric_id');
            }
            
            // For backward compatibility and default display (current user's marks)
            $currentUserMarks = $document->marks->where('user_id', auth()->id());
            $document->total_score = $currentUserMarks->sum('score');
            $document->max_possible_score = 0;
            
            // Group marks by rubric for the current user for default display
            $document->marks_by_rubric = $currentUserMarks->groupBy('rubric_id');
            
            // Calculate max possible score for current user
            foreach ($currentUserMarks as $mark) {
                $document->max_possible_score += $mark->rubric->max_score;
            }
            
            // Calculate percentage for current user
            $document->score_percentage = $document->max_possible_score > 0 
                ? round(($document->total_score / $document->max_possible_score) * 100, 2) 
                : 0;
        }

        return view('marks.summary', compact('documents', 'categories', 'categoryId', 'title'));
    }

    /**
     * Display evaluation history for a specific document.
     */
    public function history(Document $document)
    {
        $document->load(['category', 'user', 'marks.rubric', 'marks.user']);
        
        // Group marks by user (lecturer)
        $document->marks_by_lecturer = $document->marks->groupBy('user_id');
        
        // Calculate total score, max score, and percentage for each lecturer's evaluation
        foreach ($document->marks_by_lecturer as $userId => $marks) {
            $totalScore = $marks->sum('score');
            $maxPossibleScore = 0;
            
            // Calculate max possible score for this set of marks
            foreach ($marks as $mark) {
                $maxPossibleScore += $mark->rubric->max_score;
            }
            
            // Store the calculations with the marks
            $document->marks_by_lecturer[$userId]->total_score = $totalScore;
            $document->marks_by_lecturer[$userId]->max_possible_score = $maxPossibleScore;
            $document->marks_by_lecturer[$userId]->score_percentage = $maxPossibleScore > 0 
                ? round(($totalScore / $maxPossibleScore) * 100, 2) 
                : 0;
            
            // Group marks by rubric for display
            $document->marks_by_lecturer[$userId]->marks_by_rubric = $marks->groupBy('rubric_id');
        }
        
        return view('marks.history', compact('document'));
    }
}