<?php

//Funcion que comprueba la validez del usuario
//Recibe el email y la contraseña
//Devuelve un booleano
function checkLoginModel($email, $pass) {
	include_once("../db/config.php");
	$db = mysqli_connect('localhost','root','rootroot','musica');
	
	$valido = false;
    $sql = "SELECT customerId FROM customer WHERE Email = '$email' AND LastName = '$pass'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
		if($count == 1) {
			$valido = true;
			//Consulta para sacar el nombre del usuario y aplicarselo al welcome
			$sql = "SELECT FirstName FROM customer WHERE Email = '$email'";
			$result = mysqli_query($db,$sql);
			$row2 = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			session_start();
			$_SESSION['id_user'] = $row['customerId'];
			$_SESSION['name_user'] = $row2['FirstName'];
		}
   return $valido;
}

?>