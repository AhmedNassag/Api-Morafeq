<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = Category::get();
        return $this->apiResponse($categories,'Ok',200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        
        if($category)
        {
            return $this->apiResponse($category,'Ok',200);
        }

        return $this->apiResponse(null,'The Post Not Found',404);
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

        $category = Category::create($request->all());

        if($category)
        {
            return $this->apiResponse($category,'The Category Saved',201);
        }

        return $this->apiResponse(null,'The Category Not Save',400);
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

        $category = Category::find($id);

        if(!$category)
        {
            return $this->apiResponse(null,'The Category Not Found',404);
        }

        $category->update($request->all());

        if($category)
        {
            return $this->apiResponse($category,'The Category Update',201);
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
        $category = Category::find($id);

        if(!$category)
        {
            return $this->apiResponse(null,'The Category Not Found',404);
        }

        $category->delete($id);

        if($category)
        {
            return $this->apiResponse(null,'The Category Deleted',200);
        }
    }
}
