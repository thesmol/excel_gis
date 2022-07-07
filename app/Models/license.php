<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class license extends Model
{
    use HasFactory;

    protected $primaryKey = 'l_id';
    protected $fillable = [
        'prev_l_id',
        'l_series',
        'l_number',
        'l_type',
        'company_id',
        'license_area_id',
        'license_status_id',
        'target_destination',
        'kind_of_fossil',
        'authorities_id',
        'date_of_start',
        'date_of_end',
        'date_of_annulation',
        'coords',
        ];
    public $timestamps = false;
    public $table = 'licenses';
    static function rules(): array {
		return [
			'company_id' => 'required|integer|exists:company, c_id',

		];
	}
}
