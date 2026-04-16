<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport de production</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { font-size: 18px; font-weight: bold; color: #1e3a5f; }
        .subtitle { font-size: 14px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #1e3a5f; color: white; }
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #999; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">MINISTÈRE DE L'INDUSTRIE ET DU COMMERCE</div>
        <div class="subtitle">Rapport de production - T{{ $trimestre }} {{ $annee }}</div>
        <div class="subtitle">Filière : {{ $filiere }}</div>
        <div class="subtitle">Généré le : {{ $dateGeneration }}</div>
    </div>

    <h3>Synthèse</h3>
    <table>
        <thead>
            <tr><th>Indicateur</th><th>Valeur</th></tr>
        </thead>
        <tbody>
            <tr><td>Production totale</td><td>{{ number_format($totalProduction, 2) }} tonnes</td></tr>
            <tr><td>Chiffre d'affaires total</td><td>{{ number_format($totalCA / 1000000, 2) }} Mds FCFA</td></tr>
            <tr><td>Nombre de déclarations</td><td>{{ $declarations->count() }}</td></tr>
        </tbody>
    </table>

    <h3>Détail des déclarations</h3>
    <table>
        <thead>
            <tr><th>Industriel</th><th>Filière</th><th>Département</th><th>Production (T)</th><th>CA (FCFA)</th></tr>
        </thead>
        <tbody>
            @foreach($declarations as $d)
            <tr>
                <td>{{ $d->uniteIndustrielle->nom ?? 'N/A' }}</td>
                <td>{{ $d->uniteIndustrielle->filiere ?? 'N/A' }}</td>
                <td>{{ $d->uniteIndustrielle->departement ?? 'N/A' }}</td>
                <td>{{ number_format($d->productionDetails->sum('quantite_produite'), 2) }}</td>
                <td>{{ number_format($d->venteDetails->sum('chiffre_affaires'), 0) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Document généré par SIGDRI - Système Informatique de Gestion des Données Industrielles
    </div>
</body>
</html>