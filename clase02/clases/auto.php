<?php

class Auto
{
  // Propiedades (variables de clase)
  private $_color;
  private $_precio;
  private $_marca;
  private $_fecha;

  public function __construct($marca, $color, $precio = null, $fecha = null)
  {
    if (!is_string($marca) || $marca == null) {
      throw new InvalidArgumentException("El color debe ser una cadena de caracteres");
    }
    if (!is_string($color) || $color == null) {
      throw new InvalidArgumentException("El color debe ser una cadena de caracteres");
    }
    $this->_marca = $marca;
    $this->_color = $color;
    //TODO corregir tema mostrar mensaje validacion precio...
    if ($precio != null) {
      if (is_int($precio)) {
        $this->_precio = $precio;
      }
    }
    if ($fecha != null) {
      $date = date_parse_from_format("d/m/Y", $fecha);
      if (!checkdate($date['month'], $date['day'], $date['year'])) {
        throw new InvalidArgumentException("La fecha debe ser una fecha válida");
      }
      $this->_fecha = $fecha;
    }
  }

  public function GetMarca() {
    return $this->_marca;
  }

  public function GetColor() {
    return $this->_color;
  }
  
  // Métodos
  public function AgregarImpuestos($impuesto)
  {
    if (!is_double($impuesto)) {
      throw new InvalidArgumentException("El valor ingresado debe ser double.");
    }
    $this->_precio += $impuesto;
  }

  public static function MostrarAuto($auto)
  {
    if (!$auto instanceof Auto) {
      throw new InvalidArgumentException("El dato a mostrar no es de tipo Auto");
    }
    echo "Marca: $auto->_marca<br>Color: $auto->_color<br>";
    if ($auto->_precio != null) {
      echo "Precio: $auto->_precio<br>";
    }
    if ($auto->_fecha != null) {
      echo "Fecha: $auto->_fecha<br>";
    }
  }
  public static function Equals($auto1, $auto2)
  {
    if (!$auto1 instanceof Auto || !$auto2 instanceof Auto) {
      throw new InvalidArgumentException("El dato a mostrar no es de tipo Auto");
    }
    if ($auto1->_marca === $auto2->_marca) {
      return true;
    }
    return false;
  }
  public static function Adds($auto1, $auto2)
  {
    if (!$auto1 instanceof Auto || !$auto1 instanceof Auto) {
      throw new InvalidArgumentException("El dato a mostrar no es de tipo Auto");
    }
    if (!$auto1->_marca === $auto2->_marca) {
      echo "Las marcas de los autos no coinciden.";
      return 0;
    }
    if (!$auto1->_marca === $auto2->_marca) {
      echo "Los colores de los autos no coinciden.";
      return 0;
    }
    if ($auto1->_precio == null || $auto2->_precio == null) {
      echo "Alguno de los autos no tiene precio ingresado.";
      return 0;
    }
    $precioTotal = $auto1->_precio + $auto2->_precio;
    return (float)$precioTotal;
  }
}
