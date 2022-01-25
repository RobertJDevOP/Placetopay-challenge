<?php


namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreTest extends  TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function new_users_can_register(): void
    {
       $this->post('/register', [
                'name' => 'Robertico',
                'surnames' => 'Carlos',
                'email' => 'abc@hotmail.com',
                'password' => '123456789',
                'password_confirmation' => '123456789',
                'document_type' => 'CC',
                'user_street' => 'Barrio bucarica blq 17',
                'cell_phone' => '123456789',
                'number_document' => '1095838453',
                ]);

        $userA = User::orderBy('id', 'desc')->first();


        $this->assertEquals('Robertico', $userA->name);
        $this->assertEquals('abc@hotmail.com', $userA->email);
        $this->assertEquals('CC', $userA->document_type);
        $this->assertTrue(Hash::check('123456789', $userA->password));
    }

    /**
     * @test
     * @dataProvider usersDataProvider
     */
    public function it_cannot_save_user_when_data_is_incorrect(string $field,mixed $value = null): void
    {
        $data = [
            'name' => 'Rob',
            'email' => 'abc-xti-com',
            'password' => '2939',
            'password_confirmation' => 'sadasd123',
        ];
        $data[$field] = $value;

        $response = $this->post('/register', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors($field);
    }

    /**
     * @test
     */
    public function it_cannot_save_user_with_not_unique_email(): void
    {
        User::factory()->create();

        $data = [
            'name' => 'Robertico',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $data);

        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
    }

    public function usersDataProvider(): array
    {
        return [
            'required' => ['name', null],
            'Test email is required' => ['email', null],
            'Test password is required' => ['password', null],
            'Test password is too short' => ['password', 'asd'],
        ];
    }
}
