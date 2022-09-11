<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use App\Models\UserDocument;
use App\Models\Users;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
class UserController extends Controller
{
    public function store_users($request)
    {
        $users = new Users();
        try {
            if ($users->where('email', $request['email'])->get()->first()) {
                return response()->json([
                    'message' => 'this email is already registered with us, please login.',
                    'status' => 400,
                ]);
            } else {
                $users->name = $request['name'];
                $users->email = $request['email'];
                $users->phone = $request['phone'];
                $users->password = Hash::make($request['password']);
                $users->role_id = $request['role_id'];
                $ifsaved = $users->save();
                if ($ifsaved == 1) {
                    $request->session()->put('user_id', $users->id);
                    $request->session()->put('name', $users->name);
                    $request->session()->put('role', $users->role_id);
                    return response()->json([
                        'message' => 'success',
                        "status" => 200,
                        "id" => $users->id,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'data not saved',
                        "status" => 400,
                    ]);
                }
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500,
            ]);
        }
    }

    public function userdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'address_line' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'image' => 'required',
        ]);
        if ($validator->fails()) {
            $flag = false;
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 400,
            ]);
        } else {
            $size = $request->file('image')->getSize();
            if ($size > 500000) {
                return response()->json([
                    'message' => 'Photos must be less then 500kB',
                    'status' => 400,
                ]);
            }
            try {
                $user = new UserData();
                $user->user_id = $request['user_id'];
                $user->address_line = $request['address_line'];
                $user->city = $request['city'];
                $user->state = $request['state'];
                $user->pincode = $request['pincode'];
                $user->age = $request['age'];
                $user->gender = $request['gender'];
                $user->dob = $request['dob'];
                $path = $request->file('image')->store('public/images/profileImage');
                $path = str_replace("public/", "", $path);
                $user->image = $path;
                $isSaved = $user->save();
                if ($isSaved == 1) {
                    return response()->json([
                        'message' => 'success',
                        'status' => 200,
                        'id' => $user->user_id,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Data not Saved',
                        'status' => 400,
                    ]);
                }
            } catch (QueryException $e) {
                return response()->json([
                    'message' => 'Server Error Please try later',
                    'status' => 400,
                ]);
            }
        }
    }

    public function pancard(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'master_document_id' => 'required',
            'document_number' => 'required',
            'document_image' => 'required',
        ]);

        if ($validate->fails()) {
            $flag = false;
            return response()->json([
                'Validation Failed' => $validate->errors(),
                "status" => 400,
            ]);
        } else {
            $size = $request->file('document_image')->getsize();
            if ($size > 5000000) {
                return response()->json([
                    "message" => "image size should be less than 5Mb",
                    "status" => 400,
                ]);
            }
        }

        try {
            $user_doc = new UserDocument();
            if ($user_doc->where('document_number', $request['document_number'])->get()->first()) {
                return response()->json([
                    'message' => "this document number already exists",
                    'status' => 400,
                ]);
            } else {
                $path = $request->file('document_image')->store('public/images/pan_images');
                $path = str_replace("public/","",$path);
                $ifsaved = DB::table('user_documents')->updateOrInsert(
                    ['user_id' => $request['user_id'], 'master_document_id' => $request['master_document_id']],
                    [ 'document_number'=>$request['document_number'], 'document_image' => $path, 'is_verified' => 'pending ']
                );
                if ($ifsaved == 1) {
                    $isLender = Users::where('id',$request['user_id'])->where('role_id',3)->first();
                     if($isLender){
                        return response()->json([
                            'message' => 'success',
                            "status" => 200,
                            "isLender"=>'yes',
                        ]);
                    }
                    return response()->json([
                        'message' => 'success',
                        "status" => 200,
                        "isLender"=>'no',
                    ]);
                } else {
                    return response()->json([
                        'message' => 'data not saved',
                        "status" => 400,
                    ]);
                }
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Internal Server Error',
                "status" => 500,
            ]);
        }
    }

    public function payslip(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'master_document_id' => 'required',
            'document_number' => 'required',
            'document_image' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'Validation Failed' => $validate->errors(),
                'status' => 400,
            ]);
        } else {
            try {
                $path = $request->file('document_image')->store('public/images/documentImage');
                $path = str_replace("public/", "", $path);
                $ifSaved = DB::table('user_documents')->updateOrInsert(
                    ['user_id' => $request['user_id'], 'master_document_id' => $request['master_document_id'], 'document_number'=>$request['document_number']],
                    [ 'document_image' => $path, 'is_verified' => 'pending ']
                );
                if ($ifSaved == 1) {
                    return response()->json([
                        'message' => "Successfully saved",
                        'status' => 200,
                    ]);
                } else {
                    return response()->json([
                        'message' => "Data not saved",
                        'status' => 400,
                    ]);
                }
            } catch (QueryException $e) {
                return response()->json([
                    'message' => 'Internal Server Error',
                    'status' => 500,
                ]);
            }
        }
    }

    public function bankstatement(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'master_document_id' => 'required',
            'document_number' => 'required',
            'document_image' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'Validation Failed' => $validate->errors(),
                'status' => 400,
            ]);
        } else {
            try {
                $path = $request->file('document_image')->store('public/images/documentImage');
                $path = str_replace("public/", "", $path);
                $ifSaved = DB::table('user_documents')->updateOrInsert(
                    ['user_id' => $request['user_id'], 'master_document_id' => $request['master_document_id'], 'document_number'=>$request['document_number']],
                    [ 'document_image' => $path , 'is_verified' => 'pending ']
                );
                if ($ifSaved == 1) {
                    return response()->json([
                        'message' => "Successfully saved",
                        'status' => 200,
                    ]);
                } else {
                    return response()->json([
                        'message' => "Data not saved",
                        'status' => 400,
                    ]);
                }
            } catch (QueryException $e) {
                return response()->json([
                    'message' => 'Internal Server Error',
                    'status' => 500,
                ]);
            }
        }
    }

    public function aadhar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'master_document_id' => 'required',
            'document_number' => 'required',
            'document_image' => 'required',
        ]);
        if ($validator->fails()) {
            $flag = false;
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 400,
            ]);
        } else {
            $size = $request->file('document_image')->getSize();
            if ($size > 5000000) {
                return response()->json([
                    'Upload Failed' => 'Photos must be less then 5MB',
                    'status' => 400,
                ]);
            }
            try {
                $path = $request->file('document_image')->store('public/images/documentImage');
                $path = str_replace("public/", "", $path);
                $isSaved = DB::table('user_documents')->updateOrInsert(
                    ['user_id' => $request['user_id'], 'master_document_id' => $request['master_document_id']],
                    [ 'document_number'=>$request['document_number'], 'document_image' => $path, 'is_verified' => 'pending']
                );
                if ($isSaved == 1) {
                    return response()->json([
                        'message' => 'success',
                        'status' => 200,
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Data not Saved',
                        'status' => 400,
                    ]);
                }
            } catch (QueryException $e) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'status' => 400,
                ]);
            }
        }
    }

    // Change Password
    public function Change_password(Request $request)
    {
        $users = new Users();
        $DBpassword = $users->where('id', $request['id'])->get()->first()->password;
        if (!(Hash::check($request['old_password'], $DBpassword))) {
            return response()->json([
                'message' => 'incorrect old password',
                'status' => 400,
            ]);
        }
        $oldPasswordCheck = (Hash::check($request['old_password'], $DBpassword));
        $newPasswordCheck = (Hash::check($request['new_password'], $DBpassword));
        if ($oldPasswordCheck == $newPasswordCheck) {
            return response()->json([
                'message' => 'old and new password cannot be same',
                'status' => 400,
            ]);
        }
        $result = $users->where('id', $request['id'])->update(array('password' => Hash::make($request['new_password'])));
        if ($result == 1) {
            return response()->json([
                'message' => 'Password changes successfully',
                'status' => 200,
            ]);
        }
        return response()->json([
            'message' => 'password not changed',
            'status' => 400,
        ]);
    }

    // Forgot Password
    public function Forgot_Password(Request $request)
    {
        $users = new Users();
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'new_password' => 'required',
            'confirm_password' => 'required | same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'Validation Failed' => $validator->errors(),
                'status' => 400,
            ]);
        }
        if (!($users->where('email', $request['email'])->get()->first())) {
            return response()->json([
                'message' => 'this email is not registered with us, please register.',
                'status' => 400,
            ]);
        }
        try {
            $result = $users->where('email', $request['email'])->update(array('password' => Hash::make($request['new_password'])));
            if ($result == 1) {
                return response()->json([
                    'message' => 'Password changes successfully',
                    'status' => 200,
                ]);
            }
            return response()->json([
                'message' => 'password not changed',
                'status' => 400,
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Oops , something went wrong, try after sometime.',
                "status" => 500
            ]);
        }
    }
}
