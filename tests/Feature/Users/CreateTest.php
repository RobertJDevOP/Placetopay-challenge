<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function a_user_can_view_the_create_form()
    {
        $response = $this->get('/register');
        $response->assertOk();
        $response->assertViewIs('auth.register');
        $response->assertSeeText('Sign up');
    }
}
