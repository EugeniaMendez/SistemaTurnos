<?php
session_start();
if ($_SESSION['Time']){
    if((time() - $_SESSION['Time'])>10){
        
        session_destroy();
        ?>
        <script type="text/javascript">
        top.location.href="login.php"
        
        </script>
        <?php
    } else{
     $_SESSION['Time']=time();
     }
     }
      else {
           
    ?>
    <script type="text/javascript">
    top.location.href='login.php'
    </script>
    <?php
}
if (!($_SESSION['IdUsuario'])){
    header('Location: login.php');
}

?>
<?php
require_once 'usuarios.entidad.php';
require_once'usuarios.model.php';


$usu = new Usuario();
$model= new UsuarioModel();

if(isset($_POST['action']))
{
    echo "------".$_POST['action'];
	switch($_POST['action'])
	{
		case "registrar":
			$usu -> set_nombre ($_POST["Nombre"]);
            $usu-> set_apellido ($_POST["Apellido"]);
            $usu-> set_dni ($_POST["Dni"]);
            $usu-> set_telefono ($_POST["Telefono"]);
            $usu-> set_cargo ($_POST["Cargo"]);
            $usu -> set_usuario ($_POST["Usuario"]);
            $clave=md5($_POST['Clave']);
			$usu -> set_clave ($clave);

			$model->Registrar ($usu);
			header ("Location: usuarios.php");
			break;
            
		case 'Login':
        $usu->set_nombre($_POST['Nombre']);
        $clave=md5($_POST['Clave']);
        $usu->set_clave($clave);
        $model->login($usu);
        header ('Location: "login.usuarios.php"');
       	break;
		case'actualizar':
				$usu->set_idusuario($_POST['IdUsuario']);
				$usu->set_nombre($_POST['Nombre']);
                $usu->set_apellido($_POST['Apellido']);
                $usu->set_dni($_POST['Dni']);
                $usu->set_telefono($_POST['Telefono']);
                $usu->set_cargo($_POST['Cargo']);
                $usu->set_usuario($_POST['Usuario']);
                $clave=md5($_POST['Clave']);
				$usu->set_clave($clave);
			
				
				$model->Actualizar($usu);
				header('Location: usuarios.php');
				break;
				
		case'eliminar':
		$model->Eliminar($_POST['IdUsuario']);
				header('Location: usuarios.php');
				break;
				
		case 'editar':
			$usu = $model->Obtener($_POST['IdUsuario']);
			break;
	}
}
					
?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css"/>
		</head>
		<body>
		<strong>Administracion de Usuarios</strong>
		<div class="pure-g">
		<div class="pure-u-1-12">
		
        <form action="usuarios.php" method="post" class="pure-form pure-form-stacked">
         
            
            <input type="hidden" name="action" value="<?php echo $usu->get_idusuario() > 0 ? "actualizar" : "registrar";?>" />
            <input type="hidden" name="IdUsuario" value="<?php if (isset($_POST['action'])) {echo $usu->get_idusuario();}?>"/>
			<table border="1">
				<tr>
					<th>Nombre</th>
					<td><input type="text" name="Nombre" value="<?php echo $usu->get_nombre(); ?>" required="llene el campo"/></td>
				</tr>
                
                <tr>
					<th>Apellido</th>
					<td><input type="text" name="Apellido" value="<?php echo $usu->get_apellido(); ?>"  required="llene el campo"/></td>
				</tr>
                
                <tr>
					<th>Dni</th>
					<td><input type="text" name="Dni" value="<?php echo $usu->get_dni(); ?>"  required="llene el campo" /></td>
				</tr>
                
                <tr>
					<th>Telefono</th>
					<td><input type="text" name="Telefono" value="<?php echo $usu->get_telefono(); ?>"  required="llene el campo" /></td>
				</tr>
                
                <tr>
					<th>Cargo</th>
					<td><input type="text" name="Cargo" value="<?php echo $usu->get_cargo(); ?>"  required="llene el campo"/></td>
				</tr>
				<tr>
					<th>Usuario</th>
					<td><input type="text" name="Usuario" value="<?php echo $usu->get_usuario(); ?>" required="llene el campo" /></td>
				</tr>
				<tr>
					<th>Clave</th>
					<td><input type="password" name="Clave" value=""  required="llene el campo"/></td>
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
                    <th>Dni</th>
                    <th>Telefono</th>
                    <th>Cargo</th>
                    <th>Usuario</th>
					<th>Clave</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			
				<?php foreach ($model->Listar() as $r):?>
					<tr>
						<td><?php echo $r->get_nombre();?></td>
                        <td><?php echo $r->get_apellido();?></td>
                        <td><?php echo $r->get_dni();?></td>
                        <td><?php echo $r->get_telefono();?></td>
                        <td><?php echo $r->get_cargo();?></td>
                        <td><?php echo $r->get_usuario();?></td>
						<td><?php echo $r->get_clave();?></td>
						
						<td>
						
                              <form action="usuarios.php" method="post" >
                              <input type="hidden" name="IdUsuario" value="<?php echo $r-> get_idusuario();?>"/>
                              <input type="hidden" name="action" value="editar"/>
                              <input type="submit" value="Editar"/>
                              </form>
                        </td>
                        <td>
                        <form action="usuarios.php" method="post" onsubmit="return confirm('Esta seguro de querer eliminar este registro?');">
                              <input type="hidden" name="IdUsuario" value="<?php echo $r-> get_idusuario();?>"/>
                              <input type="hidden" name="action" value="eliminar"/>
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
