<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\BaseController as Base;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Response;
use Client;
class Registercontroller extends Base
{
    



    public function register(Request $request)
    {
    	$validator = Validator::make($request -> all(), [

    		'email' => 'required|string|email|max:255|unique:users',
    		'name' => 'required',
    		'password' => 'required',
            'kind' => 'required|integer'

    		]);

    	if($validator->fails()){
    		return response()->json($validator->errors());
    	}

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $sucsses['name'] = $user->name;
        return $this->sendResponse($sucsses, 'User created succesfully');

    }

}
