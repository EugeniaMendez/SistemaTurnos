<?php



if(isset($_POST['action']))
{

	switch($_POST['action'])
	{
		
			
      	case "informe":
            $fecha=$_POST['Fecha'];
       
            list($anio,$mes,$dia)=split('[/.-]',$fecha);
            $fecha=$anio."/".$mes."/".$dia;
       



?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Anexsoft</title>
		<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css" />
		</head>
		<body>
		<h2>INFORME</h2>
		<div class="pure-g">
		<div class="pure-u-1-12">
<form action="informes.php">
<h2>cnvxc,.b,.xv</h2>
<input type="date" name="Fecha" value=

               if(isset($_POST['Fecha'])){
                echo $_POST['Fecha'];
               }/>
               

</form>    
</body>      
</html>     
