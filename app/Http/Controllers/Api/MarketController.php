<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Market;

class MarketController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $markets = Market::get();
        return $this->apiResponse($markets,'Ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $market = Market::find($id);
        
        if($market)
        {
            return $this->apiResponse($market,'Ok',200);
        }

        return $this->apiResponse(null,'The Market Not Found',404);
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
            'name'                => 'required|max:255',
            'image'               => 'required',
            'address'             => 'required',
            'location'            => 'required',
            'workingTime'         => 'required',
            'rate'                => 'required',
            'favourite'           => 'required',
            'sub_sub_category_id' => 'required',
            'country_id'          => 'required'
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $market = Market::create($request->all());

        if($market)
        {
            return $this->apiResponse($market,'The Market Saved',201);
        }

        return $this->apiResponse(null,'The Market Not Save',400);
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
            'name'                => 'required|max:255',
            //'image'               => '',
            'address'             => 'required',
            'location'            => 'required',
            //'workingTime'         => '',
            //'rate'                => '',
            //'favourite'           => '',
            'sub_sub_category_id' => 'required',
            'country_id'          => 'required'
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $market = Market::find($id);

        if(!$market)
        {
            return $this->apiResponse(null,'The Market Not Found',404);
        }

        $market->update($request->all());

        if($market)
        {
            return $this->apiResponse($market,'The Market Update',201);
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
        $market = Market::find($id);

        if(!$market)
        {
            return $this->apiResponse(null,'The Market Not Found',404);
        }

        $market->delete($id);

        if($market)
        {
            return $this->apiResponse(null,'The Market Deleted',200);
        }
    }
}
