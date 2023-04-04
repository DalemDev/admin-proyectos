<?php
  class conexion{
    private $server="localhost";
    private $usuario="root";
    private $contrasenia="";
    private $conexion;
    
    public function __construct(){
      try {
        $this->conexion=new PDO("mysql:host=$this->server; dbname=album", $this->usuario, $this->contrasenia);
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $error) {
        echo "falla de conexion".$error;
      }
    }
    public function ejecutar($sql){
      $this->conexion->exec($sql);
      return $this->conexion->lastInsertId();
    }
    public function consultar($sql){
      $sentencia=$this->conexion->prepare($sql);
      $sentencia->execute();
      return $sentencia->fetchAll();
    }
  }
?>