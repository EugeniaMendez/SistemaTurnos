<?php

class Testimonio
{
 private $IdTestimonio;   
 private $comentario;
 
 public function get_idtestimonio()
 {
    return $this->IdTestimonio;
 }
 public function set_idtestimonio($valor)
 {
    $this->IdTestimonio=$valor;
 }
 
 public function set_comentario($valor)
 {
  $this->comentario=$valor;  
 }  
 public function get_comentario ()
 {
    return $this->comentario;
 }
}

?>