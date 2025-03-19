<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class centresactivite extends Model
{
    use HasFactory;
    protected $table='centresactivite';
    protected $primaryKey ='CentreActiviteID';
    public $timestamps=false;

}
