<?php

namespace App\Http\Controllers;

use App\Models\DefaultData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{
    /**
     * newClient
     *
     * @return void
     */
    public function newClient()
    {
        return view("newclient");;
    }
    /**
     * storeNewClient
     *
     * @param  mixed $request
     * @return void
     */
    public function storeNewClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ], [
            'email.required' => 'Email est obligatoire.',
            'name.required' => 'Pseudo est obligatoire.',
            'name.min' => 'Pseudo doit être au moins 3 caractères.',
            'email.email' => 'Email doit être valide.',
            'password.min' => 'Mot de Passe doit être au moins 6 caractères.',
            'password.required' => 'Mot de Passe est obligatoire.',
            'password.confirmed' => 'Mot de Passe et la confirmation doivent êtres identiques.'
        ]);
        if ($validator->fails()) {
            return redirect()->route("newclient")
                ->withErrors($validator);
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = 'client';
        $user->password = Hash::make($request->input('password'));
        if ($user->save()) {
            Session::flash("success", "Compte Crée avec succès. Connectez-vous.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('login');
    }
    /**
     * home
     *
     * @return void
     */
    public function home()
    {
        return view("client.index");
    }
    /**
     * defaultData
     *
     * @return void
     */
    public function defaultData()
    {
        return view('client.defaultdata');
    }
    /**
     * storeDefaultData
     *
     * @param  mixed $request
     * @return void
     */
    public function storeDefaultData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nb_convives' => 'required|numeric',
        ], [
            'nb_convives.required' => 'Nombre de convives est obligatoire.',
            'nb_convives.numeric' => 'Nombre de convives est obligatoire.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("defaultdata")
                ->withErrors($validator);
        }
        $allergies = implode("%", $request->input("allergies"));

        $data = new DefaultData();
        $data->user_id = Session::get('userid');
        $data->convives = $request->input('nb_convives');
        $data->allergies = $allergies;
        if ($data->save()) {
            Session::flash("success", "Données ajoutée.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route("userdata");
    }
    /**
     * userData
     *
     * @return void
     */
    public function userData()
    {
        $data = DB::select('SELECT * from defaultdata where user_id = :id', ['id' => Session::get('userid')]);
        return view('client.userdata', compact('data'));
    }


    /**
     * editDefaultData
     *
     * @param  mixed $id
     * @return void
     */
    public function editDefaultData($id)
    {
        $data = DB::table("defaultdata")->find($id);
        if (empty($data)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('userdata');
        }
        return view("client.editdefaultdata", compact('data'));
    }
    /**
     * updateDefaultData
     *
     * @param  mixed $request
     * @return void
     */
    public function updateDefaultData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nb_convives' => 'required|numeric',
        ], [
            'nb_convives.required' => 'Nombre de convives est obligatoire.',
            'nb_convives.numeric' => 'Nombre de convives est obligatoire.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("defaultdata")
                ->withErrors($validator);
        }
        $allergies = implode("%", $request->input("allergies"));
        $data = DefaultData::find($request->input('data_id'));
        $data->convives = $request->input("nb_convives");
        $data->allergies = $allergies;
        if ($data->save()) {
            Session::flash("success", "Données modifier.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('userdata');
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
