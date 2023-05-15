<?php
/******************************************************************************
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.

ALONSO NICOLÁS GABRIEL
******************************************************************************/
function InvertirPalabra($str){
  $strRev = "";
  $strBuff = $str;
  $retorno = -1;
  if($str != null){
    for ($i=strlen($str); $i > 0 ; $i--) { 

      $strRev = $strRev . $strBuff[$i-1];
    }
    $retorno = $strRev;
  }
  return $retorno;
}
$arrString = "Prueba";
$arrReversed = InvertirPalabra($arrString);
echo $arrReversed;
