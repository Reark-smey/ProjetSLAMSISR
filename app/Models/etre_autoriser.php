<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class etre_autoriser extends Model
{
    use HasFactory;

    protected $table='etre_autoriser';

    public $timestamps=false;

    protected $primaryKey = ['IdAdherent', 'IdGolf'];
    public $incrementing = false; // Indique que la clé primaire n'est pas auto-incrémentée
    protected $keyType = 'int';

    /**
     * Surcharge de la méthode getKeyName pour gérer la clé primaire composée
     */
    public function getKeyName()
    {
        return $this->primaryKey;
    }

    /**
     * Surcharge de la méthode getKey pour retourner la clé composée
     */
    public function getKey()
    {
        $keys = [];
        foreach ($this->primaryKey as $key) {
            $keys[] = $this->getAttribute($key);
        }
        return implode('-', $keys); // Concatène les clés avec un tiret (modifiable)
    }
}
