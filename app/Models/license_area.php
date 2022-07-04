<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class license_area extends Model
{
    use HasFactory;

    protected $primaryKey = 'la_id';
    protected $fillable = ['licanse_area_name'];
    public $timestamps = false;
    public $table = 'license_areas';
}
