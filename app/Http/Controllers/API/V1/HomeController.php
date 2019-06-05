<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function index()
    {
    	$countries = ['Egypt', 'Saudi Arabia', 'United Arab Emirates', 'Morocco', 'Palestinian'];
    	$user = auth('api')->user();
    	return response()->json(['countries'=>$countries, 'user'=>$user]);
    }
}
