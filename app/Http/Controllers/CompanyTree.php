<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyTree extends Controller
{
    public function getCompanies(Request $request) {

		$result = DB::table('companies')
			->select(DB::raw('c_id, company_name as name'))
			->whereRaw('mc_id is null')
			->get();

		foreach ($result as $subsoilUser) {
			$amount = DB::table('companies')
				->select(DB::raw('count(*) as amount'))
				->where('mc_id', '=', $subsoilUser->c_id)
				->get()[0]
				->amount;

			$subsoilUser->amount = $amount;
		}

		return $this->sendResponse($result->toArray(), 'companies');

	}

	public function getChildCompanies(Request $request, $id) {

		$result = DB::table('companies')
			->select(DB::raw('c_id, company_name as name'))
			->where('mc_id', '=', $id)
			->get();

		if (count($result) != 0) {
			foreach ($result as $subsoilUser) {
				$amount = DB::table('companies')
					->select(DB::raw('count(*) as amount'))
					->where('mc_id', '=', $subsoilUser->c_id)
					->get()[0]
					->amount;

				$subsoilUser->amount = $amount;
			}

			return $this->sendResponse($result->toArray(), 'companies');
		}
	}
}
