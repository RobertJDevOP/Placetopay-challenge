<?php

namespace App\Contracts;


interface ApiInterface
{
    public  function request();

    public  function getResponse(Object $response);


}
