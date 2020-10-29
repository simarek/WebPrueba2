<?php

if (isset($_POST)){

  // Conexion a la Base de Datos
  require_once 'includes/conexion.php';

  // Iniciar sesión
  session_start();

  //Recoger los valores del formulario de Usuario

// revisar video 199.Login e identificacion de usuarios minuto 3:23 hay instruccion: "mysqli_real_escape_string()" ---------------------

  $Nombres = isset ($_POST['Nombres']) ? $_POST['Nombres'] : false;
  $PaternoUsr = isset ($_POST['PaternoUsr']) ? $_POST['PaternoUsr'] : false;
  $MaternoUsr = isset ($_POST['MaternoUsr'])? $_POST['MaternoUsr'] : false;
  $Celular = isset ($_POST['Celular']) ? $_POST['Celular'] : false;
  $ci = isset ($_POST['ci']) ? $_POST['ci'] : false;
  $Email = isset ($_POST['Email']) ? trim($_POST['Email']) : false;
  $contraseña = isset ($_POST['contraseña']) ? $_POST['contraseña'] : false;
  $AreaEstudio = isset ($_POST['AreaEstudio']) ? $_POST['AreaEstudio'] : false;
  $Descripcion = isset ($_POST['Descripcion']) ? $_POST['Descripcion'] : false;
  $Ubicacion = isset ($_POST['Ubicacion']) ? $_POST['Ubicacion'] : false;

  //Array de errores
  $errores = array();

  //Validar los datos antes de guaradrlos en la BBDD
  //Validar campo Nombres
  if(!empty($Nombres) && !is_numeric($Nombres) && !preg_match("/[0-9]/", $Nombres)){
    $nombre_validado = true;
  }else{
    $nombre_validado = false;
    $errores['Nombres'] = "el nombre no es valido";
  }

  //Validar campo Apellido Paterno
  if(!is_numeric($PaternoUsr) && !preg_match("/[0-9]/", $PaternoUsr)){
    $paterno_validado = true;
  }else{
    $paterno_validado = false;
    $errores['PaternoUsr'] = "el Aplellido Paterno no es valido";
  }

  //Validar campo Apellido Materno
  if(!empty($MaternoUsr) && !is_numeric($MaternoUsr) && !preg_match("/[0-9]/", $MaternoUsr)){
    $materno_validado = true;
  }else{
    $materno_validado = false;
    $errores['MaternoUsr'] = "el Aplellido Materno no es valido";
  }

  //Validar campo celular                                    *************** $Celular es campo tipo texto 
  if(!empty($Celular) && !is_int($Celular) && preg_match("/[0-9]/", $Celular)){
    $celular_validado = true;
  }else{
    $celular_validado = false;
    $errores['Celular'] = "el Numero no es valido";
  }

  //Validar campo c.i.                                         ********** falta controlar numero de digitos
  if(!empty($ci)){
    $celular_validado = true;
  }else{
    $celular_validado = false;
    $errores['Celular'] = "el Numero no es valido";
  }

  //Validar campo E-mail
  if(!empty($Email) && filter_var($Email, FILTER_VALIDATE_EMAIL)){
    $email_validado = true;
  }else{
    $email_validado = false;
    $errores['Email'] = "El correo electronico no es valido";
  }

  //Validar campo Contraseña
  if(!empty($contraseña)){
    $contraseña_validado = true;
  }else{
    $contraseña_validado = false;
    $errores['contraseña'] = "La contraseña esta vacia";
  }

  $guardar_usuario = false;

  if(count($errores) == 0){
    $guardar_usuario = true;
    
    // Cifrar la contraseña
    $password_segura = password_hash($contraseña, PASSWORD_BCRYPT, ['cost'=> 4]);

    /* --- LAS SIGUIENTES LINEAS SON PARA VERIFICAR EL PASWORD Y LA COMPARACION ENTRE EL PASWORD Y EL PASWORD CIFRADO
    var_dump($contraseña);
    var_dump($password_segura);
    var_dump(password_verify($contraseña, $password_segura));
    die();
    --- */

    //INSERTAR USUARIO EN LA TABLA usuario DE LA BBDD platem
    $sql = "INSERT INTO usuario VALUES(null, '$Nombres', '$PaternoUsr', '$MaternoUsr', '$Celular', '$ci', '$Email', '$password_segura', CURDATE(), '$Ubicacion');";
    $guardar = mysqli_query($db, $sql);

    //var_dump(mysqli_error($db));                                      // mostrar errores en la consulta sql
    //die();

    if($guardar){

      //ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo 
      //var_dump($_POST); 
      //echo "mensaje de correcto";
      //die;
      //ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo ojo 

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





