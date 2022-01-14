<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class UserFactory extends Factory
{
    use HasRoles;

    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => 'System',
            'surnames' => 'admin',
            'document_type' => 'CC',
            'number_document' => '111111',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'enabled_at' => now(),
        ];
    }

    public function unverified(): Factory
    {
        return $this->state(function () {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function enabled(): Factory
    {
        return $this->state(function () {
            return [
                'enabled_at' => $this->faker->dateTime(),
            ];
        });
    }

    public function disabled(): Factory
    {
        return $this->state(function () {
            return [
                'enabled_at' => null,
            ];
        });
    }
}
