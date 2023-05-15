<?php
/******************************************************************************
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.

ALONSO NICOLÁS GABRIEL
*******************************************************************************/
$resultado = 0;
for ($i=0; $i < 1000; $i++) { 
  if(($resultado+$i) >= 1000){
    break;
  }
  $resultado+=$i;
  $numCount = $i;
}
printf("Resultado: %d<br>Cantidad de numeros sumados: %d", $resultado, $numCount);
