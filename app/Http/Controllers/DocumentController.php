<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyDocumentRequest;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('throttle:10,1')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = $request->user()->documents()->latest()->get();

        return Inertia::render('Document/Index', [
            'documents' => DocumentResource::collection($documents), 
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
            'name' => Str::of($request->file->getClientOriginalName())->limit(40),
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
        $this->authorize('view', $document);

        return Storage::download($document->path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\DestroyDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyDocumentRequest $request)
    {
        $this->authorize('delete', [Document::class, $request->documents]);

        Document::whereIn('slug', $request->documents)->delete();

        return Redirect::route('documents.index')
            ->with('status', 'Your documents were successfully deleted');
    }
}
