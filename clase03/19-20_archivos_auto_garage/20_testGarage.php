<?php

/******************************************************************************

Aplicación No 20 (Auto-Garage)

ALONSO NICOLÁS GABRIEL
 ******************************************************************************/

include "auto.php";
include "garage.php";

$arrayAutos = Auto::LeerAuto("./Files/Autos/autos.csv");


$object = json_decode(file_get_contents('php://input'), true);

echo "<br>--Mostrar Garage--<br>";
Garage::CrearGarage($object["razon social"], floatval(number_format($object["precio por hora"], 2, '.', '')));
$garages = Garage::LeerGarage("./Files/Garages/garages.csv");
try {
  echo "<br>-PRUEBA-<br>";
  $garages[0]->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Agregar un auto--<br>";
try {
  $garages[0]->Add($arrayAutos[0]);
  $garages[0]->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Agregar otro auto--<br>";
try {
  $garages[0]->Add($arrayAutos[1]);
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Agregar otro auto--<br>";
try {
  $garages[0]->Add($arrayAutos[2]);
  $garages[0]->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}
echo "<br>--Agregar un auto que ya existe--<br>";
try {
  $garages[0]->Add($arrayAutos[3]);
  $garages[0]->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Eliminar un auto--<br>";
try {
  $garages[0]->Remove($arrayAutos[4]);
  $garages[0]->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}