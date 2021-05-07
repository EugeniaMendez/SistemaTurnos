<?php
require_once("../conexion.php");
require_once("temporal.entidad.php");
require_once '../Tratamientos/tratamientos.entidad.php';
require_once'../Tratamientos/tratamientos.model.php';
class TemporalModel
{
	//atributos
	//private $con ;
	private $pdo;
	
	//metodos
	
	public function __construct()
	{
	$con = new conexion();// instancia de clase conexion
	$this->pdo = $con->getConexion(); //guardo en pdo la conexion
	}
	//---------------------------------------------------------------------- LISTAR TEMPOAL -----------------------------------------------
    public function Listar()
    {
        try{
            $result=array();
            
            $stm=$this->pdo->prepare("SELECT Tratamientos.Nombre, Temporal.IdTemporal
         FROM Temporal INNER JOIN Tratamientos ON Temporal.IdTratamiento = Tratamientos.IdTratamiento");
			
            $stm->execute(array());
            
            
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $temp=new Temporal();
//                print_r($r);
                $temp->set_nombre($r->Nombre);
                $temp->set_idtemporal($r->IdTemporal);
                
                
                
                $result [] = $temp;
            }
                return $result;
           }
                catch(Exception $e)
                {
                    die($e->getMessage());
                    
                }
                
                
                
                
      }
	  
	
	  public function RegTemp($idtrat)
	 {
		try
		{
			//$sql="
           $sql="INSERT into Temporal (IdTratamiento) VALUES (?)";
					   
				  
			$this->pdo->prepare($sql)
			
				 ->execute(
				 array(
                    $idtrat
                    )
				);
			   }catch (Exception $e)
			   {
				die($e->getMessage());
					   
			
		}
	 }
 //---------------------------------------------------------------------- LOGIN -----------------------------------------------
	

	// ---------------------------------------------------------------------- OBTENER USUARIO -----------------------------------------------//
 public function Obtener($Idtmporal)
 {
    try
    {
        $stm = $this->pdo->prepare("SELECT * FROM Temporal WHERE IdTemporal=?");
		
        $stm->execute(array($Idtemporal));
        
        $r = $stm->fetch(PDO::FETCH_OBJ);
  
                $temp=new Temporal();
//                print_r($r);
                
                $temp->set_idtemporal($r->Idtemporal);
            
        return $temp;
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }
 public function Quitar ($IdTemporal)
 {
    try
    {
        $stm = $this->pdo->prepare("DELETE FROM temporal WHERE IdTemporal= ? ");
        
        $stm->execute (array($IdTemporal));
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }       
 public function Actualizar (Temporal $data)
 {
    try
    {
        $sql = "UPDATE temporal SET      
                  
                 WHERE IdTemporal = ?";
                 
             $this->pdo->prepare($sql)
              -> execute(
              array(          
                $data->get_idtratamiento()
                
        
                )
              );
            } catch (Exception $e)
            
            {
                die($e->getMessage());
            }  
                
              
    }
	
	 }   
	

 
?>