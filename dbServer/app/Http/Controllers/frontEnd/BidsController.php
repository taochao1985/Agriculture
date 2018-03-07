<?php

namespace App\Http\Controllers\frontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Bids;
use App\Http\Models\Attachments;

class BidsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $bids = Bids::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
      if ( $bids ){
          return response()->json([
                  'code'  => 0,
                  'msg'   => 'success',
                  'data'  => $bids
              ]);
      }else{
          return response()->json([
                  'code'  => 1000,
                  'msg'   => 'failure'
              ]);
      }
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
        //
        $response = auth()->user()->publish(
            new Bids(request(['name', 'cate_id', 'description', 'start_date', 'start_time', 'end_date', 'end_time']))
        );
        for($i = 0 ; $i < count($request->attachments); $i++){
            $response->addAttachment($request->attachments[$i]);
        }

        echo $response->id;
        print_r($response);
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
        $bid = Bids::find($id);
        if ( $bid ){
            return response()->json([
                    'code'  => 0,
                    'msg'   => 'success',
                    'data'  => $bid
                ]);
        }else{
            return response()->json([
                    'code'  => 1000,
                    'msg'   => 'failure'
                ]);
        }
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
      $bid = Bids::find($id);
      $bid->name = $request->name;
      $bid->cate_id = $request->cate_id;
      $bid->start_date = $request->start_date;
      $bid->start_time = $request->start_time;
      $bid->end_date = $request->end_date;
      $bid->end_time = $request->end_time;
      $bid->description = $request->description;
      $response = $bid->save();

      Attachments::where('bids_id',$id)->delete();
      for($i = 0 ; $i < count($request->attachments); $i++){
          $response->addAttachment($request->attachments[$i]);
      }
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
        //
        $response = Bids::destroy($id);
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
