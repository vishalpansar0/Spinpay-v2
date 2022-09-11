<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Query;
use App\Models\Users;
use Illuminate\Database\QueryException;

class RaiseIssue extends Controller
{
    //
    public function new_issue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'category'=>'required',
            'user_message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        try{
            $raiseaissue = new Query();
            $raiseaissue->user_id=$request['user_id'];
            $raiseaissue->category=$request['category'];
            $raiseaissue->user_message=$request['user_message'];
            $raiseaissue->save();
            return response()->json([
                'message'=>'Successfully Raised A request',
                'status'=>200
            ]);
        }
        catch(QueryException $e){
            return response()->json([
                // 'message'=>"Internal Server Error",
                'message'=>$e,
                'status'=>500
            ]);
        }

    }






    // Show All Raise Request
    public function showissues(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 401,
            ]);
        }
        try{
            $raiseaissue = new Query();
            $userissues=$raiseaissue->where('user_id',$request['user_id'])->orderBy('reply_message', 'desc')->get();
            return response()->json([
                'message'=>$userissues,
                'status'=>200
            ]);
        }
        catch(QueryException $e){
            return response()->json([
                // 'message'=>"Internal Server Error",
                'message'=>$e,
                'status'=>500
            ]);
        }

    }

}
