<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Declaration;
use App\Models\UniteIndustrielle;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {
        return view('statistiques.index');
    }

    public function getData(Request $request)
    {
        // Données pour les graphiques
        $productionParDept = Declaration::with('uniteIndustrielle')
            ->where('statut', 'validee')
            ->get()
            ->groupBy('uniteIndustrielle.departement')
            ->map(function ($item) {
                return $item->count();
            });

        return response()->json([
            'productionParDept' => $productionParDept
        ]);
    }
}