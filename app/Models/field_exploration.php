<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class field_exploration extends Model
{
    use HasFactory;

    protected $primaryKey = 'fe_id';
    protected $fillable = ['exploration'];
    public $timestamps = false;
    public $table = 'field_explorations';
}
