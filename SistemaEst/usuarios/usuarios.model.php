<?php
require_once("../conexion.php");
require_once("usuarios.entidad.php");
class UsuarioModel
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
	//---------------------------------------------------------------------- LISTAR USUARIOS -----------------------------------------------
    public function Listar()
    {
        try{
            $result=array();
            
            $stm=$this->pdo->prepare("SELECT * FROM Usuarios");
			
            $stm->execute();
            
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $user=new Usuario();
//                print_r($r);
                $user->set_idusuario($r->IdUsuario);
                $user->set_nombre($r->Nombre);
                $user->set_apellido($r->Apellido);
                $user->set_dni($r->Dni);
                $user->set_telefono($r->Telefono);
                $user->set_cargo($r->Cargo);
                $user->set_usuario ($r->Usuario);
				$user->set_clave($r->Clave);
                
                
                
				
                
                $result [] = $user;
            }
                return $result;
           }
                catch(Exception $e)
                {
                    die($e->getMessage());
                    
                }
                
                
                
                
      }

      //rowCount()!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	  public function Registrar(Usuario $data)
	 {
		try
		{
			$sql="INSERT INTO Usuarios (Nombre,Apellido,Dni,Telefono,Cargo,Usuario,Clave)
			VALUES (?,?,?,?,?,?,?)";
					   
				  
			$this->pdo->prepare($sql)
			
				 ->execute(
				 array(
                    $data->get_nombre(),
                    $data->get_apellido(),
                    $data->get_dni(),
                    $data->get_telefono(),
                    $data->get_cargo(),                 
				 	$data->get_usuario(),
					$data->get_clave()
					 )
				);
			   }catch (Exception $e)
			   {
				die($e->getMessage());
					   
			
		}
	 }
 //---------------------------------------------------------------------- LOGIN -----------------------------------------------
	 public function Login(Usuario $data)
	 {
		try
		{
			$sql = "SELECT Nombre, Apellido, IdUsuario FROM Usuarios WHERE Usuario=? AND Clave=?";
			$stm = $this->pdo->prepare($sql);

			$stm->execute(array($data->get_usuario(),$data->get_clave()));
            echo $stm->rowCount();
            if ($stm->rowCount()>0){
            
                echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaa";
           	    $r = $stm->fetch(PDO::FETCH_OBJ);
                /*$user=new Usuario();
			    $user->set_nombre($r->Nombre);
                $user->set_apellido($r->Apellido);
                $user->set_idusuario($r->IdUsuario);
                
				return $user;
                */
                session_start();
             
             $_SESSION['IdUsuario']=$r->IdUsuario;
             $_SESSION['Nombre']=$r->Nombre;
             $_SESSION['Apellido']=$r->Apellido; 
             $_SESSION['Time']=time();
             return 'true';
             
            }

            return 'false';
		}
		catch(Exception $e)
		{
			die($e->getMessage());
			
		}
	 }
	 
 	//---------------------------------------------------------------------- OBTENER USUARIO -----------------------------------------------
 public function Obtener($IdUsuario)
 {
    try
    {
        $stm = $this->pdo->prepare("SELECT * FROM Usuarios WHERE IdUsuario=?");
		
        $stm->execute(array($IdUsuario));
        
        $r = $stm->fetch(PDO::FETCH_OBJ);
     
                $user=new Usuario();
                
	   			$user->set_idusuario($r->IdUsuario);
                $user->set_nombre($r->Nombre);
                $user->set_apellido($r->Apellido);
                $user->set_dni($r->Dni);
                $user->set_telefono($r->Telefono);
                $user->set_cargo($r->Cargo);
                $user->set_usuario ($r->Usuario);
				$user->set_clave($r->Clave);
				
        return $user;
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }
 public function Eliminar ($IdUsuario)
 {
    try
    {
        $stm = $this->pdo->prepare("DELETE FROM Usuarios WHERE IdUsuario= ?");
        
        $stm->execute (array($IdUsuario));
        
    }
    catch(Exception $e)
    {
        die($e->getMessage());
        
    }
 }       
 public function Actualizar (Usuario $data)
 {
    try
    {
        $sql = "UPDATE usuarios SET      
                    Nombre       		=?,
                    Apellido            =?,
                    Dni                 =?,
                    Telefono            =?,
                    Cargo               =?,
                    Usuario             =?,
           		    Clave               =?
                 WHERE IdUsuario = ?";
                 
             $this->pdo->prepare($sql)
              -> execute(
              array(          
                $data->get_nombre(),
                $data->get_apellido(),
                $data->get_dni(),
                $data->get_telefono(),
                $data->get_cargo(),
                $data->get_usuario(),
                $data->get_clave(),
                $data->get_idusuario() 
                
                )
              );
            } catch (Exception $e)
            
            {
                die($e->getMessage());
            }  
                
              
    }
	
	 }   
	

 
?>