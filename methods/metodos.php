<?php
date_default_timezone_set("America/Bogota");
include_once("bd/dbConex.php");

  class entries{

    private $db;
    private $result;

    function __construct(){
      $this->db=Base_de_datos::connect();
    }
    // ==============  FUNCIONES POR TABLE ===================== //

    //Tabla Usuarios
    function login_validate($params){
      $query = $this->db->query("SELECT * FROM usuarios WHERE estado = 'ACT' AND ident = '".$params['user']."' LIMIT 1")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function set_usuarios_EDIT($params){
      $now = date("Y-m-d");
      $update = $this->db->query("UPDATE usuarios SET ".$params['column']." = '".$params['value']."', fecha = '".$now."' WHERE id = ".$params['id_usuario']);
      $this->result = $this->db->errorInfo();

      return $this->result;
    }

    //Tabla m_kardex
    function get_kardex_ALL(){
      $query = $this->db->query("SELECT *,(SELECT nombre FROM m_terceros WHERE id = fk_mTerceros) AS nombre,(SELECT concepto FROM m_conceptos WHERE id = fk_mConceptos) AS concepto FROM m_kardex")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function get_kardex_RAD($params){
      $query = $this->db->query("SELECT *,(SELECT nombre FROM m_terceros WHERE id = fk_mTerceros) AS nombre FROM m_kardex WHERE radicado = '".$params['radicado']."'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function set_kardex_EDIT($params){
      $now = date("Y-m-d");
      $update = $this->db->query("UPDATE m_kardex SET fk_mConceptos = '".$params['concepto']."', titulo = '".$params['titulo']."', fecha_titulo = '".$params['fecha']."', valor = '".$params['valor']."', observaciones = '".$params['obs']."', ult_mod = '$now' WHERE radicado = '".$params['radicado']."'");
      $this->result = $this->db->errorInfo();

      return $this->result;
    }
    function set_kardex_INC($params){
      $now = date("Y-m-d");
      $query = $this->db->query("UPDATE m_kardex SET estado = 'INC', ult_mod = '$now' WHERE radicado = '".$params['radicado']."'");
      $this->result = $this->db->errorInfo();

      return $this->result;
    }

    //Tabla m_conceptos
    function get_conceptos_ACT(){
      $query = $this->db->query("SELECT * FROM m_conceptos WHERE estado = 'ACT'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }

    //Tabla k_actuaciones
    function get_actuaciones_RAD($params){
      $query = $this->db->query("SELECT *,(SELECT nombre FROM t_actividades WHERE id = fk_tActividades) AS actividad FROM k_actuaciones WHERE estado = 'ACT' AND radicado = '".$params['radicado']."'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function set_actuaciones_NEW($params){
      $now = date("Y-m-d");
      $insert = $this->db->query("INSERT INTO k_actuaciones (radicado, fk_tActividades, obs, fecha, estado, fecha_estado) VALUES ('".$params['radicado']."','".$params['fk_tActividades']."','".$params['obs']."','".$params['fecha']."','ACT','$now')");
      $this->result = $this->db->errorInfo();

      return $this->result;
    }
    function set_actuaciones_INC($params){
      $now = date("Y-m-d");
      $query = $this->db->query("UPDATE k_actuaciones SET estado = 'INC', fecha_estado = '$now' WHERE id = ".$params['id']);
      $this->result = $this->db->errorInfo();

      return $this->result;
    }

    //Tabla k_embargos
    function get_embargos_RAD($params){
      $query = $this->db->query("SELECT *,(SELECT objeto FROM t_objetos WHERE id = fk_tObjetos) AS objeto, (SELECT nombre FROM t_estatus WHERE id = fk_tEstatus) AS status FROM k_embargos WHERE estado = 'ACT' AND radicado = '".$params['radicado']."'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function set_embargos_NEW($params){
      $now = date("Y-m-d");
      $insert = $this->db->query("INSERT INTO k_embargos (radicado, fk_tObjetos, identificador, fecha_emb, fk_tEstatus, fecha_estatus, estado, fecha_estado) VALUES ('".$params['radicado']."','".$params['fk_tObjetos']."','".$params['identificador']."','".$params['fecha']."', '4', '$now','ACT','$now')");
      $this->result = $this->db->errorInfo();

      return $this->result;
    }
    function set_embargos_INC($params){
      $now = date("Y-m-d");
      $query = $this->db->query("UPDATE k_embargos SET estado = 'INC', fecha_estado = '$now' WHERE id = ".$params['id']);
      $this->result = $this->db->errorInfo();

      return $this->result;
    }
    function set_embargos_STATUS($params){
      $now = date("Y-m-d");
      $query = $this->db->query("UPDATE k_embargos SET fk_tEstatus = '".$params['value']."', fecha_estatus = '$now' WHERE id = ".$params['id']);
      $this->result = $this->db->errorInfo();

      return $this->result;
    }

    //Tabla t_actividades
    function get_actividades_ACT(){
      $query = $this->db->query("SELECT * FROM t_actividades WHERE estado = 'ACT'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }

    //Tabla t_objetos
    function get_objetos_ACT(){
      $query = $this->db->query("SELECT * FROM t_objetos WHERE estado = 'ACT'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }

    //Tabla m_terceros
    function get_terceros_ID($params){
      $query = $this->db->query("SELECT * FROM m_terceros WHERE id = ".$params['id'])->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function set_terceros_NEW($params){
      $insert = $this->db->query("INSERT INTO m_terceros VALUES ('".$params['id']."','".$params['nombre']."')");
      $this->result = $this->db->errorInfo();

      return $this->result;
    }

    //Tabla DdeP
    function get_ddep_ACT(){
      $query = $this->db->query("SELECT *, (SELECT nombre FROM m_terceros WHERE id = fk_mTerceros) AS nombre, (SELECT reso_res FROM d_res_ddep WHERE fk_mDdep = m_ddep.id) AS reso_res, (SELECT fecha_res FROM d_res_ddep WHERE fk_mDdep = m_ddep.id) AS fecha_res FROM m_ddep WHERE m_ddep.estado = 'ACT'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function get_ddep_ID($params){
      $query = $this->db->query("SELECT *, (SELECT nombre FROM m_terceros WHERE id = fk_mTerceros) AS nombre FROM m_ddep WHERE id = ".$params['id'])->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function get_ddepID_NUM($params){
      $query = $this->db->query("SELECT id FROM m_ddep WHERE num_ddep = '".$params['num_ddep']."'")->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function set_ddep_NEW($params){
      $insert = $this->db->query("INSERT INTO m_ddep(num_ddep, fecha_ddep, fk_mTerceros, direccion, obs, ciudad, estado) VALUES ('".$params['num_ddep']."', '".$params['fecha_ddep']."', '".$params['fk_mTerceros']."', '".$params['direccion']."', '".$params['obs']."', '".$params['ciudad']."','ACT')");
      $this->result = $this->db->errorInfo();

      return $this->result;
    }

    //Tabla d_res_ddep
    function set_respuesta_GEN($id){
      $insert = $this->db->query("INSERT INTO d_res_ddep(fk_mDdep) VALUES ('".$id."')");
      $this->result = $this->db->errorInfo();

      return $this->result;
    }
    function get_respuesta_DDEP($params){
      $query = $this->db->query("SELECT * FROM d_res_ddep WHERE fk_mDdep = ".$params['id'])->fetchALL(PDO::FETCH_OBJ);
      $this->result = $query;

      return $this->result;
    }
    function set_respuesta_ADD($params){
      $insert = $this->db->query("UPDATE d_res_ddep SET reso_res = '".$params['reso_res']."', fecha_res = '".$params['fecha_res']."', notificacion = '".$params['notificacion']."', fecha_noti = '".$params['fecha_noti']."' WHERE fk_mDdep = ".$params['fk_mDdep']);
      $this->result = $this->db->errorInfo();

      return $this->result;
    }



  }
?>
