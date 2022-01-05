<?php

namespace App\FactoryMethod;
//Fabrica de objetos
abstract class FactoryPaymentGateway
{
    /**
     * The actual factory method. Note that it returns the abstract connector.
     * This lets subclasses return any concrete connectors without breaking the
     * superclass' contract.
     */
    abstract public function getFactoryPaymentGateway(): IPaymentGatewayApi;

    /**
     * When the factory method is used inside the Creator's business logic, the
     * subclasses may alter the logic indirectly by returning different types of
     * the connector from the factory method.
     */
    public function connectApi(): void
    {
        $network = $this->getFactoryPaymentGateway();
        $network->request();
        //$network->createPost();
    }
}

