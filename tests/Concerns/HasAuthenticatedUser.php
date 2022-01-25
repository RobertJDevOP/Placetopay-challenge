<?php

namespace Tests\Concerns;

use App\Models\User;

trait HasAuthenticatedUser
{
    protected User $admin;

    public function defaultUser(): User
    {
        $this->setupUser();
        $this->artisan("db:seed", ['--class' => 'RoleSeeder']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');

        return $this->admin;
    }

    protected function setupUser(): void
    {
        User::factory()->create([
            'name' => 'Roberto Jimenez',
            'email' => 'rcjimenez35@gmail.com',
            'password' => 'password'
        ]);
    }
}
