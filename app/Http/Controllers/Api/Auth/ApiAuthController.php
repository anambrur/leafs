<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class ApiAuthController extends Controller
{
    use RedirectsUsers,
        ThrottlesLogins;

    /**
     * Register a new user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *

    /**
     * Login a user and return the JWT token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        // Validate that either username, email, or mobile is required, and password is mandatory
        $validator = Validator::make($request->all(), [
            'username' => 'required_without_all:email,mobile',
            'email' => 'required_without_all:username,mobile',
            'mobile' => 'required_without_all:email,username',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 400);
        }

        try {
            // Check login using email and password
            if ($request->has('email') && Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $user = User::where('email', $request->email)->where('status', 1)->first();
            }
            // Check login using username and password
            elseif ($request->has('username') && Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                $user = User::where('username', $request->username)->where('status', 1)->first();
            }
            // Check login using mobile and password
            elseif ($request->has('mobile') && Auth::guard('web')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->remember)) {
                $user = User::where('mobile', $request->mobile)->where('status', 1)->first();
            }
            // Invalid login
            else {
                return response()->json(['error' => 'Invalid login credentials'], 401);
            }

            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            // Generate JWT token after successful login
            try {
                $token = JWTAuth::fromUser($user);
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while trying to login'], 500);
        }
    }




    public function otpLogin(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required',
            'otp' => 'required',
        ]);

        $user = User::where('mobile', $request->mobile)->first();

        if ($user && Hash::check($request->otp, $user->password)) {
            Auth::login($user);
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json(['error' => 'Invalid OTP or mobile number'], 401);
        }
    }



    
    public function signUpPhoneNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            $user = new User();
            $user->mobile = $request->mobile;
            $user->status = 2;
            $user->save();
        }

        $otp = rand(1111, 9999);
        $otpExpiry = now()->addMinutes(3);

        $user->otp = $otp;
        $user->otp_expiry = $otpExpiry;
        $user->save();

        $message = "Your Login OTP for Leafs E-Commerce is " . $otp . ". It will expire in 3 minutes.";
        $this->sendOtp($user->mobile, $message);

        return response()->json(['success' => 'OTP sent successfully'], 201);
    }



    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
            'valid_mobile' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $otp = $request->otp;

        $user = User::where('mobile', $request->valid_mobile)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->otp_expiry < now()) {
            return response()->json(['error' => 'OTP has expired'], 400);
        }

        if ($user->otp != $otp) {
            return response()->json(['error' => 'Invalid OTP'], 400);
        }

        $user->otp = null;
        $user->otp_expiry = null;
        $user->status = 1;
        $user->address = $request->address ?? null;
        $user->country = $request->country ?? null;
        $user->city = $request->city ?? null;
        $user->zip = $request->zip ?? null;
        $user->billing_firstname = $request->billing_firstname ?? null;
        $user->billing_lastname = $request->billing_lastname ?? null;
        $user->billing_mobile = $request->billing_mobile ?? null;
        $user->billing_address = $request->billing_address ?? null;
        $user->billing_city = $request->billing_city ?? null;
        $user->billing_zip = $request->billing_zip ?? null;

        $user->save();

        Auth::login($user);
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'message' => 'Login successful!',
            'user' => $user,
            'token' => $token
        ], 200);
    }


    private function sendOtp($to, $message)
    {
        // dd($to, $message);
        $url = "http://139.99.39.237/api/smsapi?api_key=mPs3CslIA2tXhyrIqMip&type=text&number=$to&senderid=8809617613457&message=" . urlencode($message);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        $smsresult = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return response()->json(['error' => 'Failed to send SMS. Error: ' . curl_error($ch)], 500);
        }

        curl_close($ch);
    }


    /**
     * Logout a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'User successfully logged out'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to logout, please try again'
            ], 500);
        }
    }
}
