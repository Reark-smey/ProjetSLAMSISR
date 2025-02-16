<?php

namespace App\Http\Controllers;

use App\dao\ServiceLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Exception;
class ControllerLogin
{
    public function getLogin()
    {
        $erreur = "";
        try {
            return view('vues/formLogin', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/formLogin', compact('erreur'));
        }
    }
    public function signIn(Request $request)
    {
        $erreur = "";
        try {

            $login = $request->input('login');
            $pwd = $request->input('pwd');
            $serviceLogin = new ServiceLogin();
            $connected = $serviceLogin->login($login, $pwd);

            if ($connected) {
                if (Session::get('type') == 'Administrateur') {
                    return view('vues/homeAdmin');

                } elseif (Session::get('type') == 'Membre') {
                    return view('vues/homeMembre');

                    } else {
                    return view('home');
                }

            } else {
                $erreur = "login ou mot de passe inconnu";
                return view('vues/formLogin', compact('erreur'));
            }
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/formLogin', compact('erreur'));

        }
    }
    public function signOut()
    {
        $ServiceLogin = new ServiceLogin();
        $ServiceLogin->logout();
        return view('home');
    }

}
