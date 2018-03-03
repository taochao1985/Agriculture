<?php

namespace App\Http\Controllers\tcAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::all();
        if ( $categories ){
            return response()->json([
                    'code'  => 0,
                    'msg'   => 'success',
                    'data'  => $categories
                ]);
        }else{
            return response()->json([
                    'code'  => 1000,
                    'msg'   => 'failure'
                ]);
        }
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
        $response = Categories::create(['name' => request('name')]);
        if ( $response ){
            return response()->json([
                    'code'  => 0,
                    'msg'   => 'success',
                    'data'  => $response
                ]);
        }else{
            return response()->json([
                    'code'  => 1000,
                    'msg'   => 'failure'
                ]);
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
        $cate = Categories::find($id);
        $cate->name = $request->name;
        $response = $cate->save();
        if ( $response ){
            return response()->json([
                    'code'  => 0,
                    'msg'   => 'success',
                    'data'  => $response
                ]);
        }else{
            return response()->json([
                    'code'  => 1000,
                    'msg'   => 'failure'
                ]);
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
        $response = Categories::destroy($id);
        if ( $response ){
            return response()->json([
                    'code'  => 0,
                    'msg'   => 'success',
                    'data'  => $response
                ]);
        }else{
            return response()->json([
                    'code'  => 1000,
                    'msg'   => 'failure'
                ]);
        }
    }
}
