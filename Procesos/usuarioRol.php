<?php

include_once("../Datos/conexion.php");

class UsuarioRol
{
    private $IdUsuario;
    private $IdRol;

    private $conexion;

    public function __construct($IdUsuario,$IdRol)
    {
        $this->IdUsuario=$IdUsuario;
        $this->IdRol=$IdRol;

        $this->conexion=new Conexion();
    }


    public function getRol(){
        return $this->IdRol;
    }

    public function ObtieneRoles()
    {
        try {


            $this->conexion->ConectarBD();
            $filas=$this->conexion->Select("Select IdRol from usuariorol where IdUsuario=$this->IdUsuario");
            //verificar funcionamiento arreglos
            $listaRoles = array();
            for ($i=0; $i <count($filas) ; $i++) {
                array_push($listaRoles, $filas[$i]['IdRol']);
            }

            $this->conexion->Desconectar();
            return $listaRoles;
        } catch (PDOException $ex) {
            throw $ex;

        }
    }

}
?>