<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;

class PhoneController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Phone::get();
        return $this->apiResponse($phones,'Ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phone = Phone::find($id);
        
        if($phone)
        {
            return $this->apiResponse($phone,'Ok',200);
        }

        return $this->apiResponse(null,'The Phone Not Found',404);
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
            'number'    => 'required|max:255',
            'market_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $phone = Phone::create($request->all());

        if($phone)
        {
            return $this->apiResponse($phone,'The Phone Saved',201);
        }

        return $this->apiResponse(null,'The Phone Not Saved',400);
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
            'number'    => 'required|max:255',
            'market_id' => 'required',
        ]);
        
        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $phone = Phone::find($id);

        if(!$phone)
        {
            return $this->apiResponse(null,'The Phone Not Found',404);
        }

        $phone->update($request->all());

        if($phone)
        {
            return $this->apiResponse($phone,'The Phone Updated',201);
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
        $phone = Phone::find($id);

        if(!$phone)
        {
            return $this->apiResponse(null,'The Phone Not Found',404);
        }

        $phone->delete($id);

        if($phone)
        {
            return $this->apiResponse(null,'The Phone Deleted',200);
        }
    }
}
