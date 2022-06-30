<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class license_status extends Model
{
    use HasFactory;

    protected $primaryKey = 'ls_id';
    protected $fillable = ['status'];
    public $timestamps = false;
    public $table = 'license_statuses';
}
