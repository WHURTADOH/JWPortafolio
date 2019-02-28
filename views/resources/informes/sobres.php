<?php
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, "es_ES");
setlocale(LC_TIME, 'spanish');
include 'CifrasEnLetras.php';

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$html = '';

$html = '<!DOCTYPE html><html>';
$html .= '<head>';
$html .= '<meta charset="utf-8"><title>Sobre de Correspondencia</title>';
$html .= '<style>
body{ font-family "Arial" } .destinatario{ text-align: right;margin-top: 50%; margin-left:55%; } .remitente{ margin-left:55%; }
</style>';
$html .= '</head>';
$html .= '<body>';

$html .= '<h2 class="remitente">JESUS MARIA PARRA HERRERA<br>';
$html .= 'SECRETARIO DE HACIENDA<br>';
$html .= 'MUNICIPIO DE CHIGORODÓ<br>';
$html .= 'CALLE 98A No. 104 - 14<br>';
$html .= 'CHIGORODÓ - ANTIOQUIA</h2>';


$html .= '<h2 class="destinatario">'.$params['name'].'<br>';
$html .=  $params['ident'].'<br>';
$html .= $params['dir'].'<br>';
$html .= $params['ciu'].'<br>';




$html .= '</body></html>';

$dompdf = new DOMPDF();
$dompdf->set_paper('letter', 'landscape');
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("Resolucion.pdf", array("Attachment" => 0));



?>
