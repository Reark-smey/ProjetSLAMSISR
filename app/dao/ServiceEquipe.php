<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Support\Facades\DB;

class ServiceEquipe
{
    public function getListeEquipe() {
        try {
            $mesEquipe = DB::table('equipe')
                ->Select()
                ->get();
            return $mesEquipe;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(),5);
        }
    }
    public function getEquipe($id) {
        try {
            $uneEquipe = DB::table('equipe')
                ->select()
                ->where('Id', '=', $id)
                ->first();
            return $uneEquipe;
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function ajoutEquipe($code, $desi)
    {
        try {
            DB::table('equipe')->insert(
                ['CodeEq'=> $code, 'DesiEq' => $desi]);
        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
    public function modificationEquipe($id, $code, $desi) {
        try{
            DB::table('equipe')->where('Id', $id)
                ->update([
                    'CodeEq'=>$code,
                    'DesiEq'=>$desi,
                ]);

        } catch (\Illuminate\Database\QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }
}
