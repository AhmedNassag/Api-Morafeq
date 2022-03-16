<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sub_category;

class SubcategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Sub_category::get();
        return $this->apiResponse($subcategories,'Ok',200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcategory = Sub_category::find($id);
        
        if($subcategory)
        {
            return $this->apiResponse($subcategory,'Ok',200);
        }

        return $this->apiResponse(null,'The Sub Category Not Found',404);
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
            'name'        => 'required|max:255',
            'category_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $subcategory = Sub_category::create($request->all());

        if($subcategory)
        {
            return $this->apiResponse($subcategory,'The Sub Category Saved',201);
        }

        return $this->apiResponse(null,'The Sub Category Not Save',400);
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
            'category_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $subcategory = Sub_category::find($id);

        if(!$subcategory)
        {
            return $this->apiResponse(null,'The Sub Category Not Found',404);
        }

        $subcategory->update($request->all());

        if($subcategory)
        {
            return $this->apiResponse($subcategory,'The Sub Category Update',201);
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
        $subcategory = Sub_category::find($id);

        if(!$subcategory)
        {
            return $this->apiResponse(null,'The Sub Category Not Found',404);
        }

        $subcategory->delete($id);

        if($subcategory)
        {
            return $this->apiResponse(null,'The Sub Category Deleted',200);
        }
    }
}
