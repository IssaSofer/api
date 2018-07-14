<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\BaseController as Base;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Response;
use Auth;
use Client;

class LoginController extends Base
{

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return $this->sendResponse($success, 'User created succesfully');
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
}