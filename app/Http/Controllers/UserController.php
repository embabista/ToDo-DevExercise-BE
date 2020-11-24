<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //


    }

    public function index(){

    }

    public function show($id){

    }
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);
        return response()->json('You have successfully registered', 201);
    }

    public function authenticate(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if(Hash::check($request->input('password'), $user->password)){
            $apikey = base64_encode(Str::random(40));
            $user = User::where('email', $request->input('email'));
            $user->update(['api_token' => "$apikey"]);
            $user_id = $user->first()->id;
            return response()->json(['status' => 'success','api_token' => $apikey, 'user_id' => $user_id ]);
        }else{
            return response()->json(['status' => 'fail'],401);
        }
    }
    //
}
