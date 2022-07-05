<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class field extends Model
{
    use HasFactory;

    protected $primaryKey = 'f_id';
    protected $fillable = ['field_name', 'field_explorations_id', 'coords'];
    public $timestamps = false;
    public $table ='fields';
}
