<?php

/******************************************************************************
Aplicación No 13 (Limitar Palabras)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán: 1 si la palabra
pertenece a algún elemento del listado.
0 en caso contrario.

ALONSO NICOLÁS GABRIEL
 ******************************************************************************/
function BuscarPalabra($palabra, $max)
{
  $palabrasValidas = array("Recuperatorio", "Parcial", "Programación");
  if ($palabra == null || $max == 0) {
    return -1;
  }
  if (!(gettype($palabra) == "string" && gettype($max) == "integer")) {
    return -2;
  }
  if (in_array($palabra, $palabrasValidas) == true) {
    return 1;
  }
  return 0;
}
$palabraTesteada = "Programación";
$prueba = BuscarPalabra($palabraTesteada, 10);
switch ($prueba) {
  case -2:
    echo "pero mete los tipos de dato correctos xfabor garsias.";
    break;
  case -1:
    echo "Eh, o es null o el max es cero...";
    break;
  case 0:
    echo "La palabra no pertenece al listado...";
    break;
  case 1:
    echo "La palabra '$palabraTesteada' pertenece al listado";
    break;
}
