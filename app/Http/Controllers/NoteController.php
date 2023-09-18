<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Note::class, 'note');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter = Request::input('filter');
        if (!is_string($filter)) {
            $filter = '';
        }

        $notes = Note::where('user_id', auth()->user()->id)
            ->when($filter, function ($query) use ($filter) {
                $query->where(function($query) use ($filter) {
                    $query->where('title', 'like', "%{$filter}%")
                        ->orWhere('content', 'like', "%{$filter}%");
                });
            })
            ->paginate(10);

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
        Note::create(
            $request->safe()
                ->merge(['user_id' => auth()->user()->id])
                ->only('user_id', 'title', 'content')
        );

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
        $this->authorize('view', $note);
        $this->authorize('create', Note::class);

        $new_note = $note->replicate();
        $new_note->title = $note->title . ' - Αντίγραφο';
        $new_note->save();

        return to_route('note.index');
    }
}
