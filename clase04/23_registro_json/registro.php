<?php

/******************************************************************************
Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.

ALONSO NICOLÁS GABRIEL
 ********************************************************************************/

include "usuario.php";
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  echo "La solicitud enviada es incorrecta.";
  exit;
}

$usuario = new Usuario($_POST["nombre"], $_POST["clave"], $_POST["mail"]);
Usuario::GuardarUsuarioJson($usuario, "Usuario/Usuarios/usuarios.json");

if (isset($_FILES['user_img'])) {
  $destino = "./Usuario/Fotos/" . $_POST["nombre"] . "_foto" . "." . pathinfo($_FILES['user_img']['name'], PATHINFO_EXTENSION);
  if (move_uploaded_file($_FILES['user_img']['tmp_name'], $destino)) {
    echo "<br>Se cargó el archivo " . $_POST["nombre"] . "_foto" . "." . "'" . pathinfo($_FILES['user_img']['name'], PATHINFO_EXTENSION) . "'" . " en el servidor.<br>";
  }
} else {
  echo "<br>No hay archivos seleccionados.<br>";
}