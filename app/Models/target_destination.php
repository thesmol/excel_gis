<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class target_destination extends Model
{
    use HasFactory;

    protected $primaryKey = 'td_id';
    protected $fillable = ['target'];
    public $timestamps = false;

    public $table = "target_destinations";
}
