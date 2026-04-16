<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Declaration;
use App\Models\UniteIndustrielle;
use App\Models\ProductionDetail;
use App\Models\VenteDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportController extends Controller
{
    public function index()
    {
        return view('rapports.index');
    }

    public function generatePDF(Request $request)
    {
        $request->validate([
            'annee' => 'required|integer',
            'trimestre' => 'required|integer|between:1,4',
        ]);

        $query = Declaration::with(['uniteIndustrielle', 'productionDetails.produit', 'venteDetails.produit'])
            ->where('annee', $request->annee)
            ->where('trimestre', $request->trimestre)
            ->where('statut', 'validee');

        if ($request->filled('filiere')) {
            $uniteIds = UniteIndustrielle::where('filiere', $request->filiere)->pluck('id');
            $query->whereIn('unite_industrielle_id', $uniteIds);
        }

        $declarations = $query->get();

        $totalProduction = ProductionDetail::whereHas('declaration', function($q) use ($request) {
            $q->where('annee', $request->annee)->where('trimestre', $request->trimestre);
        })->sum('quantite_produite');

        $totalCA = VenteDetail::whereHas('declaration', function($q) use ($request) {
            $q->where('annee', $request->annee)->where('trimestre', $request->trimestre);
        })->sum('chiffre_affaires');

        $data = [
            'declarations' => $declarations,
            'annee' => $request->annee,
            'trimestre' => $request->trimestre,
            'filiere' => $request->filiere ?? 'Toutes',
            'totalProduction' => $totalProduction,
            'totalCA' => $totalCA,
            'dateGeneration' => now()->format('d/m/Y H:i')
        ];

        $pdf = Pdf::loadView('rapports.pdf', $data);
        return $pdf->download("rapport_T{$request->trimestre}_{$request->annee}.pdf");
    }

    public function generateExcel(Request $request)
    {
        $request->validate([
            'annee' => 'required|integer',
        ]);

        $query = Declaration::with(['uniteIndustrielle'])
            ->where('annee', $request->annee);

        if ($request->filled('departement')) {
            $uniteIds = UniteIndustrielle::where('departement', $request->departement)->pluck('id');
            $query->whereIn('unite_industrielle_id', $uniteIds);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $declarations = $query->get();

        $filename = "declarations_{$request->annee}.csv";
        
        return response()->streamDownload(function() use ($declarations) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Industriel', 'Filière', 'Département', 'Trimestre', 'Année', 'Statut', 'Date']);
            foreach ($declarations as $d) {
                fputcsv($handle, [
                    $d->id,
                    $d->uniteIndustrielle->nom ?? 'N/A',
                    $d->uniteIndustrielle->filiere ?? 'N/A',
                    $d->uniteIndustrielle->departement ?? 'N/A',
                    $d->trimestre,
                    $d->annee,
                    $d->statut,
                    $d->created_at->format('d/m/Y')
                ]);
            }
            fclose($handle);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}