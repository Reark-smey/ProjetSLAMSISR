<?php

namespace App\dao;

use App\Exceptions\MonException;
use App\Models\golf;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceBadgesLibres
{
    public function getGolf()
    {
        try{
            return golf::all();
        } catch (\Couchbase\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function getGolfAvecNoms() {
        try {
            $genres = DB::table('golf')
                ->Select('IdGolf','NomGolf')
                ->get();
            return $genres;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getGolfById($id)
    {
        {
            try {
                return golf::query()
                    ->findOrFail($id);
            } catch (QueryException $e) {
                throw new MonException($e->getMessage(), 5);
            }
        }

    }

    public function getBadgesLibresavecId($id) {
        try {
            $golf = DB::table('badge_libres')
                ->Select('badge_libres.IdBadgeLibre', 'badge_libres.DateLiberation', 'badges.IdBadge','badges.Jour','badges.Lieu','golf.IdGolf','golf.NomGolf')
                ->join('badges', 'badges.IdBadge', '=', 'badge_libres.IdBadge')
                ->join('adherents','adherents.IdAdherent','=','badges.IdAdherent')
                ->join('etre_autoriser','etre_autoriser.IdAdherent','=','adherents.IdAdherent')
                ->join('golf','golf.IdGolf','=','etre_autoriser.IdGolf')
                ->where('badge_libres.status', '=',NULL)
                ->where('golf.IdGolf' ,'=', $id )
                ->paginate(25);
            return $golf;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getBadgesLibresRecuperer() {
        try {
            $golf = DB::table('badge_libres')
                ->Select('badge_libres.IdBadgeLibre', 'badge_libres.DateLiberation','badge_libres.status','badge_libres.DateRecuperer', 'badges.IdBadge','badges.Jour','badges.Lieu'
                ,'adherents.NomAdherent','adherents.PrenomAdherent')
                ->join('badges', 'badges.IdBadge', '=', 'badge_libres.IdBadge')
                ->join('adherents','adherents.IdAdherent','=','badges.IdAdherent')
                ->where('badge_libres.status', 'IS NOT',NULL)
                ->paginate(25);
            return $golf;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }


}
