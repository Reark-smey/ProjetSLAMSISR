<?php

namespace App\Http\Controllers;

use App\dao\ServiceAdmin;
use App\dao\ServiceBadgesLibres;
use App\Models\badge_libres;
use App\Models\Badges;
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

    public function listerGolfAuth()
    {
        try {
            $title = "Choisir le Golf : ";
            $serviceBadgesLibres= new serviceBadgesLibres();
            $golf = $serviceBadgesLibres->getGolfAuth();
            $erreur=Session::get('erreur');
            Session::forget('erreur');
            return view('vues/FormListeBadgeLibreParGolf', compact('golf', 'title', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function ReserverBadgeLibre($id)
    {
        try {

            $title = "Réserver un Badge libre";
            $serviceBadgesLibres= new ServiceBadgesLibres();
            $badge = $serviceBadgesLibres->getBadgeLibre($id);
            $info = $serviceBadgesLibres->getInfoBadgeLibre($id);
            return view('vues/ReserverBadgeLibre', compact('title', 'badge','info'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }


    public function validerBadgeLibre(Request $request)
    {
        try {
            $serviceBadgesLibres = new ServiceBadgesLibres();
            $sessionid = Session::get('id');
            $id_badge = $request->input('hid_id');
            $badgelibre= $serviceBadgesLibres->getBadgeLibre($id_badge);

            $badgelibre->DateRecuperer = now()->toDateString();
            $badgelibre->status = $sessionid;

            $serviceBadgesLibres->saveBadgeLibre($badgelibre);

            return redirect('InfoMembre');
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function LibererUnBadge()
    {
        try {
            $title = "Choisissez un badge à libérer";
            $serviceBadge= new ServiceBadgesLibres();
            $badgelibre = new badge_libres();
            $badgesById = $serviceBadge->getBadgeByAdherent();
            return view('vues/LiberationBadge', compact('title', 'badgelibre', 'badgesById'));

        }catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validerLibererBadgeLibre(Request $request)
    {
        try {
            $serviceBadgesLibres = new ServiceBadgesLibres();
            $badgeliberer = new badge_libres();

            $badgeliberer->IdBadge = $request->input('Badge');
            $badgeliberer->DateLiberation = $request->input('Date');

            $serviceBadgesLibres->saveBadgeLibre($badgeliberer);

            return redirect('InfoMembre');
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }



}
