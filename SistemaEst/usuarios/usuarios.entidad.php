<?php

class Usuario
{
 private $IdUsuario;
 private $Nombre;
 private $Apellido;
 private $Dni;
 private $Telefono;
 private $Cargo;
 private $Usuario;
 private $Clave;
 
     public function set_idusuario($valor)
     {
        $this->IdUsuario=$valor;
     }
     
     
     public function set_nombre($valor)
    {
        $this->Nombre=$valor;
    }
    public function set_apellido($valor)
    {
        $this->Apellido=$valor;
    }
    public function set_telefono($valor)
    {
        $this->Telefono=$valor;
    }        
    public function set_usuario($valor)
    {
        $this->Usuario=$valor;
    }
    public function set_dni($valor)
    {
       $this->Dni=$valor; 
    }
    public function set_cargo ($valor)
    {
        $this->Cargo=$valor;
    }
    public function set_clave($valor)
    {
        $this->Clave=$valor;
    }
    
    public function get_idusuario()
    {
        return $this->IdUsuario;
    }
    public function get_nombre()
    {
        return $this->Nombre;
    }
    public function get_apellido()
    {
        return $this->Apellido;
    }
    public function get_telefono()
    {
        return $this->Telefono;
    }
    public function get_usuario()
    {
        return $this->Usuario;
    }
    public function get_dni()
    {
        return $this->Dni;
    }
    public function get_cargo()
    {
        return $this->Cargo;
    }
    public function get_clave()
    {
        return $this->Clave;
    }
}
?>