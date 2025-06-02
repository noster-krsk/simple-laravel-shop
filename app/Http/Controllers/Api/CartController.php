<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Services\CartService;

class CartController extends Controller
{
    protected CartService $service;

    public function __construct(CartService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->service->fetchNewCarts();
        $productsLen = $this->service->fetchNewCartsLen();

        return response()->json([
            'data' => $products,
            'len' => $productsLen

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'clients' => 'required|string|max:255',
            'product_id' => 'required|integer',
        ]);

        $orderData = [
            'clients'     => $validated['clients'],
            'product_id'  => $validated['product_id'],
            'comment'     => $request->input('comment') || null,
            'quantity'    => $request->input('quantity', 1),
            'total_cost'  => $request->input('total_cost', 0),
        ];

        $order = $this->service->addOrder($orderData);

        return response()->json([
            'message' => 'Заказ оформлен',
            'product' => $order,
            'code' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         try {
            $this->service->updateCarts([
                'status' =>  $request->input('status'),
            ], $id);

            return response()->json(['message' => 'Данныез заказа обновлены!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка обновления товара!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
