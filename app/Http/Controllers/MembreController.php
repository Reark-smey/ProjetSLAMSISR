<?php

namespace App\Http\Controllers;

use App\dao\ServiceMembre;
use App\Exceptions\MonException;
use App\Models\Adherents;
use App\Models\Badges;
use App\Models\etre_autoriser;
use App\Models\golf;
use Illuminate\Http\Request;
use Exception;
use App\dao\ServiceAdmin;
use Illuminate\Support\Facades\Session;

class MembreController
{
    public function InfoMembre()
    {

        $erreur = Session::get('erreur');
        Session::forget('erreur');
        try {
            $id = Session::get('id');
            $servicesMembre = new ServiceMembre();
            $lesAdherents = $servicesMembre->getInfoMembre($id);
            return view( '/vues/InfoMembre' ,compact( 'lesAdherents', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function ProfilMembre($id)
    {
        try {

            $servicesMembre = new ServiceMembre();
            $lesAdherents = $servicesMembre->getInfoMembre($id);

            return view('vues/InfoMembre', compact( 'lesAdherents'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
    public function MesBadges() {
        try  {
            $serviceMembre = new ServiceMembre();
            $mesBadges = $serviceMembre->getInfoBadge();

            return view('vues/MesBadges', compact( 'mesBadges'));

        } catch ( Exception $e ) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

}
