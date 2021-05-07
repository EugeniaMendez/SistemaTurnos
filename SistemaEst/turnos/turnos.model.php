<?php
require_once("../conexion.php");
class TurnoModel
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
                
     
     public function Listar()
    {
        try{
            $result=array();
            
            $stm=$this->pdo->prepare("SELECT * FROM Turnos");
			
            $stm->execute();
            
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $tur=new Turno();
//                print_r($r);
                $tur->set_nombre($r->Nombre);
                $tur->set_idturno($r->IdTurno);
                $tur->set_fecha($r->Fecha);
                
                
                
                $result [] = $tur;
            }
                return $result;
           }
                catch(Exception $e)
                {
                    die($e->getMessage());
                
                }
                }
                
                
    public function VerDisponibilidad($Fecha)
    
    {
        try{
            $result=array();
            
            $stm=$this->pdo->prepare("SELECT 
	tratamientos.IdTratamiento, tratamientos.Nombre, 
    (tratamientos.Limiteturnos - COUNT(*)) as Disponible
FROM turnos 
	INNER JOIN tratamientosxturnos ON  tratamientosxturnos.IdTurno = turnos.IdTurno
	INNER JOIN tratamientos ON tratamientosxturnos.IdTratamiento = tratamientos.IdTratamiento
WHERE 
	turnos.Fecha = ?
GROUP BY
	tratamientos.Nombre");
			
            $stm->execute(array($Fecha));
            $cant=0;
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
//  if($r->Disponible!=0){
                $cant=$cant+1;
            
                $tur = new Turno();
                $tur->set_idtratamiento($r->IdTratamiento);
                $tur->set_nombre($r->Nombre);
                $tur->set_disponible($r->Disponible);
                
                $result [] = $tur;
            }
                echo $cant;
              return $result;
           }
                catch(Exception $e)
                {
                    die($e->getMessage());
                    
                }
                }

	
	  public function Registrar(Turno $data)
	 {
		try
		{
			$sql="INSERT INTO Turnos (Fecha,Hora,IdCliente)
			VALUES (?,?,?)";
					   
				  
			$this->pdo->prepare($sql)
			
				 ->execute(
				 array(
                    $data->get_fecha(),
                    $data->get_hora(),
                    $data->get_idcliente()
					 )
				);
			
		
//-----------------------------------obtener id_turno recien grabado-----------
        	$stm=$this->pdo->prepare("SELECT max(IdTurno)as IdTurno FROM Turnos");
			
            $stm->execute();
            $r = $stm->fetch(PDO::FETCH_OBJ);
            $idtur=$r->IdTurno;
            
		
        //--------------------TRAER TRAT DE LA TEMP---------------------------
        
			$stm=$this->pdo->prepare("SELECT IdTratamiento FROM temporal");
			
            $stm->execute();
            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r)
            {
                $idtrat=$r->IdTratamiento;
			     $sql="INSERT INTO tratamientosxturnos (IdTurno,IdTratamiento)
			     VALUES (?,?)";
					   
				  
			     $this->pdo->prepare($sql)
			
				 ->execute(array($idtur,$idtrat));
            }      
  	     }
         catch (Exception $e){
			 die($e->getMessage());
            }
        

    }
    
}

?>				