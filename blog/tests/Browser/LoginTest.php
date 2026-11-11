<?php

use App\Models\User;

test('Log in a user', function ()  {
    $user = User::factory()->create(['password' => 'password']);
    visit('/login')
        ->fill('email',$user->email)
        ->fill('password','password')
        ->click('@login-button')
        ->assertPathIs('/');

    $this->assertAuthenticated();
});

test('log out', function () {
   $user = User::factory()->create();

   $this->actingAs($user);
   visit('/')->click('Logout');


   $this->assertGuest();

});
