<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class regions_field extends Model
{
    use HasFactory;

    protected $primaryKey = 'rf_id';
    protected $fillable = ['fields_id', 'region_rves_id'];
    public $timestamps = false;
    public $table = 'regions_fields';
}
