<?php
include_once("../Datos/conexion.php");

class Usuario
{
    private $IdUsuario;
    private $Nombre;
    private $ApPat;
    private $ApMat;
    private $ci;
    private $usuario;
    private $Contrasenha;
    private $Correo;
    private $Estado;
    private $Telefono;

    private $conexion;

    public function __construct($Nombre, $ci, $ApPat, $ApMat, $Correo)
    {
        $this->IdUsuario = "";
        $this->Nombre = $Nombre;
        $this->ApPat = $ApPat;
        $this->ApMat = $ApMat;
        $this->ci = $ci;
        $this->usuario = "";
        $this->Contrasenha = "";
        $this->Correo = $Correo;
        $this->Estado = "";
        $this->Telefono = "";

        $this->conexion = new Conexion();
    }

    public function getIdUsuario()
    {
        return $this->IdUsuario;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getApPat()
    {
        return $this->ApPat;
    }

    public function getApMat()
    {
        return $this->ApMat;
    }

    public function getUsuario()
    {
        return $this->Usuario;
    }

    public function getContrasenha()
    {
        return $this->Contrasenha;
    }

    public function getCorreo()
    {
        return $this->Correo;
    }

    public function setUsuario($Usuario)
    {
        $this->Usuario = $Usuario;
    }

    public function setContrasenha($contrasenha)
    {
        $this->Contrasenha = $contrasenha;
    }

    public function setIdUsuario($IdUsuario)
    {
        $this->IdUsuario = $IdUsuario;
    }

    public function VerificaLogin($Login, $Password)
    {
        //$Contrasenha=md5($Password);

        $existe=0;
        $this->conexion->ConectarBD();
        $filas=$this->conexion->Select("Select * from usuario where usuario='".$Login."' and contrasenha=md5('".$Password."')");
        if(count($filas)){
            $this->IdUsuario=$filas[0]['idUsuario'];
            $this->Nombre=$filas[0]['nombre'];
            $this->ApPat=$filas[0]['apPaterno'];
            $this->ApMat=$filas[0]['apMaterno'];
            $this->usuario=$filas[0]['usuario'];
            $this->Contrasenha=$filas[0]['contrasenha'];
            $this->Correo=$filas[0]['email'];

            if($filas[0]['estado']==1){
                $existe=1;
            }
            else{
                $existe=2;
            }
        }

        $this->conexion->Desconectar();
        return $existe;
    }

    public function Consultar()
    {
        try {


            $this->conexion->Conectar();
            $filas = $this->conexion->EjecutarSelect("Select * from Usuario where IdUsuario=$this->IdUsuario");
            if (count($filas)) {
                $this->Nombre = $filas[0]['Nombre'];
                $this->ApPat = $filas[0]['ApPat'];
                $this->ApMat = $filas[0]['ApMat'];
                $this->Login = $filas[0]['Login'];
                $this->Correo = $filas[0]['Correo'];
                $this->Contrasenia = $filas[0]['Contrasenia'];
            }
            $this->conexion->Desconectar();
        } catch (PDOException $ex) {
            throw $ex;

        }
    }

    public function ObtieneUsuarios()
    {
        try {
            $this->conexion->Conectar();
            $filas = $this->conexion->EjecutarSelect("Select * from usuario");
            $this->conexion->Desconectar();
            return $filas;
        } catch (PDOException $ex) {
            throw $ex;

        }
    }
}