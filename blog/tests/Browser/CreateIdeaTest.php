<?php

use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());
   visit('/ideas')
       ->click('@create-idea-button')
       ->assertSee('New Idea')
       ->fill('title', 'Create a new idea')
       ->fill('description', 'Create a new idea wohoo')
       ->fill('@new-link', 'https://www.instagram.com/')
       ->click('@submit-new-link-button')
       ->fill('@new-link', 'https://www.instagram.com/')
       ->click('@submit-new-link-button')
       ->debug()
       ->click('@submit-button')
       ->assertPathIs('/ideas');

        expect($user->ideas()->first())->toMatchArray([
            'title' => 'Create a new idea',
            'description' => 'Create a new idea wohoo',
            'links' => ['https://www.instagram.com/']
        ]);


});
