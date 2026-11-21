<?php

use App\Models\User;
use App\Notifications\EmailChanged;
use Illuminate\Support\Facades\Notification;

it('requires authentication', function () {
    $this->get(route('profile.edit'))->assertRedirect('/login');
});

it('edits a profile', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->fill('name', 'John Doe')
        ->assertValue('email', $user->email)
        ->fill('email', 'johndoe@example.net')
        ->click('@update-profile-button')
        ->assertSee('Your profile has been updated.');

    expect($user->fresh())->toMatchArray([
        'name' => 'John Doe',
        'email' => 'johndoe@example.net'
    ]);
});

it('notifies the original email if updated', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Notification::fake();

    $oldEmail = $user->email;

    visit(route('profile.edit'))
        ->assertValue('name', $user->name)
        ->fill('name', 'John Doe')
        ->assertValue('email', $user->email)
        ->fill('email', 'johndoe@example.net')
        ->click('@update-profile-button')
        ->assertSee('Your profile has been updated.');

    Notification::assertSentOnDemand(EmailChanged::class, fn(EmailChanged $notification, $routes, $notifiable) => $notifiable->routes['mail'] === $oldEmail);
});
