<?php

namespace App\Http\Controllers;

use App\Exceptions\MonException;
use App\Models\Adherents;
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
            $title = "Modifer un adhérent";
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

    public function AjouterBadge(Request $request)
    {
        try {
            $title="Ajouter un badge à un adhérent";
            // Récupération de l'adhérent sélectionné dans le formulaire
            $idAdherent = $request->input('adherent');

            $serviceAdmin = new ServiceAdmin();
            $golf = $serviceAdmin->getAllGolf();
            $adherent = $serviceAdmin->getAllAdherent();

            // Récupère les choix où l'adhérent est autorisé
            $choixAutorises = [];
            if ($idAdherent) {
                $choixAutorises = etre_autoriser::where('IdAdherent', $idAdherent)->pluck('IdGolf')->toArray();
            }

            // Tableau des noms des golfs
            $nomsGolfs = [
                1 => 'Golf du Clou',
                2 => 'Golf du Gouverneur',
                3 => 'Golf du Beaujolais'
            ];

            // Filtrer pour ne garder que les choix autorisés
            $options = array_filter($nomsGolfs, function ($key) use ($choixAutorises) {
                return in_array($key, $choixAutorises);
            }, ARRAY_FILTER_USE_KEY);

            // Tableau des jours de la semaine commençant par Dimanche
            $joursSemaine = [
                1 => 'Dimanche',
                2 => 'Lundi',
                3 => 'Mardi',
                4 => 'Mercredi',
                5 => 'Jeudi',
                6 => 'Vendredi',
                7 => 'Samedi'
            ];

            // Passer l'adhérent sélectionné, les options et les jours à la vue
            return view('vues/AjouterBadge', compact('options','title', 'golf', 'adherent', 'idAdherent', 'joursSemaine'));

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }




    public function validerAjoutBadge(Request $request)
    {
        try {
            // Récupération des données du formulaire
            $idAdherent = $request->input('adherent');
            $jour = $request->input('Jour');
            $lieu = $request->input('Lieu');

            // Vérification que toutes les données nécessaires sont présentes
            if ($idAdherent && $jour && $lieu) {
                // Vérification si le badge existe déjà pour cet adhérent, ce jour et ce lieu
                $badgeExistant = badges::where('IdAdherent', $idAdherent)
                    ->where('Jour', $jour)
                    ->where('IdGolf', $lieu)
                    ->first();

                if ($badgeExistant) {
                    // Mise à jour du badge existant si nécessaire
                    $badgeExistant->updated_at = now();
                    $badgeExistant->save();
                } else {
                    // Création d'un nouveau badge
                    $badge = new badges();
                    $badge->IdAdherent = $idAdherent;
                    $badge->Jour = $jour;
                    $badge->IdGolf = $lieu;
                    $badge->save();
                }

                return redirect('listerAdherents')->with('success', 'Badge ajouté avec succès.');
            } else {
                return redirect()->back()->with('error', 'Veuillez remplir tous les champs.');
            }
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }






}
