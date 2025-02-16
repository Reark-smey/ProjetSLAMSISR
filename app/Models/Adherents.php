<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adherents extends Model
{
    use HasFactory;

    protected $table='adherents';
    protected $primaryKey ='IdAdherent';
    public $timestamps=false;
}
