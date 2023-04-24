<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    use Authenticatable;

    /**
     * Attempt login
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    }

    public function login(Request $request)
    {
        if ($this->$this->attemptLogin($request)) {
            if (Auth::user()->role === '') {

            }
        }
    }
}
