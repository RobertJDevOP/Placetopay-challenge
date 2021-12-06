<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
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

    public function test_it_admin_can_list_users(): void
    {
        $response = $this->actingAs($this->admin)->get('/users');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_admin_has_a_collection_of_users(): void
    {
        $response = $this->actingAs($this->admin)->get('/users');
        $response->assertViewHas('users');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['users']);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get('/users');
        $response->assertRedirect(route('login'));
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
            'success' => 'Client rcjimenez35@gmail.com are enabled',
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
