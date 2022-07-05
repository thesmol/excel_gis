<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class district_rf extends Model
{
    use HasFactory;

    protected $primaryKey = 'dr_id';
    protected $fillable = ['district'];
    public $timestamps = false;
    public $table = 'district_rves';
}
