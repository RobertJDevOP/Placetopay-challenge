<?php

namespace Products;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class IndexTest extends  TestCase
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

    public function test_it_admin_can_list_products(): void
    {
        $response = $this->actingAs($this->admin)->get('/products');
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_it_admin_has_a_collection_of_products(): void
    {
        $response = $this->actingAs($this->admin)->get('/products');
        $response->assertViewHas('products');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['products']);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get('/products');
        $response->assertRedirect(route('login'));
    }

}
