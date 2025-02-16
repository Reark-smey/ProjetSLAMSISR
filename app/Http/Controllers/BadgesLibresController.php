<?php

namespace App\Http\Controllers;

use App\dao\ServiceBadgesLibres;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BadgesLibresController
{
    public function listerGolf()
    {
        try {
            $title = "Choisir le Golf : ";
            $serviceBadgesLibres= new serviceBadgesLibres();
            $golf = $serviceBadgesLibres->getGolfAvecNoms();
            $erreur=Session::get('erreur');
            Session::forget('erreur');
            return view('vues/FormListeBadgeLibreParGolf', compact('golf', 'title', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
    public function validerGolf(Request $request)
    {
        try {
            $golf = $request->input('sel_golf');

            if($golf == 0){
                Session::put('erreur', 'Vous devez sélectionner un golf');
                return redirect(route('selGolf'));

            }
            return redirect(route('golf', [$golf]));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function listerBadgesLibresByGolf($id)
    {
        try {

            $serviceBadgesLibres = new ServiceBadgesLibres();

            $golf = $serviceBadgesLibres->getBadgesLibresavecId($id);
            $getGolf = $serviceBadgesLibres->getGolfById($id);
            $title = "Liste des badges du : ".$getGolf->NomGolf;

            return view('vues/ListeBadgesLibres', compact('title','golf', 'getGolf'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function listerBadgesRecuperer() {
        try {
            $serviceBadgesLibres = new ServiceBadgesLibres();
            $golf = $serviceBadgesLibres->getBadgesLibresRecuperer();
            $title = "Liste des badges Récupérés :";

            return view('vues/ListeBadgeRecuperer', compact('title','golf'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
}
