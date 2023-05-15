<?php

/******************************************************************************

Aplicación No 17 (Auto)

ALONSO NICOLÁS GABRIEL
 ******************************************************************************/
include "clases/auto.php";
try {
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

  echo "<br>-Agregando Impuesto-<br>";
  $auto3->AgregarImpuestos(1500.00);
  $auto4->AgregarImpuestos(1500.00);
  $auto5->AgregarImpuestos(1500.00);
  Auto::MostrarAuto($auto3);
  Auto::MostrarAuto($auto4);
  Auto::MostrarAuto($auto5);

  echo "<br>-Sumando Importes-<br>";
  if (Auto::Adds($auto1, $auto2)) {
    echo Auto::Adds($auto1, $auto2);
  }
  echo "<br>Aclaración: Está bien que muestre este error, puesto que la función válida que los autos tengan precio ingresado, y el ejercicio no pedía ingresar precio a los primeros 2 autos.<br>";

  echo "<br>-Comparando autos-<br>";

  if (Auto::Equals($auto1, $auto2)) {
    echo "El primer auto y el segundo son iguales.";
  } else {
    echo "El primer auto y el segundo no son iguales.";
  }
  if (Auto::Equals($auto1, $auto5)) {
    echo "<br>El primer auto y el quinto son iguales.";
  } else {
    echo "<br>El primer auto y el quinto no son iguales.";
  }
} catch (\InvalidArgumentException $e) {
  echo "<br>", $e->getMessage(), "<br>";
}
