<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\api\BaseController as Base;
use Illuminate\Http\Request;
use App\Posts;
use App\User;
use App\Donator;
use Validator;
use Response;
use DB;
use Gate;
use Auth;

class donatorController extends Base
{
    public function index($id)
    {
    	$post = Posts::all('id')->where('id', $id);
    	$user = User::all("id")->where('id', Auth()->user()->id);
    	$ms = "post id = " . $post . " And user id = " . $user;
    	$array = array($post, $user);
    	return $this->sendResponse($array, $ms);

    }

    public function story($id, Request $request)
    {

    	$post_id = Posts::find($id);
    	$input_id = $request->all();
    	$input_id['post_id'] = $post_id->id;
    	$input_id['user_id'] = Auth()->user()->id;
    	$donate = Donator::create($input_id);
    	return $this->sendResponse($donate->toArray(), "Donator save");
    }
}
