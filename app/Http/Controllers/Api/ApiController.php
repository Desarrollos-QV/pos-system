<?php namespace App\Http\Controllers\api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Redirect;
use App\Text;
use App\Language;
use App\GeneralSetting;

class ApiController extends Controller {

	public function welcome()
	{
		return response()->json(['data' => []]);
	}


	public function getDataInit()
	{
		$text    = new Text;
		$l 		 = Language::find(0);

		$data = [
			'text'		=> $text->getAppData(1),
			'app_type'	=> isset($l->id) ? $l->type : 0,
			'admin'     => GeneralSetting::latest()->first()
		];

		return response()->json(['data' => $data]);
		
	}

	public function userinfo($id)
	{
		return response()->json(['data' => []]);
	}
	
}
