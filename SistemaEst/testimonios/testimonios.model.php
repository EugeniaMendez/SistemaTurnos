<?php
require_once("../conexion.php");
class TestimonioModel
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
	//---------------------------------------------------------------------- LISTAR CLIENTES -----------------------------------------------
    public function Listar()
    {
        try{
            $result=array();
            
            $stm=$this->pdo->prepare("SELECT * FROM Testimonios");
			
            $stm->execute();
            
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $test=new Testimonio ();
//                print_r($r);
                $test->set_idtestimonio($r->IdTestimonio);
                $test->set_comentario($r->Comentario);
                
               
                
                
                
				
                
                $result [] = $test;
            }
                return $result;
           }
                catch(Exception $e)
                {
                    die($e->getMessage());
                    
                }
                
                
                
                
      }
	  
	
	  public function Registrar(Testimonio $data)
	 {
		try
		{
			$sql="INSERT INTO Testimonios (Comentario)
			VALUES (?)";
					   
				  
			$this->pdo->prepare($sql)
			
				 ->execute(
				 array(
                    $data->get_comentario(),
           
			 	
					 )
				);
			   }catch (Exception $e)
			   {
				die($e->getMessage());
					   
			
		}
	 }
 //---------------------------------------------------------------------- LOGIN -----------------------------------------------
	 public function Login(Testimonio $data)
	 {
		try
		{
			$sql = "SELECT Comentario FROM Testimonios WHERE IdTestimonio=?";
			$stm = $this->pdo->prepare($sql);

			$stm->execute(array($data->get_idtestimonio()));
			echo $data->get_comentario();
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$test= new Testimonio;
			$test->set_comentario($r['Comentario']);
			//$cantreg=mysql_num_rows();

				return $test;

		}
		catch(Exception $e)
		{
			die($e->getMessage());
			
		}
	 }
	 
 	//---------------------------------------------------------------------- OBTENER USUARIO -----------------------------------------------
 public function Obtener($IdTestimonio)
 {
    try
    {
        $stm = $this->pdo->prepare("SELECT * FROM Testimonios WHERE IdTestimonio=?");
		
        $stm->execute(array($IdTestimonio));
        
        $r = $stm->fetch(PDO::FETCH_OBJ);
       
                $test=new Testimonio();
//                print_r($r);
                
	   			$test->set_idtestimonio($r->IdTestimonio);
                $test->set_comentario($r->Comentario);
                
                
				
        return $test;
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }
 public function Eliminar ($IdTestimonio)
 {
    try
    {
        $stm = $this->pdo->prepare("DELETE FROM Testimonios WHERE IdTestimonio= ?");
        
        $stm->execute (array($IdTestimonio));
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }       
 public function Actualizar (Testimonio $data)
 {
    try
    {
        $sql = "UPDATE Testimonios SET      
                    Comentario      		=?
                    
                 WHERE IdTestimonio = ?";
                 
             $this->pdo->prepare($sql)
              -> execute(
              array(          
                $data->get_comentario(),
                $data->get_idtestimonio() 
                
                )
              );
            } catch (Exception $e)
            
            {
                die($e->getMessage());
            }  
                
              
    }
	
	 }   
	

 
?>