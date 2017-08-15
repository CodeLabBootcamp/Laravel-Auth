<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        if ($validator->fails())
            return response()->json([
                    'errors' => $validator->errors()->all()]
                , 422);


        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }


        $user = JWTAuth::toUser($token);
        $user->token = $token;


        // all good so return the token
        return response()->json(compact('user'));

    }


    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            're_password' => 'required|same:password',
            'name' => 'required',
            'avatar' => 'image'
        ]);

        if ($validator->fails())
            return response()->json([
                    'errors' => $validator->errors()->all()]
                , 422);


        $filename = null;

        if($request->hasFile('avatar'))
        {
            $filename = str_random(20).".png";
            $request->file('avatar')->move('app_images/',$filename);
        }


        $user = new User;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->avatar = $filename;
        $user->save();


        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }


        $user = JWTAuth::toUser($token);
        $user->token = $token;
        return response()->json(compact('user'));
    }
}
