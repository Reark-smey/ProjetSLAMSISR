<?php

namespace App\Http\Controllers;

use App\Exceptions\MonException;
use App\Models\Adherents;
use App\Models\Badges;
use App\Models\etre_autoriser;
use App\Models\golf;
use Illuminate\Http\Request;
use Exception;
use App\dao\ServiceAdmin;
use Illuminate\Support\Facades\Session;

class AdminController
{
    public function listerAdherents()
    {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeAdherents();
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
        return view('vues/ListeAdherents', compact('lesAdherents'));
    }

    public function listerAdherentsClou()
    {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeClou();
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/ListeDroitsClou', compact('lesAdherents'));
    }

    public function listerAdherentsGouverneur()
    {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeGouverneur();
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/ListeDroitsGouverneur', compact('lesAdherents'));
    }

    public function listerAdherentsBeaujolais()
    {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeBeaujolais();
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/ListeDroitsBeaujolais', compact('lesAdherents'));
    }

    public function AjouterAdherent()
    {
        $erreur = "";
        try {
            $title = "Ajouter un adhérent";
            $adherent = new Adherents();

            return view('vues/FormAjouterAdherent', compact('title', 'adherent'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }

    }

    public function validerAdherent(Request $request)
    {
        try {
            $serviceAdmin = new ServiceAdmin();
            $id_adherent = $request->input('hid_id');
            if ($id_adherent == 0) {
                $adherent = new Adherents();
            } else {
                $adherent = $serviceAdmin->getAdherent($id_adherent);
            }
            $adherent->NomAdherent = $request->input('nom');
            $adherent->PrenomAdherent = $request->input('prenom');
            $adherent->e_mail = $request->input('e_mail');
            $adherent->Telephone = $request->input('Telephone');
            $adherent->License = $request->input('licence');
            $adherent->Niveau = $request->input('niveau');
            $adherent->Adherent_username = $request->input('username');
            $adherent->mdp_adherent = $request->input('password');
            $adherent->Type = $request->input('type');

            $serviceAdmin->saveAdherent($adherent);
            return redirect('listerAdherents');

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function modifierAdherent($id)
    {
        try {
            $title = "Modifer les informations";
            $serviceAdmin = new ServiceAdmin();
            $adherent = $serviceAdmin->getAdherent($id);

            return view('vues/FormAjouterAdherent', compact('title', 'adherent'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function supprimerAdherent($id)
    {
        $serviceAdmin = new ServiceAdmin();
        $serviceAdmin->delAdherent($id);
        return redirect('listerAdherents');
    }


    public function ajouterAutorisation()
    {
        $erreur = "";
        try {
            $title = "Ajouter ou modifier les autorisations d'un adhérent";
            $autoriser = new etre_autoriser();


            $serviceAdmin = new ServiceAdmin();
            $golf = $serviceAdmin->getAllGolf();
            $adherent = $serviceAdmin->getAllAdherent();
            return view('vues/FormAutorisationGolf', compact('golf', 'title', 'autoriser', 'adherent'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }

    }

    public function validerAutorisation(Request $request)
    {
        try {
            $adherent = $request->input('adherent');
            $autorisation = $request->input('autorisation', []); // Récupère les checkboxes cochées

            // Si aucune case n'est cochée, on supprime toutes les autorisations
            if (empty($autorisation)) {
                etre_autoriser::where('IdAdherent', $adherent)->delete();
            } else {
                // Vérifie et supprime uniquement les autorisations qui ne sont pas cochées
                $autorisationsExistantes = etre_autoriser::where('IdAdherent', $adherent)->get();

                foreach ($autorisationsExistantes as $auth) {
                    // Si l'autorisation n'est pas dans les checkboxes cochées, on la supprime
                    if (!in_array($auth->IdGolf, $autorisation)) {
                        $auth->delete();
                    }
                }

                // Ajoute les nouvelles autorisations sélectionnées
                foreach ($autorisation as $id_golf) {
                    // Vérifie si l'autorisation n'existe pas déjà avant de l'ajouter
                    $existeDeja = etre_autoriser::where('IdAdherent', $adherent)
                        ->where('IdGolf', $id_golf)
                        ->exists();
                    if (!$existeDeja) {
                        $autoriser = new etre_autoriser();
                        $autoriser->IdAdherent = $adherent;
                        $autoriser->IdGolf = $id_golf;
                        $autoriser->save();
                    }
                }
            }

            return redirect('listerAdherents');

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function ChoisirAdherent()
    {
        try {
            $title = "Choisir un adhérent";
            $badge = new Badges();
            $serviceAdmin = new ServiceAdmin();
            $adherent = $serviceAdmin->getAllAdherents();
            return view('vues/FormChoisirAdherent', compact('title', 'badge','adherent'));


        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }

    }
    public function validerChoixAdherent(Request $request){
        try {
            $serviceAdmin = new ServiceAdmin();
            $id_badges = $request->input('hid_id');
            if ($id_badges == 0) {
                $badges = new badges();
            }

            $badges->IdAdherent = $request->input('adherent');
            session(['badges' => $badges]);
            $serviceAdmin->saveBadge($badges);
            return redirect('AjouterBadge/{id}');
        } catch(Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function AjouterBadge() {
        try {
            $title = "Choisir le lieu et le jour";
            $serviceAdmin = new ServiceAdmin();
            $adherent = $serviceAdmin->getAllAdherents();
            $Lieu = $serviceAdmin->getAllGolf();

            // Récupération de l'IdBadge depuis la session
            $idBadge = session('badges');
            if (is_object($idBadge)) {
                $idBadge = $idBadge->IdBadge;
            }
            // Si c'est un tableau
            elseif (is_array($idBadge)) {
                $idBadge = $idBadge['IdBadge'];
            }

            return view('vues/AjouterBadge', [
                'Lieu' => $Lieu,
                'idBadge' => $idBadge
            ], compact('title', 'adherent' ) );

        } catch (Exception $exception) {
            $erreur = $exception->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validerAjoutBadge(Request $request)
    {
        try {
            $serviceAdmin = new ServiceAdmin();
            $id_badge = $request->input('hid_id');
            if ($id_badge == 0) {
                $badge = new Badges();
            } else {
                $badge = $serviceAdmin->getBadgeByID($id_badge);
            }
            $badge->IdAdherent = $request->input('adherent');
            $badge->Lieu = $request->input('Lieu');
            $badge->Jour = $request->input('Jour');


            $serviceAdmin->saveBadge($badge);
            return redirect('listerAdherents');

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

}
