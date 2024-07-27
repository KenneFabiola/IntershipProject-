<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tcpdf' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php' ;
// require_once('../tcpdf/vendor/autoload.php');

// Exemple d'utilisation de TCPDF
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0, 'Bonjour, ceci est un exemple de PDF généré avec TCPDF.');
$pdf->Output('exemple.pdf', 'I');
