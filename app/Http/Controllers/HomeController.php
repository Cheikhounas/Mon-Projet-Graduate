<?php

namespace App\Http\Controllers;

use App\Models\Convive;
use App\Models\Reservation;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return view("index");
    }

    /**
     * reserver
     *
     * @return void
     */
    public function reserver()
    {

        if (Session::has('userlogged')) {
            $data = DB::select('SELECT * from defaultdata where user_id = :id', ['id' => Session::get('userid')]);
            if (!empty($data) && isset($data[0])) {
                $data = $data[0];
                return view("reserverdata", compact('data'));
            }
        } else {
            return view("reserver");
        }
        if (Session::get('usertype') == 'admin' || Session::get('usertype') == 'client') {
            return view("reserver");
        }
    }
    /**
     * storeReserver
     *
     * @param  mixed $request
     * @return void
     */
    public function storeReserver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nb_convives' => 'required|numeric',
            'date' => 'required',
            'heure' => 'required',
        ], [
            'nb_convives.required' => 'Nombre de convives est obligatoire.',
            'nb_convives.numeric' => 'Nombre de convives est obligatoire.',
            'date.required' => 'La date  est obligatoire.',
            'heure.required' => 'L\'heure  est obligatoire.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("reserver")
                ->withErrors($validator);
        }
        $allergies = implode("%", $request->input("allergies"));
        $reservation = new Reservation();
        $reservation->convives = $request->input("nb_convives");
        $reservation->date = $request->input("date") . " " . $request->input("heure");
        $reservation->allergies  = $allergies;
        $user = Session::has('userlogged');
        if ($user) {
            $reservation->user_id  = Session::get('userid');
            if ($reservation->save()) {
                Session::flash("success", "Réservation faite.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        } else {
            if ($reservation->save()) {
                Session::flash("success", "Réservation faite.");
            } else {
                Session::flash("fail", "Ouoops une erreur est suvernue.");
            }
        }
        return redirect()->route('reserver');
    }
    /**
     * convives
     *
     * @return void
     */
    public function convives()
    {
        $convives = DB::select('SELECT * from convives ');
        return view("account.convives", compact('convives'));
    }
    /**
     * setConvivesSeuil
     *
     * @return void
     */
    public function setConvivesSeuil()
    {
        return view("account.setconvivesseuil");
    }
    /**
     * setConvivesNombre
     *
     * @param  mixed $request
     * @return void
     */
    public function setConvivesNombre(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_max' => 'required',
        ], [
            'nombre_max.required' => 'Ce Nombre est obligatoire.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("setconvivesseuil")
                ->withErrors($validator);
        }
        $convive = new Convive();
        $convive->nombre_max = $request->input("nombre_max");
        if ($convive->save()) {
            Session::flash("success", "Nombre seuil fixé.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('convives');
    }
    /**
     * editConvivesSeuil
     *
     * @param  mixed $id
     * @return void
     */
    public function editConvivesSeuil($id)
    {
        $convive = DB::table("convives")->find($id);
        if (empty($convive)) {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
            return redirect()->route('convives');
        }
        return view("account.editconvive", compact('convive'));
    }
    /**
     * updateConvivesSeuil
     *
     * @param  mixed $request
     * @return void
     */
    public function updateConvivesSeuil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_max' => 'required',
        ], [
            'nombre_max.required' => 'Ce Nombre est obligatoire.',
        ]);
        if ($validator->fails()) {
            return redirect()->route("editconvivesseuil")
                ->withErrors($validator);
        }
        $convive =  Convive::find($request->input('convive_id'));
        $convive->nombre_max = $request->input("nombre_max");
        if ($convive->save()) {
            Session::flash("success", "Nombre seuil modifier.");
        } else {
            Session::flash("fail", "Ouoops une erreur est suvernue.");
        }
        return redirect()->route('convives');
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
