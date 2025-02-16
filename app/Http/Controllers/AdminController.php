<?php

namespace App\Http\Controllers;

use App\Exceptions\MonException;
use App\Models\Adherents;
use Illuminate\Http\Request;
use Exception;
use App\dao\ServiceAdmin;
class AdminController
{
    public function listerAdherents() {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeAdherents();
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
        return view('vues/ListeAdherents',compact('lesAdherents'));
    }
    public function listerAdherentsClou() {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeClou();
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/ListeDroitsClou',compact('lesAdherents'));
    }

    public function listerAdherentsGouverneur() {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeGouverneur();
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/ListeDroitsGouverneur',compact('lesAdherents'));
    }

    public function listerAdherentsBeaujolais() {
        $ServiceAdmin = new ServiceAdmin();
        try {
            $lesAdherents = $ServiceAdmin->getListeBeaujolais();
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/ListeDroitsBeaujolais',compact('lesAdherents'));
    }

    public function ajouterManga()
    {
        $erreur = "";
        try {
            $title = "Ajouter un adhérent";
            $adherent = new Adherents();

            return view('vues/FormAjouterAdherent', compact( 'title', 'adherent'));
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
                $adherent = new Manga();
            } else {
                $adherent = $serviceAdmin->getAdherent($id_adherent);
            }
            $adherent->NomAdherent = $request->input('nom');
            $adherent->PrenomAdherent = $request->input('sel_genre');
            $adherent->e_mail = $request->input('e_mail');
            $adherent->License = $request->input('licence');
            $adherent->Niveau = $request->input('niveau');
            $adherent->Adherent_username = $request->input('username');
            $adherent->mdp_adherent = $request->input('password');

            $serviceAdmin->saveAdherent($adherent);
            return redirect('listerMangas');

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/pageErreur', compact('erreur'));
        }
    }

}
