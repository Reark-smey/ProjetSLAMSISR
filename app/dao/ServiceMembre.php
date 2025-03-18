<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ServiceMembre
{
    public function getInfoMembre($id)
    {
        try {
            $lesadherents = DB::table('adherents')
                ->leftJoin('badges', 'adherents.IdAdherent', '=', 'badges.IdAdherent')
                ->leftJoin('facture', 'adherents.IdAdherent', '=', 'facture.IdAdherent') // Ajout du join avec facture
                ->select(
                    'adherents.IdAdherent',
                    'adherents.NomAdherent',
                    'adherents.PrenomAdherent',
                    'adherents.NbBadges',
                    'adherents.CompteurLiberationBadge',
                    'adherents.CompteurRecuperationBadge',
                    'adherents.Telephone',
                    'adherents.E_mail',
                    'facture.PrixTotal', // Ajout de PrixTotal
                    DB::raw("GROUP_CONCAT(badges.Lieu ORDER BY badges.Lieu ASC SEPARATOR '<br>') as Lieu"),
                    DB::raw("GROUP_CONCAT(badges.Jour ORDER BY badges.Jour ASC SEPARATOR '<br>') as Jour")
                )
                ->groupBy(
                    'adherents.IdAdherent',
                    'adherents.NomAdherent',
                    'adherents.PrenomAdherent',
                    'adherents.NbBadges',
                    'adherents.CompteurLiberationBadge',
                    'adherents.CompteurRecuperationBadge',
                    'adherents.Telephone',
                    'adherents.E_mail',
                    'facture.PrixTotal' // Ajout dans GROUP BY
                )

                ->where('adherents.IdAdherent','!=',55)
                ->where('adherents.IdAdherent','=',$id)
                ->get();
            return $lesadherents;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }

    }

    public function getInfoBadge(){
        try {
            $id = Session::get('id');
            $lesbadges = DB::table('badges')
                ->select('badges.Lieu','badges.Jour','badges.IdBadge','badges.IdAdherent')

                ->where('badges.IdAdherent','=',$id)
                ->get();
            return $lesbadges;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }


}
