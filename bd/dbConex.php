<?php

class Base_de_datos
  {
    // creo los atributos de la clase
    private static $nombre_bd = 'coactivo_schema' ;
    private static $nombre_host = 'jwportafolio.com';
    private static $usuario_bd = 'coactivo';
    private static $contrase単a_bd = 'wahh7496';
    private static $cont  = null;


    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$nombre_host.";"."dbname=".self::$nombre_bd, self::$usuario_bd, self::$contrase単a_bd);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
  }
