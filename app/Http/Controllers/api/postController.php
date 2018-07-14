<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\api\BaseController as Base;
use Illuminate\Http\Request;
use App\Posts;
use App\User;
use Validator;
use Response;
use DB;
use Gate;
use Auth;

class postController extends Base
{

	public function index() 
	{
        // get name user
		$name = User::all('name')->where('name', auth()->user()->name);
        

		// get all post for user login 
		$post_user = Posts::all()->where('kind_id', auth()->user()->id);

        $array = [$post_user,$name];
        if (Gate::allows('kind', Auth::user())) {
        	return $this->sendResponse($array, ' gggggg');
        }

        if (Gate::denies('kind', Auth::user())) {
            return $this->sendError('Sorry you can\'t open this page');
        	// $this->sendResponse($post_user->toArray(), ' hgfffg');
        }


	}

    // save data post in database
    public function store(Request $request) {
        $input = $request->all();
        $input['kind_id'] = auth()->user()->id;
        $val = Validator::make($input,[
            'name' => 'required',
            'description' => 'required',
            ]);

        if($val -> fails()){
            return $this->sendError('error validation', $val ->errors());
        }

        $post = Posts::create($input);
        return $this->sendResponse($post->toArray(),'Post Create Succesfully');

    }	

    // show all content post for user
    public function show($id) {

        $post = Posts::find($id);
        $name = User::all('name')->where('name', auth()->user()->name);
        $array = [$post,$name];
        if(is_null($post)){
            return $this->sendError('Post not found');
        }

        
        return $this->sendResponse($array,'Post read Succesfully');

    }

    // update post whene edit post
    public function update(Request $request, Posts $post) {
        $input = $request->all();
        $val = Validator::make($input,[
            'name' => 'required',
            'description' => 'required',
            ]);

        if($val -> fails()){
            return $this->sendError('error validation', $val ->errors());
        }

        $post->name = $input['name'];
        $post->description = $input['description'];
        return $this->sendResponse($post->toArray(),'Post Update Succesfully');

    } 


    // delete post
    public function destroy($id)
    {
        $post = Posts::find($id);
        $post->delete();
        return $this->sendResponse($post->toArray(), 'Post Delete Succesfully');
    }

}