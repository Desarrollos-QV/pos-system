<?php

  

namespace App\Http\Controllers\Auth;

  

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Language;

  

class LoginController extends Controller

{

  

    use AuthenticatesUsers;

    

    protected $redirectTo = '/';

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

        /** Ponemos el lenguage como español por defecto */
        setcookie('language', 'es', time() + (86400 * 365), "/");
        $language = Language::firstOrNew(['id' => 1]);
        $language->code = 'es';
        $language->save();

    }

  

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function login(Request $request)

    {   

        $input = $request->all();

        $this->validate($request, [

            'name' => 'required',

            'password' => 'required',

        ]);

  

        $fieldType = filter_var($request->name, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if(auth()->attempt(array($fieldType => $input['name'], 'password' => $input['password'])))

        {

            return redirect('/');

        }else{

            return redirect()->route('login')

                ->with('error','Email-Address And Password Are Wrong.');

        }

          

    }

}