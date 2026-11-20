<?php

use App\Models\Idea;
use App\Models\User;

it('required auth', function () {

    $idea= Idea::factory()->create();

    $this->get(route('idea.show',$idea))->assertRedirectToRoute('login');
});

it('disallows accessing someone else idea', function () {

    $user=User::factory()->create();

    $this->actingAs(User::factory()->create());
    $idea= Idea::factory()->create();

    $this->get(route('idea.show',$idea))->assertForbidden();
});
