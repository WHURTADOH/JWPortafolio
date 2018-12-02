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
          $result['data'][$i][3] = $data[$i]->nombre;
          $result['data'][$i][4] = $data[$i]->reso_res;
          $result['data'][$i][5] = $data[$i]->fecha_res;
        }
      }
      echo json_encode($result);
    }
    function set_DdeP_NEW(){
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
      echo json_encode($result);
    }

    function set_respuesta_NEW(){
      $id = $_REQUEST['id'];

      $insert = $this->setup->set_respuesta_GEN($id);

      if ($insert[0] == "00000") {
        $result['status'] = 'SUCCESS';
      }else{
        $result['status'] = 'ERROR';
        $result['err_code'] = $insert[0];
        $result['err_mns'] = $insert[2];
      }

      echo json_encode($result);
    }
    function set_respuesta_EDIT(){
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

      echo json_encode($result);
    }




    function prueba(){
      $params['fk_mDdep'] = "01163";
      $dir_subida = "views/public/".$params['fk_mDdep']."/";
      $fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);

      echo '<pre>';
      if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
        $result['status'] = 'SUCCESS';
      } else {
        $result['status'] = 'ERROR';
        $result['msn_err'] = 'Ups Algo Ocurrio';
      }
      echo json_encode($result);
    }

  }
?>
