<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return $this->apiResponse($products,'Ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        if($product)
        {
            return $this->apiResponse($product,'Ok',200);
        }

        return $this->apiResponse(null,'The Product Not Found',404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'name'   => 'required|max:255',
            'price'  => 'required',
            'status' => 'required',
            'rate'   => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $product = Product::create($request->all());

        if($product)
        {
            return $this->apiResponse($product,'The Product Saved',201);
        }

        return $this->apiResponse(null,'The Product Not Saved',400);
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
        $validator  = Validator::make($request->all(),
        [
            'name'   => 'required|max:255',
            'price'  => 'required',
            'status' => 'required',
            'rate'   => 'required',
        ]);
        
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $product = Product::find($id);

        if(!$product)
        {
            return $this->apiResponse(null,'The Product Not Found',404);
        }

        $product->update($request->all());

        if($product)
        {
            return $this->apiResponse($product,'The Product Updated',201);
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
        $product = Product::find($id);

        if(!$product)
        {
            return $this->apiResponse(null,'The Product Not Found',404);
        }

        $product->delete($id);

        if($product)
        {
            return $this->apiResponse(null,'The Product Deleted',200);
        }
    }
}
