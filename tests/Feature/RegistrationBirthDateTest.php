<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('users can register with their birth date', function () {
    $birthDate = now()->subYears(25)->toDateString();

    $this->post('/register', [
        'username' => 'pelamar-baru',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'birth_date' => $birthDate,
    ])
        ->assertRedirect(route('home'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'username' => 'pelamar-baru',
        'birth_date' => $birthDate,
    ]);
});

test('registration rejects users younger than thirteen', function () {
    $this->from(route('register'))
        ->post('/register', [
            'username' => 'pelamar-muda',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'birth_date' => now()->subYears(12)->toDateString(),
        ])
        ->assertRedirect(route('register'))
        ->assertSessionHasErrors('birth_date');
});
