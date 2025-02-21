<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceMembre
{
    public function getInfoMembre($id)
    {
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
                ->where('adherents.IdAdherent','=',$id)
                ->get();
            return $lesadherents;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
}}
