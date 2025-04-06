<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('auth:register', function () {
    it('creates new user', function () {
        $password = fake()->password(8);
        $data = [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
    });

    it('prevents same email', function () {
        $user = User::factory()->create();
        $password = fake()->password(8);
        $data = [
            'name' => fake()->name(),
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(422);
    });
});

describe('auth:login', function () {
    it('authenticates a user', function () {
        $password = fake()->password(8);
        $user = User::factory()->create([
            'password' => $password
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertOk()->assertJsonStructure([
            'token'
        ]);
    });
});
