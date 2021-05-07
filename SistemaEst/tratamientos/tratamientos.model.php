<?php
require_once("../conexion.php");
class TratamientoModel
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
	//---------------------------------------------------------------------- LISTAR Tratamientos-----------------------------------------------
    public function Listar()
    {
        try{
            $result=array();
            $stm=$this->pdo->prepare("SELECT * FROM Tratamientos");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $trat=new Tratamiento();
//                print_r($r);
                $trat->set_precio($r->Precio);
                $trat->set_nombre($r->Nombre);
                $trat->set_idtratamiento($r->IdTratamiento);
                $trat->set_limiteturnos($r->Limiteturnos);
                $result [] = $trat;
            }
            return $result;
            }
        catch(Exception $e)
        {
            die($e->getMessage());
        }            
      }
	  
	//---------------------------------------------------------------------- LISTAR Tratamientos Excluidos-----------------------------------------------
    public function ListarTratExcluidos()
    {
        try{
            $result=array();
            $stm=$this->pdo->prepare("SELECT * from tratamientos where IdTratamiento NOT IN (select IdTratamiento from temporal )");
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $trat=new Tratamiento();
//                print_r($r);
                $trat->set_precio($r->Precio);
                $trat->set_nombre($r->Nombre);
                $trat->set_idtratamiento($r->IdTratamiento);
                $trat->set_limiteturnos($r->Limiteturnos);
                $result [] = $trat;
            }
            return $result;
            }
        catch(Exception $e)
        {
            die($e->getMessage());
        }            
      }
	
	  public function Registrar(Tratamiento $data)
	 {
		try
		{
			$sql="INSERT INTO Tratamientos (Nombre,Precio,Limiteturnos)
			VALUES (?,?,?)";
					   
				  
			$this->pdo->prepare($sql)
			
				 ->execute(
				 array(
                    $data->get_nombre(),
                    $data->get_precio(),
                    $data->get_limiteturnos()
					 )
				);
			   }catch (Exception $e)
			   {
				die($e->getMessage());
					   
			
		}
	 }
 //---------------------------------------------------------------------- LOGIN -----------------------------------------------
	

	// ---------------------------------------------------------------------- OBTENER USUARIO -----------------------------------------------//
 public function Obtener($IdTratamiento)
 {
    try
    {
        $stm = $this->pdo->prepare("SELECT * FROM Tratamientos WHERE IdTratamiento=?");
		
        $stm->execute(array($IdTratamiento));
        
        $r = $stm->fetch(PDO::FETCH_OBJ);
  
                $trat=new Tratamiento();
//                print_r($r);
                
	   			$trat->set_precio($r->Precio);
                $trat->set_nombre($r->Nombre);
                $trat->set_idtratamiento($r->IdTratamiento);
                $trat->set_limiteturnos($r->Limiteturnos);
            
        return $trat;
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }
 public function Eliminar ($IdTratamiento)
 {
    try
    {
        $stm = $this->pdo->prepare("DELETE FROM tratamientos WHERE IdTratamiento= ?");
        
        $stm->execute (array($IdTratamiento));
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }       
 public function Actualizar (Tratamiento $data)
 {
    try
    {
        $sql = "UPDATE tratamientos SET      
                    Nombre       		=?,
                    Precio            =?,
                    Limiteturnos      =?
                  
                 WHERE IdTratamiento = ?";
                 
             $this->pdo->prepare($sql)
              -> execute(
              array(          
                $data->get_nombre(),
                $data->get_precio(),
                $data->get_limiteturnos(),
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