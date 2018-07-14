<?php 

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{
	
	public function sendResponse($result, $message) {
		$respons = [

			"success" => true,
			"data" => $result,
			"message" => $message
		];

		return response()->json($respons, 200);
	}

	public function sendError($error, $errorMessage = [], $code = 404) {
		$respons = [

			"success" =>  false,
			"data" => '',
			"message" => $error
		];

		if(!empty($errorMessage)){
			$respons["data"] = $errorMessage;
		}

		return response()->json($respons, $code);
	}

}