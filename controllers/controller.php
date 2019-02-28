<?php
require_once('methods/metodos.php');
session_start();

  class entorno{
    //Se instancia conexion a la base de datos y funciones globales de la clase
    function __construct(){
      $this->setup = new entries();
    }
    function display_mns($instancia,$tipo,$mns){
      header("location: ?nt=".$instancia."&mns_t=".base64_encode($tipo)."&mns_m=".base64_encode($mns));
    }
    function elimina_acentos($text){
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array (
            // Espacios, puntos y comas por guion
            //'/[\., ]+/' => ' ',

            // Vocales
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',

            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',

            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',

            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',

            // Agregar aqui mas caracteres si es necesario

        );

        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }

    //================= ADMINISTRACIÓN DE SESSION ======================//
    function login(){
      $params['user'] = $_POST['user'];
      $params['pass'] = $_POST['pass'];
      $login = $this->setup->login_validate($params);
      if (count($login) == 0) {
        $this->display_mns('index','info','El Usuario ingresado no existe!');
      }else{
        if (password_verify($params['pass'], $login[0]->password)) {
          $_SESSION['cc-id'] = $login[0]->id;
          $_SESSION['cc-ident'] = $login[0]->ident;
          if ($login[0]->ident == $params['pass']) {
            header("location: ?nt=change_pass");
          }else{
            $_SESSION['cc-status'] = 'ACT';
            $_SESSION['cc-nombre'] = $login[0]->nombre;
            $_SESSION['cc-email'] = $login[0]->email;
            header("location: ?nt=home");
          }
        }else{
          $this->display_mns('index','danger','La contraseña ingresada es incorrecta!');
        }
      }
    }
    function login_end(){
      session_destroy();
      $_SESSION = array();
      header('location: ?nt=index');

    }
    function edit_password(){
      $params['user'] = $_SESSION['cc-ident'];
      $params['pass_0'] = $_POST['pass_0'];
      $params['pass_1'] = $_POST['pass_1'];
      $params['pass_2'] = $_POST['pass_2'];

      $usuario = $this->setup->login_validate($params);

      if (password_verify($params['pass_0'], $usuario[0]->password)) {
        if ($params['pass_1'] == $params['pass_2']) {
          if ($params['pass_1'] == $params['user']) {
            $this->display_mns('index','warning','Su contraseña no puede ser igual a su usuario!');
          }else{
            $params['id_usuario'] = $_SESSION['cc-id'];
            $params['column'] = 'password';
            $params['value'] = password_hash($params['pass_1'], PASSWORD_DEFAULT);
            $change_pass = $this->setup->set_usuarios_EDIT($params);
            if ($change_pass[0] == "00000") {
              session_destroy();
              $_SESSION = array();
              $this->display_mns('index','info','Se cambio la contraseña con exito, por favor ingrese nuevamente!');
            }else{
              $this->display_mns('change_pass','danger',$change_pass[2]);
            }
          }
        }else{
          $this->display_mns('change_pass','warning','Las contraseñas no coinciden!');
        }
      }else{
        $this->display_mns('change_pass','warning','La contraseña actual es incorrecta!');
      }
    }

    //================= FUNCIONES DE ENTORNO ======================//
    function index(){
      if (isset($_SESSION['cc-status'])) {
        header("location: ?nt=home");
      }else{
        include_once('views/structure/header.php');
        include_once('views/resources/login.php');
        include_once('views/structure/end.php');
      }
    }
    function change_pass(){
      include_once('views/structure/header.php');
      include_once('views/resources/change_pass.php');
      include_once('views/structure/end.php');
    }
    function home(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        include_once('views/structure/header.php');
        include_once('views/structure/navbar.php');
        include_once('views/resources/index.php');
        include_once('views/structure/end.php');
      }
    }

    function kardex(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        include_once('views/structure/header.php');
        include_once('views/structure/navbar.php');
        include_once('views/resources/kardex.php');
        include_once('views/structure/end.php');
      }
    }
    function kardex_det(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        $params['radicado'] = $_REQUEST['radicado'];
        $proceso = $this->setup->get_kardex_RAD($params);
        $conceptos = $this->setup->get_conceptos_ACT();
        $actuaciones = $this->setup->get_actuaciones_RAD($params);
        $embargos = $this->setup->get_embargos_RAD($params);
        $actividades = $this->setup->get_actividades_ACT();
        $objetos = $this->setup->get_objetos_ACT();
        include_once('views/structure/header.php');
        include_once('views/structure/navbar.php');
        include_once('views/resources/kardex_det.php');
        include_once('views/structure/end.php');
      }
    }

    function ddep(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        include_once('views/structure/header.php');
        include_once('views/structure/navbar.php');
        include_once('views/resources/ddep.php');
        include_once('views/structure/end.php');
      }
    }
    function ddep_det(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        $params['id'] = $_REQUEST['id'];
        $ddep = $this->setup->get_ddep_ID($params);
        $resp = $this->setup->get_respuesta_DDEP($params);
        include_once('views/structure/header.php');
        include_once('views/structure/navbar.php');
        include_once('views/resources/ddep_det.php');
        include_once('views/structure/end.php');
      }
    }

    //================== FUNCIONES DE INFORME ======================//
    function informes(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        include_once('views/structure/header.php');
        include_once('views/structure/navbar.php');
        include_once('views/resources/informes.php');
        include_once('views/structure/end.php');
      }
    }
    function load_pres_predial(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        $params['num_ddep'] = $_REQUEST['ddep'];
        $ddep = $this->setup->get_ddep_NUM($params);
        $params['id'] = $ddep[0]->id;
        $respuesta = $this->setup->get_respuesta_DDEP($params);
        include_once('views/resources/informes/pres_predial.php');
      }
    }
    function load_pres_predial_neg(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        $params['num_ddep'] = $_REQUEST['ddep'];
        $ddep = $this->setup->get_ddep_NUM($params);
        $params['id'] = $ddep[0]->id;
        $respuesta = $this->setup->get_respuesta_DDEP($params);
        include_once('views/resources/informes/pres_predial_neg.php');
      }
    }
    function load_sobres_ddep(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        $params['num_ddep'] = $_REQUEST['ddep'];
        $ddep = $this->setup->get_ddep_NUM($params);
        $params['name'] = $ddep[0]->nombre;
        $params['ident'] = $ddep[0]->fk_mTerceros;
        $params['dir'] = $ddep[0]->direccion;
        $params['ciu'] = $ddep[0]->ciudad;
        include_once('views/resources/informes/sobres.php');
      }
    }
    function load_citacion_ddep(){
      if (!isset($_SESSION['cc-status'])) {
        header("location: ?nt=index");
      }else{
        $params['num_ddep'] = $_REQUEST['ddep'];
        $ddep = $this->setup->get_ddep_NUM($params);
        $params['id'] = $ddep[0]->id;
        $respuesta = $this->setup->get_respuesta_DDEP($params);
        include_once('views/resources/informes/citacion_ddep.php');
      }
    }

    //=================== FUNCIONES DE API ========================//
    function get_kardex_ALL(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
      $data = $this->setup->get_kardex_ALL();
        for ($i=0; $i < count($data); $i++) {
          $result['data'][$i][0] = "<a href='?nt=kardex_det&radicado=".$data[$i]->radicado."'>".$data[$i]->radicado."</a> ";
          $result['data'][$i][1] = $data[$i]->fk_mTerceros;
          $result['data'][$i][2] = utf8_encode($data[$i]->nombre);
          $result['data'][$i][3] = utf8_decode($data[$i]->concepto);
          $result['data'][$i][4] = $data[$i]->valor;
          $result['data'][$i][5] = $data[$i]->fecha_titulo;
          $result['data'][$i][6] = $data[$i]->estado;
        }
      }
      echo json_encode($result);
    }
    function set_kardex_EDIT(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['radicado'] = $_REQUEST['radicado'];
        $params['concepto'] = $_REQUEST['concepto'];
        $params['titulo'] = $_REQUEST['titulo'];
        $params['fecha'] = $_REQUEST['fecha'];
        $params['valor'] = $_REQUEST['valor'];
        $params['obs'] = $_REQUEST['obs'];

        $edit = $this->setup->set_kardex_EDIT($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }
    function set_kardex_INC(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['radicado'] = $_REQUEST['radicado'];

        $edit = $this->setup->set_kardex_INC($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }
    function get_kardex_COUNT(){
      $params['radicado'] = $_REQUEST['radicado'];

      $kardex = $this->setup->get_kardex_RAD($params);

      if (count($kardex) == 0) {
        $result['status'] = 'ERROR';
        $result['err_mns'] = 'No existe un proceso con radicado '.$params['radicado'];
      }else{
        $result['status'] = 'SUCCESS';
      }
      echo json_encode($result);
    }

    function set_actuaciones_NEW(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['radicado'] = $_REQUEST['radicado'];
        $params['fk_tActividades'] = $_REQUEST['fk_tActividades'];
        $params['obs'] = $_REQUEST['obs'];
        $params['fecha'] = $_REQUEST['fecha'];

        $edit = $this->setup->set_actuaciones_NEW($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }
    function set_actuaciones_INC(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['id'] = $_REQUEST['id'];

        $edit = $this->setup->set_actuaciones_INC($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }

    function set_embargos_NEW(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['radicado'] = $_REQUEST['radicado'];
        $params['fk_tObjetos'] = $_REQUEST['fk_tObjetos'];
        $params['identificador'] = $_REQUEST['identificador'];
        $params['fecha'] = $_REQUEST['fecha'];

        $edit = $this->setup->set_embargos_NEW($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }
    function set_embargos_INC(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['id'] = $_REQUEST['id'];

        $edit = $this->setup->set_embargos_INC($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }
    function set_embargos_STATUS(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['id'] = $_REQUEST['id'];
        $params['value'] = $_REQUEST['value'];

        $edit = $this->setup->set_embargos_STATUS($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }

    function get_terceros_ID(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['id'] = $_REQUEST['id'];
        $data = $this->setup->get_terceros_ID($params);
        if (count($data) == 0) {
          $result['status'] = "NOEXIST";
          $result['err_mns'] = "El tercero no exite, desea crearlo?";
        }else{
          $result['status'] = "SUCCESS";
          $result['tercero'] = $data[0]->nombre;
        }
      }
      echo json_encode($result);
    }
    function set_terceros_NEW(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['id'] = $_REQUEST['id'];
        $params['nombre'] = $_REQUEST['nombre'];

        $edit = $this->setup->set_terceros_NEW($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
          $result['tercero'] = strtoupper($params['nombre']);
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }

      }
      echo json_encode($result);
    }
    function set_terceros_EDIT(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['id'] = $_REQUEST['id'];
        $params['nombre'] = $_REQUEST['nombre'];

        $edit = $this->setup->set_terceros_EDIT($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }
      }
      echo json_encode($result);
    }

    function get_DdeP_ACT(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
      $data = $this->setup->get_ddep_ACT();
        for ($i=0; $i < count($data); $i++) {
          $result['data'][$i][0] = "<a href='?nt=ddep_det&id=".$data[$i]->id."' data-toggle='tooltip' data-placement='left' title='".utf8_encode($data[$i]->obs)."'>".$data[$i]->num_ddep."</a> ";
          $result['data'][$i][1] = $data[$i]->fecha_ddep;
          $result['data'][$i][2] = $data[$i]->fk_mTerceros;
          $result['data'][$i][3] = utf8_encode($data[$i]->nombre);
          $result['data'][$i][4] = $data[$i]->reso_res;
          $result['data'][$i][5] = $data[$i]->fecha_res;
        }
      }
      echo json_encode($result);
    }
    function set_DdeP_NEW(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['num_ddep'] = $_REQUEST['num_ddep'];
        $params['fecha_ddep'] = $_REQUEST['fecha_ddep'];
        $params['fk_mTerceros'] = $_REQUEST['fk_mTerceros'];
        $params['direccion'] = $_REQUEST['direccion'];
        $params['obs'] = utf8_decode($_REQUEST['obs']);
        $params['ciudad'] = $_REQUEST['ciudad'];

        if(count($this->setup->get_ddepID_NUM($params)) == 0){

          $edit = $this->setup->set_ddep_NEW($params);

          if ($edit[0] == "00000") {
            $id = $this->setup->get_ddepID_NUM($params);
            mkdir("views/public/".$params['num_ddep'], 0700);
            $result['status'] = 'SUCCESS';
            $result['ddep'] = $id[0]->id;
          }else{
            $result['status'] = 'ERROR';
            $result['err_code'] = $edit[0];
            $result['err_mns'] = $edit[2];
          }

        }else{
          $result['status'] = 'ERROR';
          $result['err_mns'] = 'El derecho de petición que desea crear ya existe!';
        }
      }
      echo json_encode($result);
    }
    function set_DdeP_ANX(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['fk_mDdep'] = $_REQUEST['fk_mDdep'];
        $params['file'] = $_REQUEST['file'] == '' ? $this->elimina_acentos($_FILES['archivo']['name']) : $this->elimina_acentos($_REQUEST['file']);
        $dir_subida = "views/public/".$params['fk_mDdep']."/".$params['file'];

        if (move_uploaded_file($_FILES['archivo']['tmp_name'], $dir_subida)) {
          $result['status'] = 'SUCCESS';
        } else {
          $result['status'] = 'ERROR';
          $result['msn_err'] = 'Ups Algo Ocurrio';
        }
      }
      echo json_encode($result);
    }
    function set_DdeP_EDIT(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['id'] = $_REQUEST['id'];
        $params['column'] = $_REQUEST['column'];
        $params['value'] = $_REQUEST['value'];

        $edit = $this->setup->set_ddep_IND($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }
      }
      echo json_encode($result);
    }
    function get_DdeP_COUNT(){
      $params['num_ddep'] = $_REQUEST['ddep'];

      $ddep = $this->setup->get_ddepID_NUM($params);

      if (count($ddep) == 0) {
        $result['status'] = 'ERROR';
        $result['err_mns'] = 'No existe un DDEP con radicado '.$params['num_ddep'];
      }else{
        $result['status'] = 'SUCCESS';
        $result['ddep'] = $ddep[0]->id;
      }
      echo json_encode($result);
    }

    function set_respuesta_NEW(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $id = $_REQUEST['id'];

        $insert = $this->setup->set_respuesta_GEN($id);

        if ($insert[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $insert[0];
          $result['err_mns'] = $insert[2];
        }
      }
      echo json_encode($result);
    }
    function set_respuesta_EDIT(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['fk_mDdep'] = $_REQUEST['fk_mDdep'];
        $params['reso_res'] = $_REQUEST['reso_res'];
        $params['fecha_res'] = $_REQUEST['fecha_res'];
        $params['notificacion'] = strtoupper($_REQUEST['notificacion']);
        $params['fecha_noti'] = $_REQUEST['fecha_noti'];

        $insert = $this->setup->set_respuesta_ADD($params);

        if ($insert[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $insert[0];
          $result['err_mns'] = $insert[2];
        }
      }
      echo json_encode($result);
    }

    function get_directorio(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $ddep = $_REQUEST['ddep'];
        $directorio = scandir("views/public/".$ddep."/");

        if (count($directorio) == 2) {
          $result['status'] = "ERROR";
        }else{
          $result['status'] = "SUCCESS";
          $result['ddep'] = $ddep;
          for ($i=2; $i < count($directorio); $i++) {
            $result['dir'][$i - 2] = $directorio[$i];
          }
        }
      }
      echo json_encode($result);
    }
    function del_directorio(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $url = $_REQUEST['url'];
        unlink($url);

        if (file_exists($url)) {
          $result['status'] = "ERROR";
          $result['err_mns'] = "El Archivo no se elimino";
        }else{
          $result['status'] = "SUCCESS";
        }
      }
      echo json_encode($result);
    }

    function get_predios(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $tercero = $_REQUEST['ident'];

        $predios = $this->setup->get_predios_TERCERO($tercero);

        for ($i=0; $i < count($predios); $i++) {
          $result['predios'][$i]['id'] = $predios[$i]->id;
          $result['predios'][$i]['codigo'] = $predios[$i]->codigo;
          $result['predios'][$i]['dir'] = $predios[$i]->dir;
          $result['predios'][$i]['avaluo'] = $predios[$i]->avaluo;
        }
        $result['status'] = "SUCCESS";
      }
      echo json_encode($result);
    }
    function set_predios_TXT(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $ddep = $_REQUEST['num_ddep'];
        $predios = json_decode($_REQUEST['predios']);

        $ruta = "views/public/".$ddep."/predios.txt";

        if (file_exists($ruta)) {
          unlink($ruta);
        }

        if ($prediosTXT = fopen($ruta,"a")) {
          for ($i=0; $i < count($predios); $i++) {
            $pred = $this->setup->get_predios_ID($predios[$i]->value);
            $linea = $pred[0]->codigo.",".$pred[0]->dir.",".$pred[0]->avaluo;
            fwrite($prediosTXT,$linea.PHP_EOL);
          }
          fclose($prediosTXT);
          $result['status'] = 'SUCCESS';
        }else {
          $result['status'] = 'ERROR';
          $result['err_mns'] = 'Ocurrio un error y el archivo no se creo con exito';
        }
      }
      echo json_encode($result);
    }

    function set_prescripcion(){
      if (!isset($_SESSION['cc-status'])) {
        $result['status'] = "ERROR";
        $result['err_mns'] = "No tiene autorizacion para acceder.";
      }else{
        $params['column'] = $_REQUEST['column'];
        $params['value'] = $_REQUEST['value'];
        $params['id'] = $_REQUEST['id'];

        $edit = $this->setup->set_prescripcion($params);

        if ($edit[0] == "00000") {
          $result['status'] = 'SUCCESS';
        }else{
          $result['status'] = 'ERROR';
          $result['err_code'] = $edit[0];
          $result['err_mns'] = $edit[2];
        }
      }
      echo json_encode($result);
    }


    function prueba(){
      $base = '[{"name":"predios[]", "value":"16221"}, {"name":"predios[]", "value":"16222"}]';

      $base2 = json_decode($base);

      $ruta = "views/public/01163/predios.txt";

      if (file_exists($ruta)) {
        unlink($ruta);
      }

      if ($prediosTXT = fopen($ruta,"a")) {
        for ($i=0; $i < count($predios); $i++) {
          $pred = $this->setup->get_predios_ID($predios[$i]->value);
          $linea = $pred[0]->codigo.",".$pred[0]->dir.",".$pred[0]->avaluo;
          fwrite($prediosTXT,$linea.PHP_EOL);
        }
        fclose($prediosTXT);
        $result['status'] = 'SUCCESS';
      }else {
        $result['status'] = 'ERROR';
        $result['err_mns'] = 'Ocurrio un error y el archivo no se creo con exito';
      }

      echo json_encode($result);
    }

  }
?>
