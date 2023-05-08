<?php
namespace App\Http\Controllers;

use App\Models\Sector;
use App\Models\Category;
use Illuminate\Http\Request;

class SelectController_api extends Controller{
  use \App\Traits\ApiUtils;

  private function search($query, $name, $request){
    $page = $request->page - 1 ?? 0;

    $query = $query->where($name, 'LIKE', '%'.$request->q.'%');

    $count = (clone $query)->count();
    $query = $query->skip($page * self::PAGING)
    ->take(self::PAGING)
    ->get();
    return $this->apiResponseSelect($query, $count, self::PAGING);
  }

  const PAGING = 10;

  public function sectors(Request $request){
    $query = Sector::select('sector_id as id', 'sector_name as text');
    return $this->search($query, 'sector_name', $request);
  }
}
