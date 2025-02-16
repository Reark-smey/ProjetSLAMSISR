<?php

namespace App\Http\Controllers;

use App\dao\ServiceEmploye;
use App\Exceptions\MonException;
use Illuminate\Http\Request;
use Exception;
use App\dao\ServiceEquipe;
class EquipeController extends Controller
{
    public function listerEquipe() {
        $unEquipeService = new ServiceEquipe();
        try {
            $mesEquipes = $unEquipeService->getListeEquipe();
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/EquipeListe',compact('mesEquipes'));
    }
    public function postAjouterEquipe(Request $request){
        try {
            $code = $request->input('CodeEq');
            $desi = $request->input('DesiEq');

            $serviceEquipe = new ServiceEquipe();
            $serviceEquipe->ajoutEquipe($code, $desi);

            return view('home');
        }catch(Exception $e){
            $monErreur  = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }

    public function modifierEquipe($id) {
        $serviceEquipe = new ServiceEquipe();
        try {
            $uneEquipe = $serviceEquipe->getEquipe($id);
        } catch(\Mockery\Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
        return view('vues/formModifEquipe', compact('uneEquipe'));
    }
    public function postmodifierEquipe(Request $request, $id){
        $serviceEquipe = new ServiceEquipe();
        try {
            $code = $request->input('CodeEq');;
            $desi = $request->input('DesiEq');
            $serviceEquipe->modificationEquipe($id, $code, $desi);
            return view('home');
        } catch(Exception $e){
            $monErreur = $e->getMessage();
            return view('vues/error', compact('monErreur'));
        }
    }
}
