<?php
class Temporal
{
private $IdTemporal;
private $IdTratamiento;
private $Nombre;

public function get_nombre()
    {
        return $this->Nombre;
    }
    

  public function get_idtemporal()
    {
        return $this->IdTemporal;
    }
    
    public function get_idtratamiento()
    {
        return $this->IdTratamiento;
    }
    
     
    
    public function set_idtemporal($valor)
    {
        $this->IdTemporal=$valor;
    }
    public function set_idtratamiento($valor)
    {
        $this->IdTratamiento=$valor;
    }
    
    public function set_nombre($valor)
    {
        
        $this->Nombre=$valor;
    }
   
}
?>