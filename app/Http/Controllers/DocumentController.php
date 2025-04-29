<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the documents.
     */
    public function index()
    {
        $documents = Document::with(['category', 'user'])->where('user_id', auth()->id())->get();
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        $categories = Category::all();
        return view('documents.create', compact('categories'));
    }

    /**
     * Store a newly created document in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
        ]);

        // Store the file
        $path = $request->file('file')->store('documents', 'public');

        Document::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'file_path' => $path,
        ]);

        return redirect()->route('documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified document.
     */
    public function show(Document $document)
    {
        // Check if the document belongs to the current user
        if ($document->user_id !== auth()->id()) {
            return redirect()->route('documents.index')
                ->with('error', 'You do not have permission to view this document.');
        }

        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified document.
     */
    public function edit(Document $document)
    {
        // Check if the document belongs to the current user
        if ($document->user_id !== auth()->id()) {
            return redirect()->route('documents.index')
                ->with('error', 'You do not have permission to edit this document.');
        }

        $categories = Category::all();
        return view('documents.edit', compact('document', 'categories'));
    }

    /**
     * Update the specified document in storage.
     */
    public function update(Request $request, Document $document)
    {
        // Check if the document belongs to the current user
        if ($document->user_id !== auth()->id()) {
            return redirect()->route('documents.index')
                ->with('error', 'You do not have permission to update this document.');
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
        ]);

        // Update document data
        $document->title = $request->title;
        $document->category_id = $request->category_id;

        // Update file if a new one is uploaded
        if ($request->hasFile('file')) {
            // Delete old file
            Storage::disk('public')->delete($document->file_path);
            
            // Store new file
            $path = $request->file('file')->store('documents', 'public');
            $document->file_path = $path;
        }

        $document->save();

        return redirect()->route('documents.index')
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(Document $document)
    {
        // Check if the document belongs to the current user
        if ($document->user_id !== auth()->id()) {
            return redirect()->route('documents.index')
                ->with('error', 'You do not have permission to delete this document.');
        }

        // Check if document has related marks
        if ($document->marks()->exists()) {
            return redirect()->route('documents.index')
                ->with('error', 'Cannot delete document because it has related marks.');
        }

        // Delete file
        Storage::disk('public')->delete($document->file_path);
        
        // Delete document
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document deleted successfully.');
    }
}