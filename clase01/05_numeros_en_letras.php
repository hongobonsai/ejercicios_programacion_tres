<?php

/******************************************************************************
Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido. Ejemplo 1: $a
= 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”

ALONSO NICOLÁS GABRIEL
 *******************************************************************************/

$num = 26;
$numString = "none";
if ($num < 20 || $num >= 60) {
  printf("Número en rango incorrecto...");
} else {
  $numChar = strval($num);
  switch ($numChar[0]) {
    case '2':
      $numString = "veinti";
      break;
    case '3':
      $numString = "treinta";
      break;
    case '4':
      $numString = "cuarenta";
      break;
    case '5':
      $numString = "cincuenta";
      break;
  }
  if ($numString != "veinti") {
    $numString = $numString . " y ";
  }
  switch ($numChar[1]) {
    case '1':
      $numString = $numString . "uno";
      break;
    case '2':
      $numString = $numString . "dos";
      break;
    case '3':
      $numString = $numString . "tres";
      break;
    case '4':
      $numString = $numString . "cuatro";
      break;
    case '5':
      $numString = $numString . "cinco";
      break;
    case '6':
      $numString = $numString . "seis";
      break;
    case '7':
      $numString = $numString . "siete";
      break;
    case '8':
      $numString = $numString . "ocho";
      break;
    case '9':
      $numString = $numString . "nueve";
      break;
  }
  printf($numString);
}
