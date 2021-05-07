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
require_once 'tratamientos.entidad.php';
require_once'tratamientos.model.php';


$trat = new Tratamiento();
$modeltrat= new TratamientoModel();

if(isset($_POST['action']))
{
    echo "------".$_POST['action'];
	switch($_POST['action'])
	{
		case "Registrar":
			$trat -> set_nombre ($_POST["Nombre"]);
            $trat-> set_precio ($_POST["Precio"]);
            $trat->set_limiteturnos($_POST["Limiteturnos"]);

			$modeltrat->Registrar ($trat);
			header ("Location: tratamientos.php");
			break;
			
		case'Actualizar':
				$trat->set_precio($_POST['Precio']);
				$trat->set_nombre($_POST['Nombre']);
				$trat->set_idtratamiento($_POST['IdTratamiento']);
                $trat->set_limiteturnos($_POST['Limiteturnos']);
			
				
				$modeltrat->Actualizar($trat);
				//header('Location: tratamientos.php');
				break;
				
		case'Eliminar':
		$modeltrat->Eliminar($_POST['IdTratamiento']);
				header('Location: tratamientos.php');
				break;
				
		case 'Editar':
			$trat = $modeltrat->Obtener($_POST['IdTratamiento']);
			break;
	}
}
					
?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
		</head>
		<body>
		<strong>Administracion de Tratamientos</strong>
		<div class="pure-g">
		<div class="pure-u-1-12">
		
        <form action="tratamientos.php" method="post" class="pure-form pure-form-stacked">
         
            
            <input type="hidden" name="action" value="<?php echo $trat->get_idtratamiento() > 0 ? "Actualizar" : "Registrar";?>" />
            <input type="hidden" name="IdTratamiento" value=<?php if (isset($_POST['action'])) {echo $trat->get_idtratamiento();}?> />
			<table border="1">
				<tr>
					<th>Nombre</th>
					<td><input type="text" name="Nombre" value="<?php echo $trat->get_nombre(); ?>" required="llene el campo"/></td>
				</tr>
                
                <tr>
					<th>Precio</th>
					<td><input type="text" name="Precio" value="<?php echo $trat->get_precio(); ?>" required="llene el campo"/></td>
				</tr>
                <tr>
					<th>Limite Turnos</th>
					<td><input type="text" name="Limiteturnos" value="<?php echo $trat->get_limiteturnos(); ?>" required="llene el campo"/></td>
				</tr>
              
				<tr>
					<td colspan="2"><button type="submit" class="pure-button pure-button-primary">Guardar</button></td>
				</tr>
			</table>
		</form>


		<table class="pure-table pure-table-horizontal" border="1">
			<thead>
				<tr>
					<th>Nombre</th>
                    <th>Precio</th>
                    <th>Limite turnos</th>
  
					<th></th>
					<th></th>
				</tr>
			</thead>
			
				<?php foreach ($modeltrat->Listar() as $r):?>
					<tr>
						<td><?php echo $r->get_nombre();?></td>
                        <td><?php echo $r->get_precio();?></td>
                        <td><?php echo $r->get_limiteturnos();?> </td>
                      
						
						<td>
						
                              <form action="tratamientos.php" method="post">
                              <input type="hidden" name="IdTratamiento" value="<?php echo $r-> get_idtratamiento();?>"/>
                              <input type="hidden" name="action" value="Editar"/>
                              <input type="submit" value="Editar"/>
                              </form>
                        </td>
                        <td>
                        <form action="tratamientos.php" method="post" onsubmit="return confirm('Esta seguro de querer eliminar este registro?')">
                              <input type="hidden" name="IdTratamiento" value="<?php echo $r-> get_idtratamiento();?>"/>
                              <input type="hidden" name="action" value="Eliminar"/>
                              <input type="submit" value="Eliminar"/>
                              </form>
                        </td>
                        
					</tr>
			     <?php endforeach;?>
				</table>
			</div>
		</div>
	</body>

</html>
