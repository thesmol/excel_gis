<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company_status extends Model
{
    use HasFactory;

    protected $primaryKey = 'cs_id';
    protected $fillable = ['status'];
    public $timestamps = false;
    public $table = 'company_statuses';
}
