<?php

/******************************************************************************

Aplicación No 17 (Auto)

ALONSO NICOLÁS GABRIEL
 ******************************************************************************/
include "clases/auto.php";
include "clases/garage.php";
$auto1 = new Auto("Honda", "Rojo");
Auto::MostrarAuto($auto1);

$auto2 = new Auto("Honda", "Negro");
Auto::MostrarAuto($auto2);

$auto3 = new Auto("Toyota", "Azul", 50000);
Auto::MostrarAuto($auto3);

$auto4 = new Auto("Toyota", "Azul", 89000);
Auto::MostrarAuto($auto4);

$auto5 = new Auto("Renault", "Plateado", 120000, "25/12/2018");
Auto::MostrarAuto($auto5);

echo "<br>--Mostrar Garage--<br>";
$garage = new Garage("Garage Julio", 500.00);
try {
  $garage->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Agregar un auto--<br>";
try {
  $garage->Add($auto1);
  $garage->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Agregar otro auto--<br>";
try {
  $garage->Add($auto4);
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Agregar otro auto--<br>";
try {
  $garage->Add($auto5);
  $garage->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}
echo "<br>--Agregar un auto que ya existe--<br>";
try {
  $garage->Add($auto5);
  $garage->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}

echo "<br>--Eliminar un auto--<br>";
try {
  $garage->Remove($auto4);
  $garage->MostrarGarage();
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}