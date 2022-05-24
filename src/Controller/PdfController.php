<?php

namespace App\Controller;


use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfController extends AbstractController
{
 
    /**
     * @Route("/pdf/{ville}/{lat}/{lon}", name="pdf")
     */
    public function index($ville, $lat, $lon)
    {
    // reference the Dompdf namespace
        
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $ville = str_replace('-', ' ', $ville);
    $lat = str_replace('a', '.', $lat);
    $lon = str_replace('a', '.', $lon);
    $dompdf->loadHtml("$ville est situé au coordonnées $lat, $lon");

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    }
}

