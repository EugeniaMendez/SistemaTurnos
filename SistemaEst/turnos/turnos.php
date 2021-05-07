
<?php 
session_start();
if ($_SESSION['Time']){
    if((time() - $_SESSION['Time'])>300){
        
        session_destroy();
        ?>
        <script type="text/javascript">
        top.location.href="../usuarios/login.php"
        
        </script>
        <?php
    } else{
     $_SESSION['Time']=time();
     }
     }
      else {
           
    ?>
    <script type="text/javascript">
    top.location.href='../usuarios/login.php'
    </script>
    <?php
}
if (!($_SESSION['IdUsuario'])){
    header('Location:../usuarios/login.php');
}

?>
<?php

require_once 'turnos.entidad.php';
require_once'turnos.model.php';
require_once '../Tratamientos/tratamientos.entidad.php';
require_once'../Tratamientos/tratamientos.model.php';
require_once '../temporal/temporal.model.php';
require_once '../temporal/temporal.entidad.php';
require_once '../clientes/clientes.model.php';
require_once '../clientes/clientes.entidad.php';
require_once '../tratamientosxturnos/txt.entidad.php';

$tur = new Turno();
$model= new TurnoModel();
$trat= new Tratamiento();
$modeltemp=new TemporalModel();
$modeltrat=new TratamientoModel();
$temp= new Temporal();
$modelclien= new ClienteModel();
$clien= new Cliente();

session_start();
             if (!($_SESSION['IdUsuario']))
             {
                header('Location: login.usuarios.php');
             }

if(isset($_POST['action']))
{
    //echo "------".$_POST['action'];
	switch($_POST['action'])
	{
		
			
      	case "VerDisponibilidad":
            $fecha=$_POST['Fecha'];
            //echo $fecha."<br>";
            list($anio,$mes,$dia)=split('[/.-]',$fecha);
            //echo "AÑO=".$anio;
            $fecha=$anio."/".$mes."/".$dia;
            //echo "fecha=".$fecha."<br>";
            //echo "FECHA=".$_POST['Fecha'];
        break;
        case "RegTemp":
            $fecha=$_POST['Fecha'];
            list($anio,$mes,$dia)=split('[/.-]',$fecha);
            $fecha=$anio."/".$mes."/".$dia;
            $idtrat=$_POST['IdTratamiento'];
            $modeltemp->RegTemp($idtrat);
        
        break;
        case "Quitar":
        $fecha=$_POST['Fecha'];
            list($anio,$mes,$dia)=split('[/.-]',$fecha);
            $fecha=$anio."/".$mes."/".$dia;
            $Idtemporal=$_POST['IdTemporal'];
            $modeltemp->Quitar($Idtemporal);
        break;
        case "Listar":
            $nombre=$_POST['Nombre'];
            $modeltemp->Listar($nombre);

            //echo $_POST['Nombre'];
        break;
        case "Registrar":
			$tur ->set_fecha ($_POST["Fecha"]);
            $tur-> set_hora ($_POST["Hora"]);
            $tur->set_idcliente($_POST["IdCliente"]);
			$model->Registrar ($tur);
        
			header ("Location: turnos.php");
        break;
       
            
        
        }
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css" />
		</head>
		<body>
		<h2>Administracion de Turnos</h2>
		<div class="pure-g">
		<div class="pure-u-1-12">
		
        <form action="turnos.php" method="post" class="pure-form pure-form-stacked">
            <input type="hidden" name="action" value="VerDisponibilidad" />
			<label>Fecha</label>
   			<input type="date" name="Fecha" value=
<?php
               if(isset($_POST['Fecha'])){
                echo $_POST['Fecha'];
               }
              ?> />
            <button type="submit" class="pure-button pure-button-primary"> Ver disponibles</button>
       </form>
       
			</div>
		</div>
                  
              <table border="1">
                    <tr><td>Tratamientos cargados para la fecha</td> 
                    <td> <?php 
                    if(isset($_POST['action'])&& $_POST['action']=='VerDisponibilidad'){
                        
                        foreach ($model->VerDisponibilidad($fecha) as $r):
                        if($r->get_disponible()!=0){?></td></tr>
                       <tr>
                        <td>Tratamientos</td>
                        <td><?php echo $r->get_nombre(); ?></td>
                        </tr>
                                
              <?php
              }
              endforeach;
              
              
              } ?>  
              
              </tr>          
              
              </table></br>
              
              <form action="turnos.php" method="POST">
                <!--<input type="hidden" name="action" value="<?php //echo $tur->get_idturno()> 0 ? : "Registrar";?>" />
                <input type="hidden" name="IdTurno" value="<?php //if (isset($_POST['action'])) {echo $tur->get_idturno();}?>" />
                    -->    
                     Seleccione Tratamiento:<select name="IdTratamiento">
                       	<?php foreach ($modeltrat->ListarTratExcluidos() as $r):?>
                    
                   
                <option value="<?php echo $r->get_idtratamiento();?>"><?php echo $r->get_nombre(); ?></option>
                
                <?php endforeach;
                ?>
                </select>
                
                <input type="hidden" name="Fecha" value="<?php if(isset($_POST['Fecha'])){ echo $_POST['Fecha']; } ?>" />
                <input type="hidden" name="action" value="RegTemp" />
                <input type="submit"  value="Agregar" />
                </form>
                </br>
               <table border='1'>
                <thead><td>Usted selecciono el/los tratamiento/s...</td></thead>
                <tr>
                <td>Nombre Tratamiento</td>
                <td></td>
                </tr>
                <tr><?php foreach($modeltemp->Listar()as $r): ?>
 				<tr>
						<td><?php echo $r->get_nombre();?></td>
                        <td>
                        <form action="turnos.php" method="POST">
                        <input type="hidden" name="IdTemporal" value=<?php echo $r->get_idtemporal()?>/> 
                        <input type="hidden" name="Fecha" value="<?php if(isset($_POST['Fecha'])){ echo $_POST['Fecha']; } ?>" />
                        <input type="hidden" name="action" value="Quitar"/>
                        <input type="submit" value="Quitar"/>
                        </form>
                        </td>
                </tr>
      
                <?php endforeach ?>
                </table>
                
                </form>
                </br>
                    
                    
                    
                <br />
                <br />

                   
                     <form action="turnos.php" method="post">
                               Seleccione cliente:<select name="IdCliente">
                       	<?php foreach ($modelclien->Listar() as $r):?>
                    
                   
                <option value="<?php echo $r->get_idcliente();?>"><?php echo $r->get_nombre(); ?></option>
                s
                <?php endforeach;
                ?>
                </select>
                             
                              <input type="hidden" name="Fecha" value="<?php if(isset($_POST['Fecha'])){ echo $_POST['Fecha']; } ?>" />
                              <label>Hora</label>
                   
                              <input type="time" name="Hora" value="" /><br />
                     
                              <input type="hidden" name="action" value="Registrar"/>
                              <input type="submit" value="Registrar" />
                       </form>       
                              
                     
                     


                 
	</body>
</html>