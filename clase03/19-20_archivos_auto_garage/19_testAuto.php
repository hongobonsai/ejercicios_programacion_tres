<?php

/******************************************************************************

Aplicación No 19 (Auto)

ALONSO NICOLÁS GABRIEL
 ******************************************************************************/
include "auto.php";
try {

  //Este sector del código, sirve para resetear la creación del archivo csv,
  //así no creo 7 mil autos por prueba xDDDD
  if (file_exists('./Files/Autos/autos.csv')) {
    if (unlink("./Files/Autos/autos.csv")) {
      echo "<br><br>-ARCHIVOS ANTERIORES ELIMINADOS-<br><br>";
    }
  }
  $autos = json_decode(file_get_contents('php://input'), true);

  foreach ($autos as $auto) {
    if (!array_key_exists("marca", $auto) || !array_key_exists("color", $auto)) {
      throw new Exception("Ocurrió un problema al leer el dato de un auto.");
    }
    if (array_key_exists("precio", $auto) && array_key_exists("fecha", $auto)) {
      Auto::CrearAuto(
        $auto["marca"],
        $auto["color"],
        floatval(number_format($auto["precio"], 2, '.', '')),
        $auto["fecha"]
      );
    } else if (array_key_exists("precio", $auto) && !array_key_exists("fecha", $auto)) {
      Auto::CrearAuto(
        $auto["marca"],
        $auto["color"],
        floatval(number_format($auto["precio"], 2, '.', ''))
      );
    } else {
      Auto::CrearAuto(
        $auto["marca"],
        $auto["color"]
      );
    }
  }
  /*
  Auto::CrearAuto("Honda", "Rojo");
  Auto::CrearAuto("Honda", "Negro");
  Auto::CrearAuto("Toyota", "Azul", 50000);
  Auto::CrearAuto("Toyota", "Azul", 89000);
  Auto::CrearAuto("Renault", "Plateado", 120000, "25/12/2018");
  Auto::CrearAuto("Volkswagen", "Violeta", 300000, "16/04/1995");
  */
  $array = Auto::LeerAuto("./Files/Autos/autos.csv");
  echo "<br>-PRUEBA-<br>";
  for ($i = 0; $i < sizeof($array); $i++) {
    Auto::MostrarAuto($array[$i]);
  }
} catch (\Exception $e) {
  echo "<br>", $e->getMessage(), "<br>";
}
