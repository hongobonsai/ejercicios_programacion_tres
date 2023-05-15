<?php

/******************************************************************************

Aplicación No 22 (Login)

ALONSO NICOLÁS GABRIEL

Aplicación No 22 (Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.

 ******************************************************************************/

include "usuario.php";
$path = './Usuarios/usuarios.csv';
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  echo "La solicitud enviada es incorrecta.";
  exit;
}
try {
  $userLogged = new Usuario($_POST["_nombre"], $_POST["_clave"], $_POST["_mail"]);
  echo Usuario::VerificarUsuarioCsv($userLogged, $path);
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}
