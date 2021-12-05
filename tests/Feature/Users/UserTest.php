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

    public function test_it_can_list_users(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/users');
        $response->assertStatus(Response::HTTP_OK);
    }
    public function test_it_has_a_collection_of_users(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/users');
        $response->assertViewHas('users');
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getOriginalContent()['users']);
    }

    public function test_a_guest_user_cannot_access(): void
    {
        $response = $this->get('/users');
        $response->assertRedirect(route('login'));
    }


}
