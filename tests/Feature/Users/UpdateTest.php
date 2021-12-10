<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan("db:seed", ['--class' => 'RoleSeeder']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }


    /** @test */
    public function admins_can_edit_client_email()
    {
        $this->withoutExceptionHandling();

        $this->setupUser();

        $response = $this
            ->actingAs($this->admin)
            ->get('/users/rcjimenez35@gmail.com/edit');

        $response->assertStatus(200);
    }


    public  function  test_it_can_enabled_client()
    {
        $this->setupUser();

        $response = $this
            ->actingAs($this->admin)
            ->put('/users/rcjimenez35@gmail.com/status', [
                'validation' => 'enabled'
            ]);

        $response->assertSessionHasAll([
            'success' => 'User status is updated',
        ]);
    }


    protected function setupUser()
    {
        User::factory()->create([
            'name' => 'Roberto Jimenez',
            'email' => 'rcjimenez35@gmail.com',
            'password' => 'password'
        ]);
    }

}
