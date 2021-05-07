<?php

class Empleado
{
    private $IdEmpleado;
    private $Nombre;
    private $Apellido;
    private $Telefono;
    private $Dni;
    private $Especialidad;
    private $Cuil;
   
    
  
    public function set_idempleado($valor)
    {
        $this->IdEmpleado=$valor;
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
        $this->Telefono=($valor);
    }
public function set_dni($valor)
    {
        $this->Dni=$valor;
    }
public function set_especialidad($valor)
    {
        $this->Especialidad=$valor;
    }
public function set_cuil($valor)
    {
        $this->Cuil=$valor;
    }

public function get_idempleado()
    {
        return $this->IdEmpleado;
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
public function get_dni()
    {
        return $this->Dni;
    }
 public function get_especialidad()
     {
        return $this->Especialidad;
     }   
public function get_cuil()
    {
        return $this->Cuil;
     }

 }
?>