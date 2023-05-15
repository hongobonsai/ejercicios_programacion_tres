<?php

/******************************************************************************
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.

ALONSO NICOLÁS GABRIEL
 *******************************************************************************/

date_default_timezone_set("America/Argentina/Buenos_Aires");
printf("Fecha actual: %s", date("d/m/Y"), "<br>");
$day = date("d");
$month = date("m");
$season = "none";
switch ($month) {
  case '1':
  case '2':
  case '3':
    $season = "verano";
    if ($day >= 21) {
      $season = "otoño";
    }
    break;
  case '4':
  case '5':
  case '6':
    $season = "otoño";
    if ($day >= 21) {
      $season = "invierno";
    }
    break;
  case '7':
  case '8':
  case '9':
    $season = "invierno";
    if ($day >= 21) {
      $season = "primavera";
    }
    break;
  case '10':
  case '11':
  case '12':
    if ($day >= 21) {
      $season = "verano";
    } else {
      $season = "primavera";
    }
    break;
}
echo "<br>";
printf("Estamos en %s...", $season);
