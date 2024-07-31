<?php
namespace App\Http\Controllers;

use App\Mail\DocumentMail;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DocumentController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function sendGeneratedPdf(Request $request)
    {
        $data = $request->all();

        // Génération du PDF
        $outputPath = $this->pdfService->generatePdf($data);

        // Envoi de l'email avec le PDF généré
        Mail::to($data['email'])->send(new DocumentMail($data, $outputPath));

        return response()->json(['message' => 'Email avec PDF généré envoyé avec succès.']);
    }
}
