<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * home
     *
     * @return void
     */
    public function home()
    {
        return view("account.index");
    }
    /**
     * login
     *
     * @return void
     */
    public function login()
    {
        return view("account.login");
    }

    /**
     * logged
     *
     * @param  mixed $request
     * @return void
     */
    public function logged(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns',
            "password" => 'required|min:6',
        ], [
            'email.required' => 'Email est obligatoire.',
            'email.email' => 'Email doit être valide.',
            'password.min' => 'Mot de Passe doit être au moins 6 caractères.',
            'password.required' => 'Mot de Passe est obligatoire.'
        ]);
        if ($validator->fails()) {
            return redirect()->route("login")
                ->withErrors($validator);
        }
        $email = $request->input("email");
        $user = DB::select("SELECT * from users where email = :email", ["email" => $email]);
        if (!empty($user)) {
            $user = $user[0];
            if (Hash::check($request->input("password"), $user->password)) {
                Session::put("userlogged", $user->name);
                Session::put("userid", $user->id);
                Session::put("usertype", $user->type);
                if ($user->type == 'admin') {
                    return redirect()->route("userportal");
                } else {
                    return redirect()->route("clientportal");
                }
            } else {
                Session::flash("fail", "Email ou Mot de Passe Invalide.");
                return redirect()->route("login");
            }
        } else {
            Session::flash("fail", "Email ou Mot de Passe Invalide.");
            return redirect()->route("login");
        }
    }
    /**
     * logout
     *
     * @return void
     */
    public function logoutAdmin()
    {
        Session::remove("userlogged");
        Session::remove("userid");
        Session::remove("usertype");

        return redirect()->route("login");
    }

    /**
     * frmt
     *
     * @param  mixed $var
     * @return void
     */
    public function frmt($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
    }
}
