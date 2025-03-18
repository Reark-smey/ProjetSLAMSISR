<?php

namespace App\dao;

use App\Exceptions\MonException;
use App\Models\badge_libres;
use App\Models\golf;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
                ->select(
                    'badge_libres.IdBadgeLibre',
                    'badge_libres.DateLiberation',
                    'badges.IdBadge',
                    'badges.Jour',
                    'badges.Lieu',
                    'golf.IdGolf',
                    'golf.NomGolf'
                )
                ->join('badges', 'badges.IdBadge', '=', 'badge_libres.IdBadge')
                ->join('adherents', 'adherents.IdAdherent', '=', 'badges.IdAdherent')
                ->join('etre_autoriser', 'etre_autoriser.IdAdherent', '=', 'adherents.IdAdherent')
                ->join('golf', 'golf.IdGolf', '=', 'etre_autoriser.IdGolf')
                ->whereNull('badge_libres.status')
                ->where('golf.IdGolf', '=', $id)
                ->where('badges.Lieu', '=', function($query) use ($id) {
                    $query->select('NomGolf')
                        ->from('golf')
                        ->where('IdGolf', '=', $id)
                        ->limit(1);
                })
                ->orderBy('badge_libres.DateLiberation', 'ASC')
                ->paginate(25);

            return $golf;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getBadgesLibresRecuperer() {
        try {

            $golf = DB::table('badge_libres')
                ->select(
                    'badge_libres.IdBadgeLibre',
                    'badge_libres.DateLiberation',
                    'badge_libres.status',
                    'badge_libres.DateRecuperer',
                    'badges.IdBadge',
                    'badges.Jour',
                    'badges.Lieu',
                    'recuperateurs.NomAdherent as NomRecuperateur', // Alias pour le récupérateur
                    'recuperateurs.PrenomAdherent as PrenomRecuperateur' // Alias pour le récupérateur
                )
                ->join('badges', 'badges.IdBadge', '=', 'badge_libres.IdBadge')
                ->join('adherents as proprietaires', 'proprietaires.IdAdherent', '=', 'badges.IdAdherent') // Propriétaire du badge
                ->join('adherents as recuperateurs', 'recuperateurs.IdAdherent', '=', 'badge_libres.status') // Récupérateur du badge
                ->whereNotNull('badge_libres.status') // Vérifier que le badge a bien été récupéré
                ->paginate(25);

            return $golf;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }


    public function getGolfAuth() {
        try {
            $id = Session::get('id'); // Récupère l'adhérent connecté

            $golf = DB::table('golf')
                ->join('etre_autoriser', 'golf.IdGolf', '=', 'etre_autoriser.IdGolf')
                ->where('etre_autoriser.IdAdherent', '=', $id)
                ->select('golf.IdGolf', 'golf.NomGolf')
                ->get();
            return $golf;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getBadgeLibre($id)
    {
        try {
            return badge_libres::query()
                ->findOrFail($id);
        } catch(QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getInfoBadgeLibre($id) {
        try {
            $golf = DB::table('badge_libres')
            ->select(
                'badge_libres.IdBadgeLibre',
                'badge_libres.DateLiberation',
                'badges.IdBadge',
                'badges.Jour',
                'badges.Lieu',
            )
                ->join('badges', 'badges.IdBadge', '=', 'badge_libres.IdBadge')
                ->join('adherents', 'adherents.IdAdherent', '=', 'badges.IdAdherent')
                ->join('etre_autoriser', 'etre_autoriser.IdAdherent', '=', 'adherents.IdAdherent')
                ->join('golf', 'golf.IdGolf', '=', 'etre_autoriser.IdGolf')
                ->where('badge_libres.IdBadgeLibre', '=', $id)
                ->first();

                return $golf;
        }catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function saveBadgeLibre(badge_libres $badgelibre)
    {
        try {
            $badgelibre->save();
        } catch (QueryException $e) {
            $erreur = $e->getMessage();

            throw new MonException($erreur, 5);
        }
    }

    public function getBadgeByAdherent() {
        try {
            $id = Session::get('id');
            $badge = DB::table('badges')
                ->select('badges.IdBadge','badges.Lieu','badges.Jour','badges.IdAdherent')
                ->where('IdAdherent', '=', $id)
                ->get();
            return $badge;

        } catch ( QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
