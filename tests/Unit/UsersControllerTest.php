<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_render_users_index_page()
    {

        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    public function it_can_store_a_user()
    {
        $this->withoutExceptionHandling();

        $userData = [
            'name' => 'John Doe',
            'id_card' => 'unique_id_card', // Ensure this is unique for each test
            'last_name' => 'Doe',
            'phone' => '123456789',
            'email' => 'test@example.com', // Ensure this is unique for each test
            'password' => 'password123',
            'user_account' => 1,
            // Add other required fields as needed
        ];

        $response = $this->post(route('users.store'), $userData);

        $response->assertRedirect(); // Check if the response is a redirect
        $response->assertSessionHas('success'); // Ensure that the success message is flashed to the session

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'id_card' => 'unique_id_card', // Ensure this is unique for each test
            'last_name' => 'Doe',
            'phone' => '123456789',
            'email' => 'test@example.com', // Ensure this is unique for each test
            // Add other expected values
        ]);

        // Add additional assertions if needed
    }

    public function it_can_update_a_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create(); // Create a user for testing

        $userData = [
            'name' => 'Updated Name',
            'id_card' => 'updated_unique_id_card', // Ensure this is unique for each test
            'last_name' => 'Updated Last Name',
            'phone' => '987654321',
            'email' => 'updated_test@example.com', // Ensure this is unique for each test
            'password' => 'updated_password123',
            'user_account' => 1,
            // Add other updated fields as needed
        ];

        $response = $this->put(route('users.update', $user), $userData);

        $response->assertRedirect(); // Check if the response is a redirect
        $response->assertSessionHas('success'); // Ensure that the success message is flashed to the session

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'id_card' => 'updated_unique_id_card', // Ensure this is unique for each test
            'last_name' => 'Updated Last Name',
            'phone' => '987654321',
            'email' => 'updated_test@example.com', // Ensure this is unique for each test
            // Add other expected values
        ]);

        // Add additional assertions if needed
    }
}