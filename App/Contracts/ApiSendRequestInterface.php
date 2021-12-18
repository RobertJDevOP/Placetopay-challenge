<?php

namespace App\Contracts;


interface ApiSendRequestInterface
{
    public  function request(string $endpoint,Object $params);
}
