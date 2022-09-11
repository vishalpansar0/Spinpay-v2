<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Mail\SendOtp;
use App\Models\OtpVerification;
use App\Models\Users;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Mailes extends Controller
{
    public function sendotp(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required',
            "password_confirmation" => "required|same:password",
            'role_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),       
                'status' => 406,
            ]);} else {
            try {
                $users = new Users();
                if ($users->where('email', $request['email'])->get()->first()) {
                    return response()->json([
                        'message' => 'this email is already registered with us, please login.',
                        'status' => 400,
                    ]);
                } else {
                    $usermail = $request['email'];
                    $otp = random_int(1111, 9999);
                    try {
                        $otptable = new OtpVerification();
                        if ($isPresent = $otptable->where('email', $usermail)->get()->first()) {
                            $isPresent->otp = $otp;
                            $isPresent->otp_sent_time = \Carbon\Carbon::now();
                            $isPresent->save();
                        } else {
                            $otptable->email = $usermail;
                            $otptable->otp_sent_time = \Carbon\Carbon::now();
                            $otptable->otp = $otp;
                            $otptable->save();
                        }
                        try {
                            Mail::to($usermail)->send(new SendOtp($otp,'layouts.sendOtp'));
                            return response()->json([
                                'message' => 'otp sent.',
                                'status' => 200,
                            ]);
                        } catch (\Exception $e) {
                            return response()->json([
                                'message' => 'Oops, we faced some technical issue, please try again after sometime'.$e,
                                'status' => 500,
                            ]);
                        }
                    } catch (QueryException $e) {
                        return response()->json([
                            'message' => 'Oops, we faced some technical issue, please try again after sometime'.$e,
                            "status" => 500,
                        ]);
                    }

                }
            } catch (QueryException $e) {
                return response()->json([
                    'message' => 'Oops, we faced some technical issue, please try again after sometime'.$e,
                    "status" => 500,
                ]);
            }

        }
    }

    public function verifyotp(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'userOtp' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),
                'status' => 406,
            ]);} else {
            try {

                $usermail = $request['email'];
                $userOtp = $request['userOtp'];
                $otpVerTbl = new OtpVerification();
                if ($isPresent = $otpVerTbl->where('email', $usermail)->get()->first()) {
                    $otpFrmTbl = $isPresent->otp;
                    $otpSentTime = $isPresent->otp_sent_time;
                    $timeNow = \Carbon\Carbon::now();
                    $diffInTime = $timeNow->diffInMinutes($otpSentTime);
                    if ($diffInTime > 10) {
                        return response()->json([
                            'message' => 'otp expired, please try again',
                            "status" => 400,
                        ]);
                    } else {
                        if ($otpFrmTbl == $userOtp) {
                            $userControllerObj = new UserController();
                            $responseFromStoreUserData = $userControllerObj->store_users($request);
                            return $responseFromStoreUserData;
                        } else {
                            return response()->json([
                                'message' => 'wrong otp, please enter correct otp',
                                "status" => 400,
                            ]);
                        }
                    }

                } else {
                    return response()->json([
                        'message' => 'Oops , something went wrong, try after sometime.',
                        "status" => 400,
                    ]);
                }
            } catch (QueryException $e) {
                return response()->json([
                    'message' => 'Oops , something went wrong, try after sometime.',
                    "status" => 500,
                ]);
            }

        }
    }

    public function test1(Request $request)
    {
        echo '<pre>';
        $val = $request->cookie('access_token');
        var_dump($val);
    }



    // Forgot password api
    public function sendotpforforgotpassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            "password_confirmation" => "required|same:password"
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),
                'status' => 406,
            ]);} else {
            try {
                $users = new Users();
                if (!($users->where('email', $request['email'])->get()->first())) {
                    return response()->json([
                        'message' => 'this email is not registered with us, please register.',
                        'status' => 400,
                    ]);
                } else {
                    $usermail = $request['email'];
                    $otp = random_int(1111, 9999);
                    try {
                        $otptable = new OtpVerification();
                        if ($isPresent = $otptable->where('email', $usermail)->get()->first()) {
                            $isPresent->otp = $otp;
                            $isPresent->otp_sent_time = \Carbon\Carbon::now();
                            $isPresent->save();
                        } else {
                            $otptable->email = $usermail;
                            $otptable->otp_sent_time = \Carbon\Carbon::now();
                            $otptable->otp = $otp;
                            $otptable->save();
                        }
                        try {
                            Mail::to($usermail)->send(new SendOtp($otp,'layouts.forgotpassmail'));
                            return response()->json([
                                'message' => 'otp sent.',
                                'status' => 200,
                            ]);
                        } catch (\Exception $e) {
                            return response()->json([
                                'message' => 'Oops, we faced some technical issue, please try again after sometime',
                                'status' => 500,
                            ]);
                        }
                    } catch (QueryException $e) {
                        return response()->json([
                            'message' => 'Oops, we faced some technical issue, please try again after sometime',
                            "status" => 500,
                        ]);
                    }

                }
            } catch (QueryException $e) {
                return response()->json([
                    'message' => 'Oops, we faced some technical issue, please try again after sometime',
                    "status" => 500,
                ]);
            }

        }
    }


    // Verify Forgot Password API
    public function verifyforgotpasswordotp(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'userOtp' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors(),
                'status' => 406,
            ]);} else {
            try {

                $usermail = $request['email'];
                $userOtp = $request['userOtp'];
                $otpVerTbl = new OtpVerification();
                if ($isPresent = $otpVerTbl->where('email', $usermail)->get()->first()) {
                    $otpFrmTbl = $isPresent->otp;
                    $otpSentTime = $isPresent->otp_sent_time;
                    $timeNow = \Carbon\Carbon::now();
                    $diffInTime = $timeNow->diffInMinutes($otpSentTime);
                    if ($diffInTime > 10) {
                        return response()->json([
                            'message' => 'otp expired, please try again',
                            "status" => 400,
                        ]);
                    } else {
                        if ($otpFrmTbl == $userOtp) {
                            $userControllerObj = new UserController();
                            $responseFromStoreUserData = $userControllerObj->Forgot_Password($request);
                            return $responseFromStoreUserData;
                        } else {
                            return response()->json([
                                'message' => 'wrong otp, please enter correct otp',
                                "status" => 400,
                            ]);
                        }
                    }

                } else {
                    return response()->json([
                        'message' => 'Oops , something went wrong, try after sometime.',
                        "status" => 400,
                    ]);
                }
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Oops , something went wrong, try after sometime.',
                    "status" => 500,
                ]);
            }

        }
    }
}
