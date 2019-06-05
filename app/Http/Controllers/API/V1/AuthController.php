<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;


class AuthController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api', ['except'=> ['login', 'register']]);
	}

    public function login(Request $request)
    {
    	// Validate the request parameters [email, password]
    	$validation = Validator::make($request->all(), [
    		'email'=>'required|email|min:10|max:100',
    		'password'=>'required|min:6|max:20|alpha_num'

    	]);
    	// if validation fails return error 
    	if ($validation->fails()) 
    		return response()->json(['errors'=>$validation->errors()->all()], 400);


    	if ( !$token = auth('api')->attempt(['email'=>$request->email, 'password'=> $request->password]) ) 
    		return response()->json(['error' => 'Unauthorized'], 200);

    	return $this->respondeWithToken($token);
    }

    public function register(Request $request)
    {
    	// Validate the request parameters [name, email, password]
    	$validation = Validator::make($request->all(), [
    		'name'=>'required|min:6|max:60',
    		'email'=>'required|email|unique:users|min:10|max:100',
    		'password'=>'required|min:6|max:20'

    	]);
    	// if validation fails return error 
    	if ($validation->fails()) 
    		return response()->json(['errors'=>$validation->errors()->all()], 400);

    	$user = new User([
    		'name' => $request->name,
    		'email'=> $request->email,
    		'password'=> \Hash::make($request->password)
    	]);

    	if (!$user->save()) 
    		return response()->json(['error' => 'An error occurred'], 404);

    	return response()->json(['msg' => 'user registered successfully', 'user'=>$user], 404);

    }

    public function me()
    {
    	return response()->json(auth('api')->user());
    }

    protected function respondeWithToken($token)
    {
    	return response()->json([
    		'access_token'=> $token,
    		'token_type'=>'bearer',
    		'expires_in'=>auth('api')->factory()->getTTL() * 60
    	]);
    }
}
