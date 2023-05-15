<?php

/******************************************************************************

Aplicación No 21 ( Listado CSV y array de usuarios)

ALONSO NICOLÁS GABRIEL

Aplicación No 21 ( Listado CSV y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista

<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>
Hacer los métodos necesarios en la clase usuario

 ******************************************************************************/

include "usuario.php";
$path = './Usuarios/usuarios.csv';
if ($_SERVER['REQUEST_METHOD'] != 'GET') {
  echo "La solicitud enviada es incorrecta.";
  exit;
}

try {
  $listType = $_GET['listType'];
  if ($listType != "usuarios") {
    echo "La lista no corresponde a una lista de usuarios.";
  }
  $userList = Usuario::LeerUsuarios($path);
  Usuario::ImprimirLista($userList);
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}
