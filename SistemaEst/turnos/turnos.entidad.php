<?php

class Turno
{ 
    private $IdTurno;
    private $Fecha;
    private $Hora;
    private $Disponible;
    private $IdTratamiento;
    private $Nombre;
    private $IdCliente;
    
    
    public function get_idcliente()
    {
        return $this->IdCliente;
    }
    
    public function set_idcliente($valor)
    {
        $this->IdCliente=$valor;
        }
    
    public function get_nombre()
    {
        return $this->Nombre;
    }
    
    public function set_nombre($valor)
    {
        $this->Nombre=$valor;
    }
    
    public function get_idtratamiento()
    {
        return $this->IdTratamiento;
    }
    
    public function set_idtratamiento($valor)
    {
        $this->IdTratamiento=$valor;
    }
    
    public function get_disponible()
    {
        return $this->Disponible;
    }
    
    public function set_disponible($valor)
    {
        $this->Disponible=$valor;
    }

    
    public function get_idturno()
    {
        return $this->IdTurno;
    }
    
    public function set_idturno($valor)
    {
        $this->IdTurno=$valor;
    }
    

    public function set_fecha($valor)
    {
        $this->Fecha=$valor;
    }
    public function set_hora($valor)
    {
        $this->Hora=$valor;
    }
    
    public function get_fecha()
    {
        return $this->Fecha;
    }
    public function get_hora()
    {
        return $this->Hora;
    }
    
}



?>