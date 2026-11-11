<?php



test('register a user', function() {
    visit('/register')
        ->fill('name','Pera Peric')
        ->fill('email','peraperic@gmail.com')
        ->fill('password','password')
        ->press('Create Account')
        ->assertSee('Home page');

    $this->assertAuthenticated();
    expect(Auth::user())->toMatchArray([
        'name' => 'Pera Peric',
        'email' => 'peraperic@gmail.com'
    ]);
});

test('failed registration name', function() {
   $this->visit('/register')
       ->fill('name','Pe')
       ->fill('email','pera@gmail.com')
       ->fill('password','password')
       ->click('Create Account')
       ->assertSee('The name field must be at least 3 characters.');
});


test('failed registration email', function() {
    $this->visit('/register')
        ->fill('name','Pera Peric')
        ->fill('email','pera@')
        ->fill('password','password')
        ->click('Create Account')
        ->assertPresent('input[name="email"]:invalid');

});
