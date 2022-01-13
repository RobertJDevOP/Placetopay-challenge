<?php

namespace App\Factory;

class StripeApiWallet implements IGatewayApiWallet
{
    private string $email, $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function request(): void
    {
        echo "Send HTTP API request to log in user $this->email with " .
    "password $this->password </br>";

    }

    public function createPost($content): void
    {
        echo "Send HTTP API requests to create a post in LinkedIn timeline.</br>";
    }
}
