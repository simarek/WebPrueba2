<?php
//conexion
$servidor = 'localhost';
$usuario = 'root';
$password = '';
$basededatos = 'platem';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");


// Iniciar la sesion
session_start();
