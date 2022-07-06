<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class region_rf extends Model
{
    use HasFactory;

    protected $primaryKey = 'rr_id';
    protected $fillable = ['region_name', 'region_short_name', 'district_rves_id'];
    public $timestamps = false;
    public $table ='region_rves';
}
