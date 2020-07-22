<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicine;

class PointOfSaleController extends Controller
{
    public function index()
    {
        return view('pages.point_of_sale.index');
    }

    public function liveSearchMedicine(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Medicine::where('medicine_name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
       <li><a href="#">' . $row->medicine_name . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function medicinSearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Medicine::with('category')->where('medicine_name', '=', $query)
                ->first();
            return response()->json(['result' => $data]);

        }
    }




}
