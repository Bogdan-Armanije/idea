<?php

use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());
   visit('/ideas')
       ->click('@create-idea-button')
       ->assertSee('Create Idea')
       ->fill('title', 'Create a new idea')
       ->fill('description', 'Create a new idea wohoo')
       ->fill('@new-link', 'https://www.instagram.com/')
       ->click('@submit-new-link-button')
       ->fill('@new-link', 'https://www.youtube.com/')
       ->click('@submit-new-link-button')
       ->fill('@new-step', 'lolololol')
       ->click('@submit-new-step-button')
       ->click('@submit-button')
       ->click('@create-idea-button');



        expect($idea = $user->ideas()->first())->toMatchArray([
            'title' => 'Create a new idea',
            'description' => 'Create a new idea wohoo',
            'links' => ['https://www.instagram.com/', 'https://www.youtube.com/'],
            'status' => 'pending',
        ])
            ->and($idea->steps()->first())->toMatchArray([
                'description' => 'lolololol',
            ]);

});
