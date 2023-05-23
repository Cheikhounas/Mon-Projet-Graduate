<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxRequestsController extends Controller
{
    /**
     * jours_fr_en
     *
     * @var array
     */
    protected $jours_fr_en = [
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
        'Sunday' => 'Dimanche'
    ];
    /**
     * ajaxGetDayName
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxGetDayName(Request $request)
    {
        $response = "";
        $dayName = date("l", strtotime(($request->input("var"))));
        $titre = $this->jours_fr_en[$dayName];
        $dayOnTable = DB::select("SELECT * FROM jours where titre = :titre", ['titre' => $titre]);
        if (!empty($dayOnTable) && isset($dayOnTable[0])) {
            $dayOnTable = $dayOnTable[0];
            $horaires = DB::select("SELECT * FROM horaires where jour_id = :id", ['id' => $dayOnTable->id]);
            if (!empty($horaires) && isset($horaires[0])) {
                $horaire = $horaires[0];
                $mo = $horaire->ouverture_midi;
                $mf = $horaire->fermeture_midi;
                $response .= "<div class='row mb-2'><label for='' class='font-weight-bold'>MIDI</label>";
                while (date('H:i', strtotime($mo)) < date('H:i', strtotime($mf . ' -60 minutes'))) {
                    $h = date('H:i', strtotime($mo . ' +15 minutes'));
                    $response .= "<div class='col-1'><label for=''>$h</label>
                    <input type='radio' class='form-control' name='heure' value='$h'>
                    </div>";
                    $mo = $mo . "+15 minutes";
                }
                $response .= "</div>";
                $so = $horaire->ouverture_soir;
                $sf = $horaire->fermeture_soir;
                $response .= "<div class='row mb-2'><label for='' class='font-weight-bold'>SOIR</label>";
                while (date('H:i', strtotime($so)) < date('H:i', strtotime($sf . ' -60 minutes'))) {
                    $h = date('H:i', strtotime($so . ' +15 minutes'));
                    $response .= "<div class='col-1'><label for=''>$h</label>
                    <input type='radio' class='form-control' name='heure' value='$h'>
                    </div>";
                    $so = $so . "+15 minutes";
                }
                $response .= "</div>";
            }
        }
        return ($response);
    }
    /**
     * ajaxVerifierSeuil
     *
     * @param  mixed $request
     * @return void
     */
    public function ajaxVerifierSeuil(Request $request)
    {
        $response = 1;
        $data = $request->input("var");
        $nbSeuil = DB::select("SELECT * FROM convives");
        $reservationsAvenir = DB::select("SELECT * FROM reservations where statut = :s", ["s" => 'avenir']);
        $reservationsEncours = DB::select("SELECT * FROM reservations where statut = :s", ["s" => 'encours']);
        if ((!empty($nbSeuil) && isset($nbSeuil[0]))) {
            $nbSeuil = $nbSeuil[0]->nombre_max;
            if ($data > $nbSeuil) {
                $response = 0;
            }
            if ((!empty($reservationsAvenir)  || !empty($reservationsEncours))) {
                $avenirs = [];
                $encours = [];
                foreach ($reservationsAvenir as $r) {
                    array_push($avenirs, $r->convives);
                }
                foreach ($reservationsEncours as $r->convives) {
                    array_push($encours, $r);
                }
                if ((array_sum($avenirs) + $data > $nbSeuil) || (array_sum($encours) + $data > $nbSeuil) || $data > $nbSeuil) {
                    $response = 0;
                }
            }
        }

        return ($response);
    }
}
