<?php
session_start();
if ($_SESSION['Time']){
    if((time() - $_SESSION['Time'])>300){
        
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
require_once 'testimonios.entidad.php';
require_once'testimonios.model.php';


$test = new Testimonio ();
$model= new TestimonioModel();

if(isset($_POST['action']))
{
    echo "------".$_POST['action'];
	switch($_POST['action'])
	{
		case "Registrar":
			$test -> set_comentario ($_POST["Comentario"]);
 

			$model->Registrar ($test);
			header ("Location: testimonios.php");
			break;
			
		case'Actualizar':
				$test->set_idtestimonio($_POST['IdTestimonio']);
				$test->set_comentario($_POST['Comentario']);
                echo $_POST['IdTestimonio']."----".$_POST['Comentario'];
				$model->Actualizar($test);
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
		<strong>Administracion de Testimonios</strong>
		<div class="pure-g">
		<div class="pure-u-1-12">
		
        <form action="testimonios.php" method="post" class="pure-form pure-form-stacked">
         
            
            <input type="hidden" name="action" value="<?php echo $test->get_idtestimonio() > 0 ? "Actualizar" : "Registrar";?>" />
            <input type="hidden" name="IdTestimonio" value="<?php if (isset($_POST['action'])) {echo $test->get_idtestimonio();}?>"/>
			<table border="1">
				<tr>
					<th>Comentario</th>
					<td><input type="text" name="Comentario" value="<?php echo $test->get_comentario();  ?>" required="llene el campo"/></td>
				</tr>
 
				
				<tr>
					<td colspan="2"><button type="submit" class="pure-button pure-button-primary">Guardar</button></td>
				</tr>
			</table>
		</form>


		<table class="pure-table pure-table-horizontal" border="1">
			<thead>
				<tr>
					<th>Comentario</th>
                    
    
					<th></th>
					<th></th>
				</tr>
			</thead>
			
				<?php foreach ($model->Listar() as $r):?>
					<tr>
						<td><?php echo $r->get_comentario();?></td>
      
      
						
						<td>
					
                        </td>
                        <td>
                        
                        </td>
                        
					</tr>
			     <?php endforeach;?>
				</table>
			</div>
		</div>
	</body>

</html>
