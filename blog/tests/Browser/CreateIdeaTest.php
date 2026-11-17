<?php

use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());
   visit('/ideas')
       ->click('@create-idea-button')
       ->assertSee('New Idea')
       ->fill('title', 'Create a new idea')
       ->fill('description', 'Create a new idea wohoo')
       ->click('@submit-button')
       ->assertPathIs('/ideas');

        expect($user->ideas()->count())->toBe(1);


});
