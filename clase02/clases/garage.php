<?php

class Garage
{
  // Propiedades (variables de clase)
  private $_razonSocial; //string
  private $_precioPorHora; //double
  private $_autos; //autos[]

  public function __construct($razonSocial, $precioPorHora = null)
  {
    if (!is_string($razonSocial) || $razonSocial == null) {
      throw new InvalidArgumentException("<br>La razón social debe ser una cadena de caracteres.<br>");
    }
    $this->_razonSocial = $razonSocial;

    if ($precioPorHora != null) {
      if (!is_double($precioPorHora)) {
        throw new InvalidArgumentException("<br>El valor ingresado debe ser double.<br>");
      }
      $this->_precioPorHora = $precioPorHora;
    }
    $_autos = array();
  }

  // Métodos

  public function MostrarGarage()
  {
    $contador = 1;
    if (!$this instanceof Garage) {
      throw new InvalidArgumentException("<br>El dato a mostrar no es de tipo Garage.<br>");
    }
    echo "<br>Razón Social: $this->_razonSocial<br>";
    if ($this->_precioPorHora != null) {
      echo "<br>Precio Por Hora: $this->_precioPorHora<br>";
    }
    if (empty($this->_autos) == false) {
      echo "<br>Autos ingresados:<br>";
      foreach ($this->_autos as $auto) {
        echo "<br>-Auto $contador-<br>";
        Auto::MostrarAuto($auto);
        $contador++;
      }
    } else {
      throw new Exception("<br>El garage no tiene autos ingresados.<br>");
    }
  }

  public function Equals($autoBuscado)
  {
    if (!$autoBuscado instanceof Auto) {
      throw new InvalidArgumentException("<br>El dato a buscar no es de tipo Auto.<br>");
    }
    if ($this->_autos != null) {
      foreach ($this->_autos as $auto) {
        if ($autoBuscado->GetMarca() == $auto->GetMarca()) {
          if ($autoBuscado->GetColor() == $auto->GetColor()) {
            return true;
          }
        }
      }
    }
    return false;
  }
  public function Add($auto)
  {
    if (!$auto instanceof Auto) {
      throw new InvalidArgumentException("<br>El dato a agregar no es de tipo Auto.<br>");
    }
    if ($this->Equals($auto)) {
      throw new Exception("<br>Este auto ya se encuentra en el garage.<br>");
    }
    $this->_autos[] = $auto;
    return true;
  }
  public function Remove($auto)
  {
    if (!$auto instanceof Auto) {
      throw new InvalidArgumentException("<br>El dato a agregar no es de tipo Auto.<br>");
    }
    if (!$this->Equals($auto)) {
      throw new Exception("<br>Este auto no se encuentra en el garage.<br>");
    }
    for ($i = 0; $i < sizeof($this->_autos); $i++) {
      if ($this->_autos[$i]->GetMarca() == $auto->GetMarca()) {
        if ($this->_autos[$i]->GetColor() == $auto->GetColor()) {
          unset($this->_autos[$i]);
          return true;
        }
      }
    }
    throw new Exception("<br>No se pudo eliminar el auto del garage.<br>");
  }
}
