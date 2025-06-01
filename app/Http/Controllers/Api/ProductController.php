<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    protected ProductService $service;

    public function __construct(ProductService $service)
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
        $products = $this->service->getAllProducts();

        return response()->json([
            'data' => $products,
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = $this->service->addProduct([
            'name' => $data['name'],
            'category_id' => $data['category'],  
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
        ]);

        return response()->json([
            'message' => 'Товар добавлен',
            'product' => $product,
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);


        try {
            $this->service->updateProduct([
                'name' => $data['name'],
                'category_id' => $data['category'],  
                'description' => $data['description'] ?? null,
                'price' => $data['price'],
            ], $id);

            return response()->json(['message' => 'Данные товара '.$data['name'].' обновлены!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ошибка обновления товара '.$data['name']], 500);
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
        try {
            $this->service->deleteById($id);
            return response()->json(['message' => 'Удалено успешно']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Товар не найден'], 404);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Ошибка сервера'], 500);
        }
    }
}
