<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get();
        return $this->apiResponse($countries,'Ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        
        if($country)
        {
            return $this->apiResponse($country,'Ok',200);
        }

        return $this->apiResponse(null,'The Country Not Found',404);
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
            'name' => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $country = Country::create($request->all());

        if($country)
        {
            return $this->apiResponse($country,'The Country Saved',201);
        }

        return $this->apiResponse(null,'The Country Not Save',400);
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
            'name' => 'required|max:255',
        ]);
        
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $country = Country::find($id);

        if(!$country)
        {
            return $this->apiResponse(null,'The Country Not Found',404);
        }

        $country->update($request->all());

        if($country)
        {
            return $this->apiResponse($country,'The Country Update',201);
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
        $country = Country::find($id);

        if(!$country)
        {
            return $this->apiResponse(null,'The Country Not Found',404);
        }

        $country->delete($id);

        if($country)
        {
            return $this->apiResponse(null,'The Country Deleted',200);
        }
    }
}
