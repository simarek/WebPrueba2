<?php

if (isset($_POST)){

  // Conexion a la Base de Datos
  require_once 'includes/conexion.php';

  // Iniciar sesión
  session_start();

  //Recoger los valores del formulario de Freelancer
  $nroCuenta = isset ($_POST['nroCuenta']) ? $_POST['nroCuenta'] : false;
  $foto = isset ($_POST['foto']) ? $_POST['foto'] : false;
  $GradoEstudio = isset ($_POST['GradoEstudio']) ? $_POST['GradoEstudio'] : false;
  $AreaEstudio = isset ($_POST['AreaEstudio']) ? $_POST['AreaEstudio'] : false;
  $habilidades = isset ($_POST['habilidades']) ? $_POST['habilidades'] : false;
  $NivelExp = isset ($_POST['NivelExp']) ? $_POST['NivelExp'] : false;
  $Descripcion = isset ($_POST['Descripcion']) ? $_POST['Descripcion'] : false;
  $Tarifa = isset ($_POST['Tarifa']) ? $_POST['Tarifa'] : false;

  //Array de errores
  $errores = array();

  // datos ya se validaron en suscribe1.hmtl para introduccion a la BBDD

  $guardar_usuario = false;

  if(count($errores) == 0){
    $guardar_usuario = true;

    //INSERTAR FREELANCER EN LA TABLA freelancer DE LA BBDD platem
    $sql = "INSERT INTO freelancer VALUES(null, '$nroCuenta', '$foto', '$GradoEstudio', '$AreaEstudio', '$habilidades', '$NivelExp', '$Descripcion', '$Tarifa');";
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

header('Location: suscribe2.html');                            // luego de la introduccion de datos vuelve a suscribe.html




