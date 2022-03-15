<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Validator;


class ShopController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $shopss = Shop::get();
        return $this->apiResponse($shopss,'Ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        if($shop)
        {
            return $this->apiResponse($shop,'Ok',200);
        }
        return $this->apiResponse(null,'The Shop Not Found',404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'        => 'required',
            'image'       => 'required',
            'products'    => 'required',
            'phones'      => 'required',
            'workingTime' => 'required',
            'country'     => 'required',
            'region'      => 'required',
            'category'    => 'required',
            'rate'        => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $shop = Shop::create($request->all());

        if($shop)
        {
            return $this->apiResponse($shop,'The Shop Save',201);
        }

        return $this->apiResponse(null,'The Shop Not Save',400);
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
        $validator  = Validator::make($request->all(),
        [
            'name'        => 'required',
            'image'       => 'required',
            'products'    => 'required',
            'phones'      => 'required',
            'workingTime' => 'required',
            'country'     => 'required',
            'region'      => 'required',
            'category'    => 'required',
            'rate'        => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $shop = Shop::find($id);

        if(!$shop)
        {
            return $this->apiResponse(null,'The Shop Not Found',404);
        }

        $shop->update($request->all());

        if($shop)
        {
            return $this->apiResponse($shop,'The Shop Update',201);
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
        $shop = Shop::find($id);

        if(!$shop)
        {
            return $this->apiResponse(null,'The Post Not Found',404);
        }

        $shop->delete($id);

        if($shop)
        {
            return $this->apiResponse(null,'The Post Deleted',200);
        }
    }
}
