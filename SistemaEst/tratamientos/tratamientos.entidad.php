<?php

class Tratamiento
{
 private $IdTratamiento;
 private $Precio;
 private $Nombre;
 private $Limiteturnos;
 
 
 

     public function set_limiteturnos($valor)
     {
        $this->Limiteturnos=$valor;
     }
     
     public function get_limiteturnos()
     {
        return $this->Limiteturnos;
     }
    
     public function set_idtratamiento($valor)
     {
        $this->IdTratamiento=$valor;
     }
     public function get_idtratamiento(){
        return $this->IdTratamiento;
     }
     
     public function set_nombre($valor)
    {
        $this->Nombre=$valor;
    }
    public function set_precio($valor)
    {
        $this->Precio=$valor;
    }

    public function get_nombre()
    {
        return $this->Nombre;
    }
    public function get_precio()
    {
        return $this->Precio;
    }
    }
?>