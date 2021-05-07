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
require_once 'clientes.entidad.php';
require_once'clientes.model.php';


$clien = new Cliente();
$model= new ClienteModel();

if(isset($_POST['action']))
{
    echo "------".$_POST['action'];
	switch($_POST['action'])
	{
		case "registrar":
			$clien -> set_nombre ($_POST["Nombre"]);
            $clien-> set_apellido ($_POST["Apellido"]);
            $clien-> set_telefono ($_POST["Telefono"]);
           

			$model->Registrar ($clien);
			header ("Location: clientes.php");
			break;
			
		case'actualizar':
				$clien->set_idcliente($_POST['IdCliente']);
				$clien->set_nombre($_POST['Nombre']);
                $clien->set_apellido($_POST['Apellido']);
                $clien->set_telefono($_POST['Telefono']);
				$model->Actualizar($clien);
				break;
				
		case'Eliminar':
		$model->Eliminar($_POST['IdCliente']);
				header('Location: clientes.php');
				break;
				
		case 'Editar':
			$clien = $model->Obtener($_POST['IdCliente']);
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
		<strong>Administracion de Clientes</strong>
		<div class="pure-g">
		<div class="pure-u-1-12">
		
        <form action="clientes.php" method="post" class="pure-form pure-form-stacked">
         
            
            <input type="hidden" name="action" value="<?php echo $clien->get_idcliente() > 0 ? "actualizar" : "registrar";?>" />
            <input type="hidden" name="IdCliente" value="<?php if (isset($_POST['action'])) {echo $clien->get_idcliente();}?>"/>
			<table border="1">
				<tr>
					<th>Nombre</th>
					<td><input type="text" name="Nombre" value="<?php echo $clien->get_nombre(); ?>" required="llene el campo" /></td>
				</tr>
                
                <tr>
					<th>Apellido</th>
					<td><input type="text" name="Apellido" value="<?php echo $clien->get_apellido(); ?>" required="llene el campo"/></td>
				</tr>
                
                <tr>
					<th>Telefono</th>
					<td><input type="text" name="Telefono" value="<?php echo $clien->get_telefono(); ?>" required="llene el campo"/></td>
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
    
					<th></th>
					<th></th>
				</tr>
			</thead>
			
				<?php foreach ($model->Listar() as $r):?>
					<tr>
						<td><?php echo $r->get_nombre();?></td>
                        <td><?php echo $r->get_apellido();?></td>
                        <td><?php echo $r->get_telefono();?></td>
      
						
						<td>
						
                              <form action="clientes.php" method="post">
                              <input type="hidden" name="IdCliente" value="<?php echo $r-> get_idcliente();?>"/>
                              <input type="hidden" name="action" value="Editar"/>
                              <input type="submit" value="Editar"/>
                              </form>
                        </td>
                        <td>
                        <form action="clientes.php" method="post" onsubmit="return confirm('Esta seguro de querer eliminar este registro?')">
                              <input type="hidden" name="IdCliente" value="<?php echo $r-> get_idcliente();?>"/>
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
