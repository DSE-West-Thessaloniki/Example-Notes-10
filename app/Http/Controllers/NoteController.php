<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter = Request::input('filter');
        if (!is_string($filter)) {
            $filter = '';
        }

        $notes = Note::when($filter, function ($query) use ($filter) {
            $query->where('title', 'like', "%{$filter}%")
                ->orWhere('content', 'like', "%{$filter}%");
        })->get();

        return Inertia::render('Note/Index', [
            'notes' => $notes,
            'filters' => ['filter' => $filter],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Note/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        Note::create($request->validated());

        return to_route('note.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return Inertia::render('Note/Edit', [
            "note" => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->fill($request->safe()->only('title', 'content'));
        $note->save();

        return to_route('note.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return to_route('note.index');
    }

    public function copy(Note $note)
    {
        $new_note = $note->replicate();
        $new_note->title = $note->title . ' - Αντίγραφο';
        $new_note->save();

        return to_route('note.index');
    }
}
