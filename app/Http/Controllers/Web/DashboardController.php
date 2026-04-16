<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\UniteIndustrielle;
use App\Models\Declaration;
use App\Models\AlerteMP;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUnites = UniteIndustrielle::count();
        $totalDeclarations = Declaration::count();
        $alertesNonTraitees = AlerteMP::where('est_traitee', false)->count();
        
        return view('dashboard', compact('totalUnites', 'totalDeclarations', 'alertesNonTraitees'));
    }
}