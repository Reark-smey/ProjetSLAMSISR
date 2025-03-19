<?php

namespace App\Http\Controllers;

use App\dao\ServiceClassement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClassementController
{
    public function ChoisirLeCLient()
    {
        try {
            $title = "Choisir le Client : ";
            $serviceClassement = new ServiceClassement();
            $client = $serviceClassement->getGrandClient();
            $erreur=Session::get('erreur');
            Session::forget('erreur');
            return view('vues/ChoisirGrandClient', compact('client', 'title', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }
    public function ListerClassement($id) {
        try {
            $serviceclassement = new ServiceClassement();

            $classement = $serviceclassement->getClassementTopTen($id);
            $getclient = $serviceclassement->getGrandClientById($id);

            $title = "Classement du Grand Client: ".$getclient->NomGrandClient ;

            return view('vues.ClassementTopTen', compact('classement', 'title', 'getclient'));

        }catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function validerChoixGrandClient(Request $request) {
        try {
            $grandclient = $request->input('GrandClient');

            return redirect(route('ListerClassement',[$grandclient]));

        }catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function ListerTopFive() {
        try {
            $title = "Evolution des montants des 5 plus grand clients";
            $serviceClassement = new ServiceClassement();
            $TopFive = $serviceClassement->TopFiveMonthToMonth();

            return view ('vues.EvolutionMontant', compact('TopFive','title'));

        }catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function ChoisirLeProduit()
    {
        try {
            $title = "Choisir le Produit : ";
            $serviceClassement = new ServiceClassement();
            $produit = $serviceClassement->getProduit();
            $erreur=Session::get('erreur');
            Session::forget('erreur');
            return view('vues/ChoisirGrandClient', compact('produit', 'title', 'erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function ListerProduitOneFour() {
        try {
            $title ="Produit 1_4";
            $serviceclassement = new ServiceClassement();

            $produit = $serviceclassement->EvolutionProduitOneFour();


            $title = "Evolution du produit 1_4" ;

            return view('vues.ProduitOneFour', compact('produit', 'title'));

        }catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

    public function ListerProduitOneOne() {
        try {
            $title ="Produit 1_1";
            $serviceclassement = new ServiceClassement();

            $produit = $serviceclassement->EvolutionProduitOneOne();


            $title = "Evolution du produit 1_1" ;

            return view('vues.ProduitOneOne', compact('produit', 'title'));

        }catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }

}
