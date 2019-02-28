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
$html .= '<meta charset="utf-8"><title>Citación para Notificar</title>';
$html .= '<style>
@page {margin-top: 2,25em;margin-bottom: 6,87em;margin-left: 5,11em;margin-right: 5,11em;}
body{font-family: Arial, sans-serif;font-size: 16px;}h1{font-size: 16px;text-align:center}.
header{position: fixed; left: 0px; top: -60px; right: 0px; height: 250px;padding-top:2em;font-size:14px;}.header h1{font-size:14px;}.header .info{font-weight:none}.footer{position: fixed; left: 0px; bottom: -110px; right: 0px; height: 100px; font-size:14px;}
.img-left{position: fixed; left: 0px; top: -40px; right: 0px; height: 240px;padding-top:2em;}
.img-right{position: fixed; left: 550px; top: -40px; right: 5px; height: 240px;padding-top:2em;}
.vigencias{width:100%;border:1px solid;border-collapse: collapse;}.vigencias tr td,th{border:1px solid; padding-left:5px;padding-right:10px;}.totales{font-weight: bold;}.predios{width:100%;border-collapse: collapse;}.predios tr th,td{border:1px solid;padding-left:5px; }.t-center{text-align: center;}.t-just{text-align: justify;}.t-left{text-align: left;}.t-right{text-align: right;}.r-Line2{margin-top: -10px;}.r-firma{margin-top: 100px;}.item{font-weight: bold;}

</style>';
$html .= '</head>';
$html .= '<body>';
//FOOTER DE LA RESOLUCIÓN
$html .= '<div class="footer">';
$html .= '<p class="t-center">“UNIDOS SI ES POSIBLE POR UN CHIGORODÓ EDUCADO Y PROSPERO”</p>';
$html .= '<p class="t-center r-Line2">Calle 98A No. 104 - 14 Telefax 825 49 06</p>';
$html .= '</div>';

//ENCABEZADO DE LA RESOLUCION
$html .= '<div class="img-left">';
$html .= '<img src="images/logo1.jpg" width="110px" height="100px">';
$html .= '</div>';

$html .= '<div class="img-right">';
$html .= '<img src="images/logo2.jpg" width="110px" height="100px">';
$html .= '</div>';

$html .= '<div class="header">';
$html .= '<h1 class="info">DEPARTAMENTO DE ANTIOQUIA</h1>';
$html .= '<h1 class="r-Line2 info">MUNICIPIO DE CHIGORODÓ</h1>';
$html .= '<h1 class="r-Line2 info">NIT:890.980.998-8</h1>';
$html .= '<h1 class="r-Line2 info">Secretaria de Hacienda</h1>';
$html .= '</div>';

$html .= '<br>';
$html .= '<br>';

$html .= 'Chigorodó, '.date("d",strtotime($ddep[0]->fecha_ddep)).' de '.strftime("%B",strtotime($ddep[0]->fecha_ddep)).' del '.date("Y",strtotime($ddep[0]->fecha_ddep));

$html .= '<br>';
$html .= '<br>';

//DESTINATARIO
$html .= '<p class="t-just">';
$html .= 'Señor(a):<br>';
$html .= '<strong>'.$ddep[0]->nombre.'</strong><br>';
$html .= number_format($ddep[0]->fk_mTerceros,"0",",",".").'<br>';
$html .= $ddep[0]->ciudad.'<br>';
$html .= '</p>';

$html .= '<br>';

//ASUNTO
$html .= 'Citación para Notificación Personal de la respuesta al Derecho de Petición '.$ddep[0]->num_ddep.' del '.date("d",strtotime($ddep[0]->fecha_ddep)).' de '.strftime("%B",strtotime($ddep[0]->fecha_ddep)).' del '.date("Y",strtotime($ddep[0]->fecha_ddep)).'.';

$html .= '<br>';
$html .= '<br>';

$html .= '<p>Cordial Saludo, </p>';

$html .= '<p class="t-just">La secretaría de Hacienda del Municipio de Chigorodó mediante resolución número '.$respuesta[0]->reso_res.' del '.date("d",strtotime($respuesta[0]->fecha_res)).' de '.strftime("%B",strtotime($respuesta[0]->fecha_res)).' del '.date("Y",strtotime($respuesta[0]->fecha_res)).' dio tramite al derecho de petición con radicado número ';
$html .= $ddep[0]->num_ddep.' del '.date("d",strtotime($ddep[0]->fecha_ddep)).' de '.strftime("%B",strtotime($ddep[0]->fecha_ddep)).' del '.date("Y",strtotime($ddep[0]->fecha_ddep)).'.</p>';

$html .= '<p class="t-just">Por lo anterior debe usted comparecer a este despacho dentro del término de diez (10) días contados a partir de la entrega de la presente cita, con el fin del recibir notificación personal, con relación al asunto de la referencia. Si al transcurrir dicho lapso usted no cumpliese la presente orden se le notificara por correo.</p>';

$html .= '<p class="t-just">Esto de conformidad con lo establecido en el artículo 68 del Código deProcedimiento Administrativo y de lo Contencioso Administrativo.</p><br>';

$html .= '<img src="images/firma.JPG" width="40%">';

$html .= '</body></html>';

if (file_exists("views/public/".$ddep[0]->num_ddep."/Resolucion.pdf")) {
  unlink("views/public/".$ddep[0]->num_ddep."/Resolucion.pdf");
}

$dompdf = new DOMPDF();
$dompdf->set_paper('letter', 'portrait');
$dompdf->load_html($html);
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents("views/public/".$ddep[0]->num_ddep."/Citacion.pdf", $pdf);
$dompdf->stream("Citacion.pdf", array("Attachment" => 0));



?>
