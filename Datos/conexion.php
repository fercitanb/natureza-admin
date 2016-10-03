<?php

class Conexion
{private $cadenaConexion;
    private $user;
    private $password;
    private $objetoConexion;

    public function __construct()
    {
        $this->cadenaConexion='mysql:host=localhost;dbname=naturezabdd';
        $this->user='root';
        $this->password='';
    }

    /*public function __construct($cadenaConexion,$user,$password)
    {
        $this->cadenaConexion=$cadenaConexion;
        $this->user=$user;
        $this->password=$password;
    }*/

    public function ConectarBD()
    {
        try
        {
            $this->objetoConexion = new PDO($this->cadenaConexion,  $this->user ,  $this->password );
            $this->objetoConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex)
        {
            echo "Problemas para conectar con la base de datos";
        }
    }

    public function Desconectar()
    {
        $this->objetoConexion=null;
    }


    function Conectar(){
        return mysqli_connect("localhost","root","");
    }

    public function Select($strComando)
    {
        try
        {
            $ejecutar=$this->objetoConexion->prepare($strComando);
            $ejecutar->execute();

            $rows = $ejecutar->fetchAll();
            return $rows;
        }
        catch(PDOException $ex)
        {
            throw $ex;
        }

    }
}

?>