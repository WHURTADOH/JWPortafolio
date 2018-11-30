<?php
  require_once('bd/dbConex.php');
  require_once('controllers/controller.php');

  //Se instancia la clase entorno
  $entorno = new entorno();

  //Se verifica si se extablece Navigation Target
  if(!empty($_GET['nt'])){
    //Si existe creo variable que la contenga
    $nt = $_REQUEST['nt'];

    //Verifico si existe función equivalente
    if(method_exists($entorno,$nt)){
      //Si existe ejecuto la función
      $entorno->$nt();
    }else{
      //Si no existe ejecuto la funcion Home
      $entorno->index();
    }
  }else{
    //Si no existe ejecuto la funcion Home
    $entorno->index();
  }
?>
