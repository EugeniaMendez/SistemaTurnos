<?php
require_once("../conexion.php");
class EmpleadosModel
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
	//---------------------------------------------------------------------- LISTAR EMPLEADOS -----------------------------------------------
    public function Listar()
    {
        try{
            $result=array();
            
            $stm=$this->pdo->prepare("SELECT * FROM empleados");
			
            $stm->execute();
            
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $empl=new Empleado();
//                print_r($r);
                $empl->set_idempleado($r->IdEmpleado);
                $empl->set_nombre($r->Nombre);
                $empl->set_apellido($r->Apellido);
                $empl->set_telefono($r->Telefono);
                $empl->set_dni($r->Dni);
                $empl->set_especialidad($r->Especialidad);
                $empl->set_cuil($r->Cuil);
               
                
                
                
				
                
                $result [] = $empl;
            }
                return $result;
           }
                catch(Exception $e)
                {
                    die($e->getMessage());
                    
                }
                
                
                
                
      }
	  
	
	  public function Registrar(Empleado $data)
	 {
		try
		{
			$sql="INSERT INTO Empleados (Nombre,Apellido,Telefono,Dni,Especialidad,Cuil)
			VALUES (?,?,?,?,?,?)";
					   
				  
			$this->pdo->prepare($sql)
			
				 ->execute(
				 array(
                    $data->get_nombre(),
                    $data->get_apellido(),
                    $data->get_telefono(),
                    $data->get_dni(),
                    $data->get_especialidad(),
                    $data->get_cuil()
			 	
					 )
				);
			   }catch (Exception $e)
			   {
				die($e->getMessage());
					   
			
		}
	 }
 //---------------------------------------------------------------------- LOGIN -----------------------------------------------
	 public function Login(Empleado $data)
	 {
		try
		{
			$sql = "SELECT nombre FROM Empleados WHERE IdEmpleado=?";
			$stm = $this->pdo->prepare($sql);

			$stm->execute(array($data->get_idempleado()));
			echo $data->get_nombre();
			$r = $stm->fetch(PDO::FETCH_OBJ);
			$empl= new Empleado;
			$empl->set_nombre($r['Nombre']);
			//$cantreg=mysql_num_rows();

				return $empl;

		}
		catch(Exception $e)
		{
			die($e->getMessage());
			
		}
	 }
	 
 	//---------------------------------------------------------------------- OBTENER USUARIO -----------------------------------------------
 public function Obtener($IdEmpleado)
 {
    try
    {
        $stm = $this->pdo->prepare("SELECT * FROM Empleados WHERE IdEmpleado=?");
		
        $stm->execute(array($IdEmpleado));
        
        $r = $stm->fetch(PDO::FETCH_OBJ);
       
                $empl=new Empleado();
//                print_r($r);
                
	   			$empl->set_idempleado($r->IdEmpleado);
                $empl->set_nombre($r->Nombre);
                $empl->set_apellido($r->Apellido);
                $empl->set_telefono($r->Telefono);
                $empl->set_dni($r->Dni);
                $empl->set_especialidad($r->Especialidad);
                $empl->set_cuil($r->Cuil);
                
       
				
        return $empl;
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }
 public function Eliminar ($IdEmpleado)
 {
    try
    {
        $stm = $this->pdo->prepare("DELETE FROM Empleados WHERE IdEmpleado= ?");
        
        $stm->execute (array($IdEmpleado));
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }       
 public function Actualizar (Empleado $data)
 {
    try
    {
        $sql = "UPDATE empleados SET      
                    Nombre       		=?,
                    Apellido            =?,
                    Telefono            =?,
                    Dni            =?,
                    Especialidad            =?,
                    Cuil            =?
                 WHERE IdEmpleado = ?";
                 
             $this->pdo->prepare($sql)
              -> execute(
              array(          
                $data->get_nombre(),
                $data->get_apellido(),
                $data->get_telefono(),
                $data->get_dni(),
                $data->get_especialidad(),
                $data->get_cuil(),
                $data->get_idempleado()
                )
              );
            } catch (Exception $e)
            
            {
                die($e->getMessage());
            }  
                
              
    }
	
	 }   
	
?>