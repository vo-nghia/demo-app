<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Services\ProductService;

class ProductsController extends Controller
{
    use ResponseTrait;

    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->getList();
        return $this->success(['data' => $products]);
    }

    /**
     * Count products
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        $count = $this->productService->getShopifyProductsCount();
        return $this->success(['count' => $count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       dd($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate(['title' => 'required|string']);
        $this->productService->create($validatedData);
        return $this->success(['message' => 'Createw new product successful']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->get($id);
        return $this->success(['data' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productService->deleteShopifyProducts($id);
        return response()->json(['message' => 'Delete Product successful']);
    }

    public function sync()
    {
        $this->productService->syncShopifyProducts();
        return response()->json(['message' => 'Product sync successful']);
    }
}
