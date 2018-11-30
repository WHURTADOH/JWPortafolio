<?php
date_default_timezone_set('America/Bogota');
setlocale(LC_ALL, "es_ES");
setlocale(LC_TIME, 'spanish');

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$html = '<!DOCTYPE html><html>';
$html .= '<head>';
$html .= '<meta charset="utf-8"><title>Resolución de Prescripción</title>';
$html .= '<style>
@page {margin-top: 10,25em;margin-bottom: 6,87em;margin-left: 5,11em;margin-right: 5,11em;}
body{font-family: Arial, sans-serif;font-size: 16px;}
h1{font-size: 18px;text-align:center}
.title{font-size: 24px;text-aling:center;margin-top:10px;}
.header{position: fixed; left: 0px; top: -150px; right: 0px; height: 60px;padding-top:4em;;font-size:14px;}
.header h1{font-size:18px;}
.header .info{font-weight:none}
.footer{position: fixed; left: 0px; bottom: -110px; right: 0px; height: 100px; font-size:14px;}
.img-left{position: fixed; left: 0px; top: -150px; right: 0px; height: 240px;padding-top:2em;}
.img-right{position: fixed; left: 550px; top: -260px; right: 5px; height: 240px;padding-top:2em;}
.t-center{text-align: center;}
.t-just{text-align: justify;}
.t-left{text-align: left;}
.t-right{text-align: right;}
.r-Line2{margin-top: -10px;}
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#006699", endColorstr="#00557F");background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #006699; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; font-size: 12px;border-bottom: 1px solid #CDD8DE;font-weight: normal; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }

</style>';
$html .= '</head>';
$html .= '<body>';
//FOOTER DE LA RESOLUCIÓN
$html .= '<div class="footer">';
$html .= '<p class="t-center">Impreso por '.$_SESSION['nombre'].' el '.date("Y-m-d").'</p>';
$html .= '<p class="t-center r-Line2">Desarrollado por J&W Portafolio Advisors S.A.S &copy; 2018 Todos los derechos Reservados.</p>';
$html .= '</div>';

//ENCABEZADO DE LA RESOLUCION
$html .= '<div class="img-left">';
$html .= '<img src="images/recaudo_logo.png" width="150px" height="100px">';
$html .= '</div>';

$html .= '<div class="header">';
$html .= '<h1 class="r-Line2 info">'.$entidad[0]->nombre.'</h1>';
$html .= '<h1 class="r-Line2 info">NIT: '.$entidad[0]->ident.'</h1>';
$html .= '<h1 class="r-Line2 info">Recaudo Mobile App</h1>';
$html .= '<hr>';
$html .= '</div>';

//TITULO
$html .= '<h1 class="title">Listado de Recaudo</h1>';
$html .= '<p class="t-center">Cuenta: '.$cuenta[0]->ncuenta.' <br> Fecha: '.$params['fecha'].'</p>';

//RECAUDO
$html .= '<div class="datagrid"><table>';
$html .= '<thead><tr><th>Factura</th><th>Concepto</th><th>Identificación</th> <th>Nombre</th><th>Voucher</th><th>Total</th></tr></thead>';
$html .= '<tbody>';

for ($i=0; $i < count($data); $i++) {
  $this->setup->set_recaudo_look_EXPORT($data[$i]->id_recaudo);
  $html .= '<tr>';
  $html .= '<td>'.$data[$i]->factura.'</td>';
  $html .= '<td>'.$data[$i]->concepto.'</td>';
  $html .= '<td>'.$data[$i]->tercero.'</td>';
  $html .= '<td>'.$data[$i]->nombre.'</td>';
  $html .= '<td>'.$data[$i]->voucher.'</td>';
  $html .= '<td style="text-align:right">$ '.number_format($data[$i]->recaudo, 0, '.', ',').'</td>';
  $html .= '</tr>';
}

$html .= '</tbody></table></div>';

$html .= '</body></html>';

$dompdf = new DOMPDF();
$dompdf->set_paper('letter', 'portrait');
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("Resolucion.pdf", array("Attachment" => 0));

?>
