<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // make policies for who can view the file
        // make api responses for documents

        return Inertia::render('Document/Index', [
            'documents' => [1,2,3], 
            'status' => session('status'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Document/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentRequest $request)
    {
        $document = new Document([
            'name' => Str::of($request->file->getClientOriginalName())->limit(20),
            'type' => $request->file->extension(),
            'size' => $request->file->getSize(),
            'path' => $request->file->store('documents', ['visibility' => 'private']),
        ]);
        
        $request->user()->documents()->save($document);

        return Redirect::route('documents.index')
            ->with('status', 'Your document was uploaded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        // download file here
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        // should refactor route to enable bulk delete
    }
}
