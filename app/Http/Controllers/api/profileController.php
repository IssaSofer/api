<?php 
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\api\BaseController as Base;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Parser;
use Token;
use Gate;
use Validator;


class profileController extends Base
{
	public function index()
	{
		$user = User::all()->where('id', auth()->user()->id);
		return $this->sendResponse($user->toArray(), ' gggggg');
	}


    public function update(Request $request,$id)
    {
        $u = User::all();
        $user = User::find($id);
        if ($id == Auth()->user()->id){
            $input = $request->all();

            if(!is_null($input['name'])){
                $user->name = $input['name'];
            }else{
                $user->name = $u->name;
            }

            if (!is_null($input['password'])) {
                $user->password = bcrypt($input['password']);
            }else{
                $user->password = Auth()->user()->password;
            }

            
            $user->kind = Auth()->user()->kind;
            $user->email = Auth()->user()->email;
            $user->save();
            return $this->sendResponse($user->toArray(),'User Update Succesfully');
        }else{
            return $this->sendError('Sorry you can\'t open this page');
        }



    }


	public function logout(Request $request)
    {
        $value = $request->bearerToken();
        $id= (new Parser())->parse($value)->getHeader('jti');

        $token=  DB::table('oauth_access_tokens')
            ->where('id', $id)
            ->update(['revoked' => true]);

        $token = $request->user()->tokens->find($id);
        $token->revoke();
        $token->delete();

        $json = [
            'success' => true,
            'code' => 200,
            'message' => 'You are Logged out.',
        ];
        return response()->json($json, '200');
    }

}