<?php

namespace App\dao;

use App\Exceptions\MonException;
use App\Models\grandclients;
use App\Models\produit;
use Illuminate\Support\Facades\DB;

class ServiceClassement
{
public function getClassementTopTen($id) {
    try {
        $topApplications = DB::table('application')
            ->select(
                'application.IRT',
                'application.NomAppli',
                'grandclients.GrandClientID',
                'grandclients.NomGrandClient',
                DB::raw('SUM(ligne_facturation.prix) as total_prix')
            )
            ->join('ligne_facturation', 'application.IRT', '=', 'ligne_facturation.IRT')
            ->join('centresactivite', 'ligne_facturation.CentreActiviteID', '=', 'centresactivite.CentreActiviteID')
            ->join('clients', 'centresactivite.CentreActiviteID', '=', 'clients.CentreActiviteID')
            ->join('grandclients', 'clients.GrandClientID', '=', 'grandclients.GrandClientID')
            ->where('grandclients.GrandClientID', '=', $id)
            ->groupBy('application.IRT','application.NomAppli',
                'grandclients.GrandClientID',
                'grandclients.NomGrandClient')
            ->orderByDesc('total_prix')
            ->limit(10)
            ->get();
        return $topApplications;
    } catch  (\Illuminate\Database\QueryException $e) {
        throw new MonException($e->getMessage(),5);
    }
    }
    public function TopFiveMonthToMonth() {
    try {
        $topClients = DB::table('ligne_facturation')
            ->select(
                'ligne_facturation.mois',
                'Top5C.top5',
                'clients.NomClient',
                DB::raw('SUM(ligne_facturation.prix) as TotalMois')
            )
            ->join('centresactivite', 'ligne_facturation.CentreActiviteID', '=', 'centresactivite.CentreActiviteID')
            ->join('clients', 'centresactivite.CentreActiviteID', '=', 'clients.CentreActiviteID')
            ->joinSub(
                DB::table('clients')
                    ->select(
                        'clients.NomClient',
                        DB::raw('SUM(ligne_facturation.prix) AS top5')
                    )
                    ->join('centresactivite', 'clients.CentreActiviteID', '=', 'centresactivite.CentreActiviteID')
                    ->join('ligne_facturation', 'centresactivite.CentreActiviteID', '=', 'ligne_facturation.CentreActiviteID')
                    ->groupBy('clients.NomClient')
                    ->orderByDesc(DB::raw('SUM(ligne_facturation.prix)'))
                    ->limit(5),
                'Top5C',
                'clients.NomClient',
                '=',
                'Top5C.NomClient'
            )
            ->where('ligne_facturation.mois', '<', '2022-04-01')
            ->groupBy('clients.NomClient', 'ligne_facturation.mois','Top5C.top5')
            ->orderByDesc('Top5C.top5')
            ->orderBy('clients.ClientID')
            ->orderBy('ligne_facturation.mois')
            ->get();
        return $topClients;
    }catch  (\Illuminate\Database\QueryException $e) {
        throw new MonException($e->getMessage(),5);
    }
    }

    public function EvolutionProduitOneFour() {
        try { $produits = DB::table('produit')
            ->select(
                DB::raw('SUM(ligne_facturation.volume) AS total_volume'),
                'produit.NOM_PRODUIT',
                'ligne_facturation.mois'
            )
            ->join('ligne_facturation', 'produit.produitID', '=', 'ligne_facturation.produitID')
            ->where(function ($query) {
                $query->where('produit.NOM_PRODUIT', 'PRODUIT1_4');

            })
            ->where('ligne_facturation.mois', '<', '2022-05-01')
            ->groupBy('ligne_facturation.mois', 'produit.NOM_PRODUIT')
            ->get();
        return $produits;
    } catch  (\Illuminate\Database\QueryException $e) {
    throw new MonException($e->getMessage(),5);
    }
    }

    public function EvolutionProduitOneOne() {
        try { $produits = DB::table('produit')
            ->select(
                DB::raw('SUM(ligne_facturation.volume) AS total_volume'),
                'produit.NOM_PRODUIT',
                'ligne_facturation.mois'
            )
            ->join('ligne_facturation', 'produit.produitID', '=', 'ligne_facturation.produitID')
            ->where(function ($query) {
                $query->where('produit.NOM_PRODUIT', 'PRODUIT1_1');

            })
            ->where('ligne_facturation.mois', '<', '2022-05-01')
            ->groupBy('ligne_facturation.mois', 'produit.NOM_PRODUIT')
            ->get();
            return $produits;
        } catch  (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getGrandClient() {
    try {
        return grandclients::all();
    }catch (\Exception $e) {
        throw new MonException($e->getMessage(),5);
    }
    }

    public function getGrandClientById($id) {
    try {
        return grandclients::query()
            ->findOrFail($id);
    }catch (\Exception $e) {
        throw new MonException($e->getMessage(),5);
    }
    }

    public function getClientByProfit(){
    try {
        $topApplications = DB::table('application')
            ->select(
                'application.IRT',
                'application.NomAppli',
                'grandclients.GrandClientID',
                'grandclients.NomGrandClient',
                DB::raw('SUM(ligne_facturation.prix) as total_prix')
            )
            ->join('ligne_facturation', 'application.IRT', '=', 'ligne_facturation.IRT')
            ->join('centresactivite', 'ligne_facturation.CentreActiviteID', '=', 'centresactivite.CentreActiviteID')
            ->join('clients', 'centresactivite.CentreActiviteID', '=', 'clients.CentreActiviteID')
            ->join('grandclients', 'clients.GrandClientID', '=', 'grandclients.GrandClientID')

            ->groupBy('application.IRT','application.NomAppli',
                'grandclients.GrandClientID',
                'grandclients.NomGrandClient')
            ->orderByDesc('total_prix')
            ->limit(10)
            ->get();
        return $topApplications;
    }catch (\Exception $e) {
        throw new MonException($e->getMessage(),5);

    }
    }

    public function getProduit() {
        try {
            return produit::all();
        }catch (\Exception $e) {
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getProduitById($id) {
        try {
            return produit::query()
                ->findOrFail($id);
        }catch (\Exception $e) {
            throw new MonException($e->getMessage(),5);
        }
    }


}
