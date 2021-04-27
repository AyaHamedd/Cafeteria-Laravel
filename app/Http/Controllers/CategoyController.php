<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'label' => 'required|unique:categories|regex:/^[a-zA-Z]+$/u',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => "Error", 'data' => "", "message" => $validator->errors()], 401);
        } else {
            $category = new Category();
            $category->label = $request->label;
            if ($category->save()) {
                return response()->json(['status' => "success", 'data' => $category], 200);
            } else {
                return response()->json(['status' => "Error", 'data' => "", "message" => "something went wrong"], 401);
            }
        }
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
        $category = Category::where('id', '=', $id)->first();


        if ($category != null && $category->delete()) {
            return response()->json(['status' => "success"], 200);
        }

        return response()->json(['status' => "Error", 'data' => "", "message" => "something went wrong"], 401);
    }

    // public function lookUp()
    // {
    //     $categories = Category::all(['id', 'label']);
    //     return response()->json(['status' => "success", "data" => $categories], 200);

    // }
}
