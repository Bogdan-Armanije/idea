<?php

use App\Models\User;

it('Log in a user', function ()  {
    $user = User::factory()->create(['password' => 'password']);
    visit('/login')
        ->fill('email',$user->email)
        ->fill('password','password')
        ->click('@login-button')
        ->assertPathIs('/ideas');

    $this->assertAuthenticated();
});

it('log out', function () {
   $user = User::factory()->create();

   $this->actingAs($user);
   visit('/')->click('Logout');


   $this->assertGuest();

});
