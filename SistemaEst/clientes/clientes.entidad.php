<?php

class Cliente
{
 private $IdCliente;
 private $Nombre;
 private $Apellido;
 private $Telefono;
 
     public function set_idcliente($valor)
     {
        $this->IdCliente=$valor;
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
    
    public function get_idcliente()
    {
        return $this->IdCliente;
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
 
  
}
?>