<?php
session_start();
if ($_SESSION['Time']){
    if((time() - $_SESSION['Time'])>10){
        
        session_destroy();
        ?>
        <script type="text/javascript">
        top.location.href="usuarios/login.php"
        
        </script>
        <?php
    } else{
     $_SESSION['Time']=time();
     }
     }
      else {
           
    ?>
    <script type="text/javascript">
    top.location.href='usuarios/login.php'
    </script>
    <?php
}
if (!($_SESSION['IdUsuario'])){
    header('Location:usuarios/login.php');
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta name="author" content="alumno4" />
<meta name="generator" content="Bluefish 2.2.7" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="ES"/>
<meta name="copyright" content="Eugenia Mendez" />
<meta name="robots" content="index, follow" />
<meta name="keywords" content="vista para los usuarios de el contenido del centro de estetica" />
<meta name="description" content="Pagina estatica de centro de estetica" />
	<title></title>
	<link rel="stylesheet" type="text/css" href="Estilos/estilos.css" media="screen"/>
</head>
<body>
<h1> bienvenido
<?php
 echo $_SESSION['Nombre']." ".$_SESSION['Apellido']
?>
</h1>
<div id="contenedor">
<div id="encabezado">
</div>
<div id="menu">
<ul>
 <li><a href="">Inicio</a></li>
 <li><a href="clientes/clientes.php">Adm Clientes</a></li>
 <li><a href="empleados/empleados.php">Adm Empleados</a></li>
 <li><a href="turnos/turnos.php">Nuevo Turno</a></li>
 <li><a href="usuarios/usuarios.php">Adm Usuarios</a></li>
 <li><a href="tratamientos/tratamientos.php">Adm Tratamientos</a></li>
 <li><a href="extras.html">Extras</a>
 <ul>
  <li><a href="testimonios/testimonios.php">Testimonios</a></li>
  <li><a href="informe.php">Informe</a></li>

</ul>
</ul>
</div>



<div id="contenidoi">
<h1>Centro Integral de Belleza</h1>
<p>Nuestros capicitado personal, brindaran la mejor atencion para que tu dia en el centro de estetica sea unico e inigualable
</p>
<h2>Comienzos de nuestra profesion</h2>
<p>En 1983, comenzamos nuestra trayectoria  sin problemas.
</p>
<a href="logout.php">CERRAR SESION</a>
</div>
</div>
<div id="pie">
Eugenia 2/11/2016
</div>
</div>
</body>
</html>

