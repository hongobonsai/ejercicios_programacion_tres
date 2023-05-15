<?php

/******************************************************************************

Aplicación No 20 bis (Registro CSV)

ALONSO NICOLÁS GABRIEL

Aplicación No 20 BIS (Registro CSV)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario

 ******************************************************************************/

include "usuario.php";
$path = './Usuarios/usuarios.csv';
try {

  $jsonArray = json_decode(file_get_contents('php://input'), true);
  Usuario::GuardarUsuario(Usuario::JsonUserDeserializer($jsonArray), $path);
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}
