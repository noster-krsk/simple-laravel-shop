<?php

namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Http\Resources\PriceItemResource;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index()
    {
        $products = Price::all();
        return PriceItemResource::collection($products);
    }
}
