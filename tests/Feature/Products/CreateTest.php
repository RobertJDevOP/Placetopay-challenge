<?php

namespace Products;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends  TestCase
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
    public function registration_screen_can_be_rendered()
    {
        $response = $this->actingAs($this->admin)->get('product/create');
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function a_user_can_view_the_create_product_form()
    {
        $response = $this->actingAs($this->admin)->get('product/create');
        $response->assertOk();
        $response->assertViewIs('products.create');
        $response->assertSeeText('Create a new product');
    }
}
