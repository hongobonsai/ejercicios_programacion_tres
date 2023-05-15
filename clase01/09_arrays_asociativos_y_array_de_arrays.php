<?php

/******************************************************************************
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.

ALONSO NICOLÁS GABRIEL
 ********************************************************************************/
$lapicera1 = array("color" => "negro", "marca" => "Bic", "trazo" => "grueso", "precio" => 200);
$lapicera2 = array("color" => "azul", "marca" => "Filgo", "trazo" => "medio", "precio" => 175);
$lapicera3 = array("color" => "rojo", "marca" => "Staples", "trazo" => "delgado", "precio" => 360);
$lapiceras = array("Bic" => $lapicera1, "Filgo" => $lapicera2, "Staples" => $lapicera3);
$contador = 1;

foreach ($lapiceras as $valor) {
    echo "<br>Lapicera: $contador<br>";
    foreach ($valor as $key => $value) {
      echo "$key: $value, ";
    }
    $contador++;
}
/*
foreach ($lapiceras as $k => $valor) {
  if ($k == "Filgo") {
    echo "Lapicera ''<br>";
    foreach ($lapicera1 as $key => $value) {
      echo "$key: $value, ";
    }
  }
}
*/
