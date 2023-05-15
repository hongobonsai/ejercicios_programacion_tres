<?php

/******************************************************************************
Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.

ALONSO NICOLÁS GABRIEL
 ********************************************************************************/

$vec = array();
$sumaTotal = 0;
$Promedio = 0;
for ($i = 0; $i <= 4; $i++) {
  $vec[$i] = rand(1, 10);
}
for ($i = 0; $i <= 4; $i++) {
  $sumaTotal += $vec[$i];
}
echo "Suma total: $sumaTotal<br>";
$Promedio= $sumaTotal / (count($vec));
if ($Promedio < 6) {
  echo "El promedio es menor a 6.<br>";
} else if ($Promedio == 6) {
  echo "El promedio es igual a 6.<br>";
} else if ($Promedio > 6) {
  echo "El promedio es mayor a 6.<br>";
}
echo "Resultado: '$Promedio'<br><br>";
var_dump($vec);
