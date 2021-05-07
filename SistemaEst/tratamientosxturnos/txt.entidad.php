<?php

class tratamientoxturno
{
private $IdTratamientoxTurno;
private $IdTurno;
private $IdTratamiento;

 public function get_idtratamientoxturno()
    {
        return $this->IdTratamientoxTurno;
    }
    
    public function set_idtratamientoxturno($valor)
    {
        $this->IdTratamientoxTurno=$valor;
        }
 public function get_idtratamiento()
    {
        return $this->IdTratamiento;
    }
    public function set_idtratamiento($valor){
        $this->IdTratamiento=$valor;
    }
    
    public function get_idturno(){
        return $this->IdTurno;
    }
    public function set_idturno($valor)
    {
        $this->IdTurno=$valor;
        }
        
 
}
?>