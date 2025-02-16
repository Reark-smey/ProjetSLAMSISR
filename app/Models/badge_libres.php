<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class badge_libres extends Model
{
    use HasFactory;

    protected $table='badge_libres';
    protected $primaryKey ='IdBadgeLibre';
    public $timestamps=false;
}
