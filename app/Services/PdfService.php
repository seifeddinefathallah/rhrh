<?php
namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    /**
     * Générer un fichier PDF avec des données
     *
     * @param array $data Données à inclure dans le PDF
     * @return string Chemin de sauvegarde du fichier PDF
     */
   /* public function generatePdf($data)
    {
        $pdf = PDF::loadView('pdf.template', compact('data'));
        $outputPath = storage_path('app/public/documents/generated_document.pdf');
        $pdf->save($outputPath);

        return $outputPath;
    }*/
    public function generatePdf($data, $viewName)
    {
        $pdf = PDF::loadView($viewName, $data);
        return $pdf->output();
    }
}
