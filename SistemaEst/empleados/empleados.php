<?php
session_start();
if ($_SESSION['Time']){
    if((time() - $_SESSION['Time'])>10){
        
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
require_once 'empleados.entidad.php';
require_once'empleados.model.php';


$empl = new Empleado();
$model= new EmpleadosModel();

if(isset($_POST['action']))
{
    echo "------".$_POST['action'];
	switch($_POST['action'])
	{
		case "Registrar":
			$empl -> set_nombre ($_POST["Nombre"]);
            $empl-> set_apellido ($_POST["Apellido"]);
            $empl-> set_telefono ($_POST["Telefono"]);
            $empl-> set_dni ($_POST["Dni"]);
            $empl-> set_especialidad ($_POST["Especialidad"]);
            $empl-> set_cuil ($_POST["Cuil"]);

			$model->Registrar ($empl);
			header ("Location: empleados.php");
			break;
			
		case'Actualizar':
				$empl->set_idempleado($_POST['IdEmpleado']);
				$empl->set_nombre($_POST['Nombre']);
                $empl->set_apellido($_POST['Apellido']);
                $empl->set_telefono($_POST['Telefono']);
                $empl->set_dni($_POST['Dni']);
                $empl->set_especialidad($_POST['Especialidad']);
                $empl->set_cuil($_POST['Cuil']);
                
				$model->Actualizar($empl);
				break;
				
		case'Eliminar':
		$model->Eliminar($_POST['IdEmpleado']);
				header('Location: empleados.php');
				break;
				
		case 'Editar':
			$empl= $model->Obtener($_POST['IdEmpleado']);
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
		<strong>Administracion de Empleados</strong>
		<div class="pure-g">
		<div class="pure-u-1-12">
		
        <form action="empleados.php" method="post" class="pure-form pure-form-stacked">
         
            
            <input type="hidden" name="action" value="<?php echo $empl->get_idempleado() > 0 ? "Actualizar" : "Registrar";?>" />
            <input type="hidden" name="IdEmpleado" value="<?php if (isset($_POST['action'])) {echo $empl->get_idempleado();}?>"/>
			<table border="1">
				<tr>
					<th>Nombre</th>
					<td><input type="text" name="Nombre" value="<?php echo $empl->get_nombre(); ?>" required="llene el campo"/></td>
				</tr>
                
                <tr>
					<th>Apellido</th>
					<td><input type="text" name="Apellido" value="<?php echo $empl->get_apellido(); ?>" required="llene el campo"/></td>
				</tr>
                
                <tr>
					<th>Telefono</th>
					<td><input type="text" name="Telefono" value="<?php echo $empl->get_telefono(); ?>" required="llene el campo"/></td>
				</tr>
				 <tr>
					<th>Dni</th>
					<td><input type="text" name="Dni" value="<?php echo $empl->get_dni();?>" required="llene el campo"/></td>
				</tr>
				 <tr>
					<th>Especialidad</th>
					<td><input type="text" name="Especialidad" value="<?php echo $empl->get_especialidad(); ?>" required="llene el campo"/></td>
				</tr>
				 <tr>
					<th>Cuil</th>
					<td><input type="text" name="Cuil" value="<?php echo $empl->get_cuil(); ?>" required="llene el campo"/></td>
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
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>dni</th>
                    <th>Especialidad</th>
                    <th>Cuil</th>
    
					<th></th>
					<th></th>
				</tr>
			</thead>
			
				<?php foreach ($model->Listar() as $r):?>
					<tr>
						<td><?php echo $r->get_nombre();?></td>
                        <td><?php echo $r->get_apellido();?></td>
                        <td><?php echo $r->get_telefono();?></td>
                        <td><?php echo $r->get_dni();?></td>
                        <td><?php echo $r->get_especialidad();?></td>
                        <td><?php echo $r->get_cuil();?></td>
      
						
						<td>
						
                              <form action="empleados.php" method="post">
                              <input type="hidden" name="IdEmpleado" value="<?php echo $r-> get_idempleado();?>"/>
                              <input type="hidden" name="action" value="Editar"/>
                              <input type="submit" value="Editar"/>
                              </form>
                        </td>
                        <td>
                        <form action="empleados.php" method="post" onsubmit="return confirm('Esta seguro de querer eliminar este registro?')">
                              <input type="hidden" name="IdEmpleado" value="<?php echo $r-> get_idempleado();?>"/>
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