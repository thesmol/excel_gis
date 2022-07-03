<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class authoritie extends Model
{
    use HasFactory;

    protected $primaryKey = 'a_id';
    protected $fillable = ['authoritie'];
    public $timestamps = false;
    public $table = 'authorities';
}
