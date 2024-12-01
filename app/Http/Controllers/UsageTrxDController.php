<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\UsageTrxD;
use App\Models\UsageTrxH;
use Illuminate\Http\Request;

class UsageTrxDController extends Controller
{
    private $usageTrxDAllocController;
    public function __construct(UsageTrxDAllocController $usageTrxDAllocController)
    {
        $this->usageTrxDAllocController = $usageTrxDAllocController;
    }

    public function InsertUsageTrxD(Request $request, UsageTrxH $usageTrxH)
    {
        if($usageTrxH == null || $request == null){
            throw new \Exception('Request Or Usage Transaction H is Null!');
        }
        $listRequestProducts = $request->input('products' , []);
        foreach($listRequestProducts as $item){
            $product = Product::where('product_code', $item['productCode'])->first();
            if (!$product) {
                throw new \Exception("Product with code {$item['productCode']} not found!");
            }

            $usageTrxD = new UsageTrxD();
            $usageTrxD->product_id = $product->id;
            $usageTrxD->product_name = $product->product_name;
            $usageTrxD->product_amt = $item['productAmt'];
            $usageTrxD->notes = $item['notes'] ?? "";

            $usageTrxH->UsageTrxD()->save($usageTrxD);
            $this->usageTrxDAllocController->InsertUsageTrxDAlloc($usageTrxD);

        }

    }
}
