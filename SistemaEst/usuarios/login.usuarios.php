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
require_once 'usuarios.entidad.php';
require_once'usuarios.model.php';
$Usuario= new Usuario();
$UsuarioModel= new UsuarioModel();
    if(isset($_POST['login'])){
    
            
            $Usuario->set_usuario($_POST['Usuario']);
            $clave=md5($_POST['Clave']);
     echo $clave;
            $Usuario->set_clave($clave);
            
            $UsuarioModel->Login($Usuario);
            $ok= $UsuarioModel->Login($Usuario);
            if ($ok=='true'){
              header("Location: ../panel.php");
            }
            else {
               header("Location: login.php");
            }
            echo $ok;
    }
    

?>