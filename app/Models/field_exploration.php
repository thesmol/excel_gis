<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class field_exploration extends Model
{
    use HasFactory;

    protected $primaryKey = '*_id';
    protected $fillable = [''];
    public $timestamps = false;
}
