<?php

namespace App\Console\Commands;

use App\FactoryMethod\FactoryApiWalletGateway;
use App\FactoryMethod\PlaceToPayFactory;
use App\Models\PurchaseOrder;
use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;

class UpdatePaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:UpdatePaymentStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command refresh payment purchase order history';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

    /*
    $purchaseOrders=PurchaseOrder::select('requestId')
              ->where('status', '=', 'PENDING')
               ->get();

        foreach ($purchaseOrders as $row){
            $getApiResponse= createGetRequestInformationWallet(new PlaceToPayFactory(null,$row->requestId));
        }*/



        return Command::SUCCESS;

    }
}

function createGetRequestInformationWallet(FactoryApiWalletGateway $creator): JsonResponse
{
    return $creator->apiRequestStatus();
}
