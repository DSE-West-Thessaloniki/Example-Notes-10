<?php

use App\Models\Note;
use App\Models\User;

it('creates a new note as user', function () {
    $user = User::factory()->create();
    $note = ['title' => 'Test Note', 'content' => 'This is a test!'];

    $this->actingAs($user)->post('/note', $note)
        ->assertRedirect('/note');

    $this->assertDatabaseHas('notes', $note);
});

it('updates a new note as user', function () {
    $user = User::factory()->create();
    $note = Note::create(['title' => 'Test Note', 'content' => 'This is a test', 'user_id' => $user->id]);
    $updated_note = [
        'title' => 'Test Note - Updated',
        'content' => 'This is an updated test'
    ];

    $this->actingAs($user)->put("/note/{$note->id}", $updated_note)
        ->assertRedirect('/note');

    $this->assertDatabaseHas('notes', $updated_note);
});
