<?php

namespace App\dao;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;
class ServiceLogin
{
    public function login($login, $pwd) {
        $connected = false;
        try {
            $adherent = DB::table('adherents')
                ->select()
                ->where('Adherent_username', '=', $login)
                ->first();
            if ($adherent) {
                if($adherent->mdp_adherent == $pwd) {
                    Session::put('id', $adherent->IdAdherent);
                    Session::put('type', $adherent->Type);
                    $connected = true;
                }
            }
            if($adherent->mdp_adherent == $pwd)
            {
                Session::put('id', $adherent->IdAdherent);
                Session::put('type', $adherent->Type);
                Session::put('login',$login);
                $connected = true;

            }
        }catch (QueryException $e){
            throw new MonException($e->getMessage(), 5);
        }
        return $connected;
    }

    public function logout()
    {
    Session::put('id', 0);
    }


}
