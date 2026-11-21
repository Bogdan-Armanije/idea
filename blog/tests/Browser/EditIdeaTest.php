<?php

use App\Models\Idea;
use App\Models\User;

it('edits an existing idea', function () {
    $this->actingAs($user = User::factory()->create());

    $idea = Idea::factory()->for($user)->create();

    visit(route('idea.show', $idea))
        ->click('@edit-idea-button')
        ->fill('title', 'Test Idea')
        ->click('@button-status-completed')
        ->fill('description', 'This is a test idea created during browser testing.')
        ->fill('@new-link', 'https://youtube.com')
        ->click('@submit-new-link-button')
        ->fill('@new-link', 'https://laravel.com')
        ->click('@submit-new-link-button')
        ->fill('@new-step', 'First step of the idea')
        ->click('@submit-new-step-button')
        ->fill('@new-step', 'Second step of the idea')
        ->click('@submit-new-step-button')
        ->click('Update')
        ->assertRoute('idea.show', [$idea]);

    $idea = $user->ideas()->first();

    expect($idea)->toMatchArray([
        'title' => 'Test Idea',
        'description' => 'This is a test idea created during browser testing.',
        'status' => 'completed',
    ]);

    expect($idea->links->toArray())->toBe([
        $idea->links[0],
        'https://youtube.com',
        'https://laravel.com',
    ]);

    $idea = $user->ideas()->with('steps')->first();

    expect($idea->steps)->toHaveCount(2);

    expect($idea->steps->pluck('description')->toArray())->toBe([
        'First step of the idea',
        'Second step of the idea',
    ]);
});
