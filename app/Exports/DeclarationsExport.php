<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeclarationsExport implements FromCollection, WithHeadings
{
    protected $declarations;

    public function __construct($declarations)
    {
        $this->declarations = $declarations;
    }

    public function collection()
    {
        return $this->declarations->map(function($d) {
            return [
                'ID' => $d->id,
                'Industriel' => $d->uniteIndustrielle->nom ?? 'N/A',
                'Filière' => $d->uniteIndustrielle->filiere ?? 'N/A',
                'Département' => $d->uniteIndustrielle->departement ?? 'N/A',
                'Trimestre' => $d->trimestre,
                'Année' => $d->annee,
                'Statut' => $d->statut,
                'Date soumission' => $d->created_at->format('d/m/Y'),
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Industriel', 'Filière', 'Département', 'Trimestre', 'Année', 'Statut', 'Date soumission'];
    }
}