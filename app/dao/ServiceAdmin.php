<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;
use Mockery\Exception;
class ServiceAdmin
{
    public function getListeAdherents() {
        try {
            $lesadherents = DB::table('adherents')
                ->leftJoin('badges', 'adherents.IdAdherent', '=', 'badges.IdAdherent')
                ->select(
                    'adherents.IdAdherent',
                    'adherents.NomAdherent',
                    'adherents.PrenomAdherent',
                    'adherents.NbBadges',
                    'adherents.CompteurLiberationBadge',
                    'adherents.CompteurRecuperationBadge',
                    'adherents.Telephone',
                    'adherents.E_mail',
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
                    'adherents.E_mail'
                )

            ->where('adherents.IdAdherent','!=',55)
                ->paginate(20);
            return $lesadherents;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }
    public function getListeClou() {
        try {
            $lesadherents = DB::table('etre_autoriser')
                ->Select('NomAdherent','PrenomAdherent', 'adherents.IdAdherent')
                ->join('adherents', 'adherents.IdAdherent', '=', 'etre_autoriser.IdAdherent')
                ->where('IdGolf','=',1)
                ->get();
            return $lesadherents;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getListeGouverneur() {
        try {
            $lesadherents = DB::table('etre_autoriser')
                ->Select('NomAdherent','PrenomAdherent', 'adherents.IdAdherent')
                ->join('adherents', 'adherents.IdAdherent', '=', 'etre_autoriser.IdAdherent')
                ->where('IdGolf','=',2)
                ->get();
            return $lesadherents;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getListeBeaujolais() {
        try {
            $lesadherents = DB::table('etre_autoriser')
                ->Select('NomAdherent','PrenomAdherent', 'adherents.IdAdherent')
                ->join('adherents', 'adherents.IdAdherent', '=', 'etre_autoriser.IdAdherent')
                ->where('IdGolf','=',3)
                ->get();
            return $lesadherents;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getListeBadgesLibres() {
        try {
            $lesadherents = DB::table('badges_libres')
                ->Select('Jour', 'Lieu','DateLiberation','IdBadgeLibre')
                ->join('badges', 'badges_libres.IdBadge', '=', 'badges.IdBadge')
                ->where('status' ,'=',NULL)
                ->get();
            return $lesadherents;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }


}
