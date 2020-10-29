<?php

if (isset($_POST)){

  // Conexion a la Base de Datos
  require_once 'includes/conexion.php';

  // Iniciar sesión
  session_start();

  //Recoger los valores del formulario de Profesional

  $Profesion = isset ($_POST['Profesion']) ? $_POST['Profesion'] : false;
  $Titulo = isset ($_POST['Titulo']) ? $_POST['Titulo'] : false;

  //Array de errores
  $errores = array();

  // datos ya se validaron en suscribe2.hmtl para introduccion a la BBDD

  $guardar_usuario = false;

  if(count($errores) == 0){
    $guardar_usuario = true;

    //INSERTAR FREELANCER EN LA TABLA freelancer DE LA BBDD platem
    $sql = "INSERT INTO profesional VALUES(null, '$Profesion', '$Titulo');";
    $guardar = mysqli_query($db, $sql);

    //var_dump(mysqli_error($db));                                      // mostrar errores en la consulta sql
    //die();

    if($guardar){

      $_SESSION['completado'] = "El registro se ha completado con éxito";
    }else{
      $_SESSION['errores'] ['general'] = "Fallo al guardar el usuario!!";
    }

  }else{
    $_SESSION['errores'] = $errores;
    
  }
  //var_dump($errores);
  //var_dump($_POST);                                                //sirve para ver los datos que se estanenviando desde el formulario    
}

/*
var_dump($_POST); 
echo "mensaje de correcto";
die;
*/

header('Location: suscribe.html');                            // luego de la introduccion de datos vuelve a suscribe.html




