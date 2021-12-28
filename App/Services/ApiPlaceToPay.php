<?php

namespace App\Services;

class ApiPlaceToPay extends Base
{

    public string $endopint ;

    public array $params;

    public array $body;

    public function  __construct ($end,$params,$body){

        $this->endopint = $end;
        $this->params = $params;
        $this->body = $body;

    }
}
