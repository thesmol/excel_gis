<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class la_field extends Model
{
    use HasFactory;

    protected $primaryKey = 'laf_id';
    protected $fillable = ['license_areas_id', 'fields_id'];
    public $table = 'la_fields';
    public $timestamps = false;
}
