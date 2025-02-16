<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class golf extends Model
{
    use HasFactory;

    protected $table='golf';
    protected $primaryKey ='IdGolf';
    public $timestamps=false;

}
