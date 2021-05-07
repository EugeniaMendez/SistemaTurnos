<?php
require_once ("../conexion.php");
class ClienteModel
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
            
            $stm=$this->pdo->prepare("SELECT * FROM Clientes");
			
            $stm->execute();
            
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $clien=new Cliente();
//                print_r($r);
                $clien->set_idcliente($r->IdCliente);
                $clien->set_nombre($r->Nombre);
                $clien->set_apellido($r->Apellido);
                $clien->set_telefono($r->Telefono);
               
                
                
                
				
                
                $result [] = $clien;
            }
                return $result;
           }
                catch(Exception $e)
                {
                    die($e->getMessage());
                    
                }
                
                
                
                
      }
	  
	
	  public function Registrar(Cliente $data)
	 {
		try
		{
			$sql="INSERT INTO Clientes (Nombre,Apellido,Telefono)
			VALUES (?,?,?)";
					   
				  
			$this->pdo->prepare($sql)
			
				 ->execute(
				 array(
                    $data->get_nombre(),
                    $data->get_apellido(),
                    $data->get_telefono()        
			 	
					 )
				);
			   }catch (Exception $e)
			   {
				die($e->getMessage());
					   
			
		}
	 }
 //---------------------------------------------------------------------- LOGIN -----------------------------------------------
	 public function Login(Clientes $data)
	 {
		try
		{
			$sql = "SELECT nombre FROM Clientes WHERE IdCliente=?";
			$stm = $this->pdo->prepare($sql);

			$stm->execute(array($data->get_idcliente()));
			echo $data->get_nombre();
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$clien= new Cliente;
			$clien->set_nombre($r['Nombre']);
			//$cantreg=mysql_num_rows();

				return $clien;

		}
		catch(Exception $e)
		{
			die($e->getMessage());
			
		}
	 }
	 
 	//---------------------------------------------------------------------- OBTENER USUARIO -----------------------------------------------
 public function Obtener($IdCliente)
 {
    try
    {
        $stm = $this->pdo->prepare("SELECT * FROM Clientes WHERE IdCliente=?");
		
        $stm->execute(array($IdCliente));
        
        $r = $stm->fetch(PDO::FETCH_OBJ);
       
                $clien=new Cliente();
//                print_r($r);
                
	   			$clien->set_idcliente($r->IdCliente);
                $clien->set_nombre($r->Nombre);
                $clien->set_apellido($r->Apellido);
                $clien->set_telefono($r->Telefono);
                
				
        return $clien;
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }
 public function Eliminar ($IdCliente)
 {
    try
    {
        $stm = $this->pdo->prepare("DELETE FROM Clientes WHERE IdCliente= ?");
        
        $stm->execute (array($IdCliente));
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }       
 public function Actualizar (Cliente $data)
 {
    try
    {
        $sql = "UPDATE clientes SET      
                    Nombre       		=?,
                    Apellido            =?,
                    Telefono            =?
                 WHERE IdCliente = ?";
                 
             $this->pdo->prepare($sql)
              -> execute(
              array(          
                $data->get_nombre(),
                $data->get_apellido(),
                $data->get_telefono(),
                $data->get_idcliente() 
                
                )
              );
            } catch (Exception $e)
            
            {
                die($e->getMessage());
            }  
                
              
    }
	
	 }   
	

 
?>