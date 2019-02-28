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
$html .= '<meta charset="utf-8"><title>Resolución de Prescripción</title>';
$html .= '<style>
@page {margin-top: 16,25em;margin-bottom: 6,87em;margin-left: 5,11em;margin-right: 5,11em;}body{font-family: Arial, sans-serif;font-size: 16px;}h1{font-size: 16px;text-align:center}.header{position: fixed; left: 0px; top: -260px; right: 0px; height: 240px;padding-top:2em;font-size:14px;}.header h1{font-size:14px;}.header .info{font-weight:none}.footer{position: fixed; left: 0px; bottom: -110px; right: 0px; height: 100px; font-size:14px;}.img-left{position: fixed; left: 0px; top: -260px; right: 0px; height: 240px;padding-top:2em;}.img-right{position: fixed; left: 550px; top: -260px; right: 5px; height: 240px;padding-top:2em;}.vigencias{width:100%;border:1px solid;border-collapse: collapse;}.vigencias tr td,th{border:1px solid; padding-left:5px;padding-right:10px;}.totales{font-weight: bold;}.predios{width:100%;border-collapse: collapse;}.predios tr th,td{border:1px solid;padding-left:5px; }.t-center{text-align: center;}.t-just{text-align: justify;}.t-left{text-align: left;}.t-right{text-align: right;}.r-Line2{margin-top: -10px;}.r-firma{margin-top: 100px;}.item{font-weight: bold;}

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
$html .= '<h1>RESOLUCIÓN '.$respuesta[0]->reso_res.'</h1>';
$html .= '<p class="t-center r-Line2">'.date("d",strtotime($respuesta[0]->fecha_res)).' de '.strftime("%B",strtotime($respuesta[0]->fecha_res)).' de '.date("Y",strtotime($respuesta[0]->fecha_res)).'<p>';
$html .= '<h1>"POR MEDIO DE LA CUAL SE RESUELVE UNA SOLICITUD DE PRESCRIPCIÓN SOBRE EL IMPUESTO PREDIAL UNIFICADO DDEP '.$ddep[0]->num_ddep.' DEL '.date("d",strtotime($ddep[0]->fecha_ddep)).' DE '.strtoupper(strftime("%B",strtotime($ddep[0]->fecha_ddep))).' DEL '.date("Y",strtotime($ddep[0]->fecha_ddep)).'"</h1>';
$html .= '</div>';

//ATRIBUCIONES
$html .= '<p class="t-just">El Secretario de Hacienda del Municipio de Chigorodó, en uso de sus atribuciones constitucionales y legales, en especial los conferidos por el Decreto AL01-06-01-No 007 del 10 de enero de 2014; y</p>';

//CONSIDERANDO
$html .= '<h1>CONSIDERANDO:</h1>';

$html .= '<p class="t-just"><b class="item">1.</b> Que '.$ddep[0]->nombre.' con identificación número '.number_format($ddep[0]->fk_mTerceros,0,".",".").', solicita la prescripción de lo adeudado por el Impuesto Predial en lo correspondiente al(los) inmueble(s) que se detalla(n) a continuación:</p>';

//TABLA PREDIOS
$html .= '<table class="t-center predios"><tr><th>Código</th><th>Dirección</th><th>Avalúo</th></tr>';
$predios = file('views/public/'.$ddep[0]->num_ddep.'/predios.txt');
foreach ($predios as $value) {
  list($predio,$direccion,$avaluo) = explode(",",$value);
  $html .= '<tr><td>'.$predio.'</td><td>'.$direccion.'</td><td>'.number_format((float)$avaluo,0,".",".").'</td></tr>';
}

$html .= '</table>';

$html .= '<p class="t-just"><b class="item">2.</b> Que, en el sentir del contribuyente, la administración ha perdido la fuerza de ejecutoria frente al debido cobro del valor en cuestión y cabe la aplicación de lo establecido por el artículo 817 del Estatuto Tributario Nacional.</p>';

$html .= '<p class="t-just"><b class="item">3.</b> Que mediante petición '.$ddep[0]->num_ddep.' DEL '.date("d",strtotime($ddep[0]->fecha_ddep)).' DE '.strtoupper(strftime("%B",strtotime($ddep[0]->fecha_ddep))).' DEL '.date("Y",strtotime($ddep[0]->fecha_ddep)).' el contribuyente solicito la prescripción de lo adeudado por concepto del impuesto predial unificado.</p>';

$html .= '<p class="t-just"><b class="item">4.</b> Que de acuerdo con los registros que aparecen en el sistema de información del Municipio de Chigorodó el contribuyente registra deuda, por los inmuebles relacionados anteriormente, desde el año '.$ddep[0]->y_ini.' al año '.$ddep[0]->y_fin.' detallada de la siguiente manera:</p>';

//TABLA VIGENCIAS
$html .= '<table class="vigencias t-center"><tr><th width="33%">Año</th><th width="33%">Valor Vigencia</th><th width="34%">Deuda Acumulada</th></tr>';
$vigencias = file('views/public/'.$ddep[0]->num_ddep.'/vigencias.txt');
$total = '';

foreach ($vigencias as $value) {
  list($b1,$b2,$b3,$vigencia,$b4,$actual,$b5,$b6,$acum) = explode(",",$value);
  $html .= '<tr><td>'.$vigencia.'</td><td>'.number_format((float)$actual,2,".",".").'</td> <td>'.number_format((float)$acum,2,".",".").'</td></tr>';
  $total = $acum;
}
$html .= '<tr class="totales"><td>Total</td><td>'.number_format((float)$total,2,".",".").' </td><td></td></tr> </table>';

$html .= '<p class="t-just"><b class="item">5.</b> Que analizadas las piezas procesales, no se observaron las causales de interrupción ni suspensión de la prescripción de la acción de cobro contenidas en el Decreto AL01-06-01-No 007 de 2014, y que este despacho concuerda con los argumentos expuestos por el contribuyente, por lo que es factible determinar que ha expirado el tiempo para que la Administración Municipal realice los actos tendientes hacer exigible el cobro de la obligación tributaria, y por lo tanto deberá este despacho, resuelve CONCEDER la prescripción de la Acción de cobro por vigencias.</p>';

$html .= '<p class="t-just"><b class="item">6.</b> Que es deber de la Secretaría de Hacienda Municipal dar cumplimiento a las disposiciones y las normas generales sobre validez y aplicación de las Leyes, este despacho ha resuelto de fondo la solicitud de prescripción expuesta correspondiente a la deuda comprendida entre los años '.$ddep[0]->y_ini.' y el '.$ddep[0]->trimestre.' trimestre de 2013.</p>';

$html .= '<p class="t-just">En mérito de lo expuesto el Secretario de Hacienda del Municipio de Chigorodó,</p>';

//RESUELVE
$html .= '<h1>RESUELVE:</h1>';

$html .= '<p class="t-just"><b class="item">ARTÍCULO PRIMERO: RECONOCER</b> la prescripción del impuesto predial expuesta por '.$ddep[0]->nombre.' con identificación número '.number_format($ddep[0]->fk_mTerceros,0,".",".").', propietario(a) de los predios relacionados, por los períodos comprendidos entre la vigencia '.$ddep[0]->y_ini.' y el '.$trimestre.' trimestre de 2013 en razón de lo expuesto en la parte considerativa del presente acto.</p>';

$html .= '<p class="t-just"><b class="item">ARTÍCULO SEGUNDO: CONCEDER</b> la prescripción reconocida el artículo primero equivalente a '.strtoupper(CifrasEnLetras::convertirCifrasEnLetras($ddep[0]->v_ini)).' PESOS M/L ($'.number_format((float)$ddep[0]->v_ini,0,".",".").'), de conformidad con lo dispuesto por el artículo 817 del Estatuto Tributario Nacional y en razón de los expuesto en la parte considerativa del presente acto.</p>';

$html .= '<p class="t-just"><b class="item">ARTÍCULO TERCERO: LIQUIDAR Y FIJAR</b> el debido cobrar a '.$ddep[0]->nombre.' con identificación número '.number_format($ddep[0]->fk_mTerceros,0,".",".").', en la suma '.strtoupper(CifrasEnLetras::convertirCifrasEnLetras($ddep[0]->v_fin)).' PESOS M/L ($'.number_format((float)$ddep[0]->v_fin,0,".",".").') por concepto de impuesto predial e intereses moratorios.</p>';

$html .= '<p class="t-just"><b class="item">ARTÍCULO CUARTO: NOTIFICAR</b> personalmente la presente decisión al solicitante e informar que contra la presente procede recurso de reposición escrito en la diligencia de notificación personal, o dentro de los 10 días siguientes a ella, ante la secretaría de Hacienda de conformidad con el artículo 76 de la Ley 1437 de 2011.</p>';

$html .= '<p class="t-just"><b class="item">ARTÍCULO QUINTO: ORDENAR</b> a la oficina de cobro coactivo para que inicie el respectivo proceso de cobro coactivo y libre mandamiento de pago por el valor pendiente de pago al que hace referencia el artículo tercero del presente acto.</p>';

$html .= '<p class="t-just"><b class="item">ARTÍCULO SEXTO: ORDENAR</b> a la oficina de impuestos la aplicación de la presente decisión.</p>';

$html .= '<h1>NOTIFÍQUESE Y CÚMPLASE</h1>';

$html .= '<h1 class="r-firma">JESUS MARIA PARRA HERRERA</h1>';
$html .= '<p class="t-center r-Line2">Secretario de Hacienda<p>';

$html .= '</body></html>';

if (file_exists("views/public/".$ddep[0]->num_ddep."/Resolucion ".$respuesta[0]->reso_res.".pdf")) {
  unlink("views/public/".$ddep[0]->num_ddep."/Resolucion ".$respuesta[0]->reso_res.".pdf");
}

$dompdf = new DOMPDF();
$dompdf->set_paper('letter', 'portrait');
$dompdf->load_html($html);
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents("views/public/".$ddep[0]->num_ddep."/Resolucion ".$respuesta[0]->reso_res.".pdf", $pdf);
$dompdf->stream("Resolucion ".$respuesta[0]->reso_res.".pdf", array("Attachment" => 0));



?>
