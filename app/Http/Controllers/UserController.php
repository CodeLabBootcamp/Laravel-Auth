<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('login.login');
    }

    public function getRegister()
    {
        return view('login.register');
    }

    public function attemptLogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|exists:users',
            'password'=>'required'
        ]);

        if($validator->fails())
            return back()->withErrors($validator->errors())->withInput();



//        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
//        {
//            return Auth::user();
//        }

        $cred = $request->only('email','password');



        if(Auth::guard('admin')->attempt($cred,true))
        {
//            return Auth::user();
            return redirect('/dashboard');
        }
        return back()->withErrors(['Wrong Password Or Email'])->withInput();
    }

    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            're_password'=>'required|same:password'
        ]);

        if($validator->fails())
            return back()->withErrors($validator->errors())->withInput();

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($user->save())
        {


            if(Auth::attempt($user))
            {
                return Auth::user();
            }else{
                return "Not Auth";
            }
        }

        return abort(500);
    }

    public function getUser()
    {
        if(Auth::check())
            return Auth::user();

        return "Not Auth";
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/user');
    }

    public function getDashboard()
    {
//        if(Auth::check())
//            return view('login.dashboard');
//
//        return redirect('/auth/login');

        $user = Auth::user();

        return view('login.dashboard',compact('user'));
    }
}
