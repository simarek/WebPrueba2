<?php
 // Iniciar la sesion y la concexion a la BD
 require_once 'includes/conexion.php';

 // Recoger datos del formulario
if (isset($_POST)){
  $Email = trim($_POST['nombresUsr']);
  $contraseña = $_POST['passwordUsr'];

  //Consulta para comprobar las credenciales del usuario
  $sql = "SELECT * FROM usuario WHERE Email  = '$Email'";
  $login = mysqli_query($db, $sql);

  if($login && mysqli_num_rows($login) == 1){
    $usuario = mysqli_fetch_assoc($login);
    var_dump($usuario);
    die();
    
    //Comprobar la contraseña / cifrar
    $password_segura = password_hash($contraseña, PASSWORD_BCRYPT, ['cost'=> 4]);
    var_dump($password_segura);
    die();
  }else{
    //mensaje de error
  }
      // mesaje de prueba del gti hub ********
  
}
 

 

 //Utilizar una sesion para guardar los datos del usuario logueado

 // Si algo falla enviar una sesion con el fallo 

 //Redigir al index.php