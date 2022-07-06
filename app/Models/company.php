<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    protected $primaryKey = 'c_id';
    protected $fillable =
        ['company_name',
        'mc_id',
        'company_status_id',
        'address',
        'inn',
        'code_OKPO',
        'code_OKATO',
        'OGRN',
        'comment'];

    public $timestamps = false;
    public $table = 'companies';
}
