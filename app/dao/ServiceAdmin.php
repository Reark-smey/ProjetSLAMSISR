<?php

namespace App\dao;

use App\Models\Adherents;
use App\Models\Badges;
use App\Models\etre_autoriser;
use App\Models\golf;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;
use Mockery\Exception;
use function Laravel\Prompts\select;

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

    public function getAllAdherents() {
        try {
            $lesadherents = DB::table('adherents')
                ->Select()
                ->where('adherents.IdAdherent','!=',55)
                ->get();
            return $lesadherents;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
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

    public function saveAdherent(Adherents $adherent){
        try{
            $adherent->save();
        }catch(QueryException $e){
            $erreur = $e->getMessage();
            if(!isset($adherent->NomAdherent)) {
                $erreur="Vous devez mettre un Nom";
            }
            else if(!isset($adherent->PrenomAdherent)) {
                $erreur="Vous devez mettre un prénom";
            }
            else if(!isset($adherent->Adherent_username)) {
                $erreur="Vous devez mettre un identifiant";
            }
            else if(!isset($adherent->mdp_adherent)) {
                $erreur="Vous devez mettre un mot de passe";
            }
            else if(!isset($adherent->type)) {
                $erreur="Vous devez mettre un type";
            }
            throw new MonException($erreur, 5);
        }
    }

    public function GetBadge($id){
        try {
            return Badges::query()
                ->findOrFail($id);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage());

        }
    }
    public function saveBadge(Badges $badge){
        try {
            $badge->save();
        } catch(QueryException $e){
            $erreur = $e->getMessage();
            throw new MonException($erreur, 5);
        }
    }
    public function getAdherent($id)
    {
        try {
            return Adherents::query()
                ->findOrFail($id);
        } catch(QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getAutorisationAdherent($id)
    {
        try {
            return etre_autoriser::query()
                ->findOrFail($id);
        } catch(QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function delAdherent($id) {
        try {
            Adherents::destroy($id);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getAllGolf() {
        try {
            return Golf::all();
        } catch (\Couchbase\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function getAllAdherent() {
        try {
            return Adherents::where('IdAdherent','!=','55')->get();
        } catch (\Couchbase\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function saveAutorisationAdherent(etre_autoriser $autoriser){
        try{
            $autoriser->save();
        }catch(QueryException $e){
            $erreur = $e->getMessage();
            throw new MonException($erreur, 5);
        }
    }

    public function Autorisation($id){
        try {

        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getGolfByAutorisation($id){
        try {
            return DB::table('etre_autoriser')
                ->join('golf', 'etre_autoriser.IdGolf', '=', 'golf.IdGolf')
                ->where('etre_autoriser.IdAdherent', '=', $id)
                ->select('golf.IdGolf', 'golf.NomGolf')
                ->get();
            return $golf;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

}
