<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;

class RegionController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::get();
        return $this->apiResponse($regions,'Ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $region = Region::find($id);
        
        if($region)
        {
            return $this->apiResponse($region,'Ok',200);
        }

        return $this->apiResponse(null,'The Region Not Found',404);
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
            'name'       => 'required|max:255',
            'country_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $region = Region::create($request->all());

        if($region)
        {
            return $this->apiResponse($region,'The Region Saved',201);
        }

        return $this->apiResponse(null,'The Region Not Saved',400);
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
            'name'       => 'required|max:255',
            'country_id' => 'required',
        ]);
        
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $region = Region::find($id);

        if(!$region)
        {
            return $this->apiResponse(null,'The Region Not Found',404);
        }

        $region->update($request->all());

        if($region)
        {
            return $this->apiResponse($region,'The Region Updated',201);
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
        $region = Region::find($id);

        if(!$region)
        {
            return $this->apiResponse(null,'The Region Not Found',404);
        }

        $region->delete($id);

        if($region)
        {
            return $this->apiResponse(null,'The Region Deleted',200);
        }
    }
}
