<?php

namespace App\Http\Controllers;

use App\Exceptions\MonException;
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


}
