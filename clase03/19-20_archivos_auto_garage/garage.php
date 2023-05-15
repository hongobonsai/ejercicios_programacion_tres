<?php

class Garage
{
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
  }

  public function GetRazonSocial()
  {
    return $this->_razonSocial;
  }

  public function GetPrecioPorHora()
  {
    return $this->_precioPorHora;
  }

  public function GetAutos()
  {
    return $this->_autos;
  }

  public static function CrearGarage($razonSocial, $precioPorHora = null)
  {
    if ($razonSocial == null) {
      throw new InvalidArgumentException("La marca y el color son necesarios para ingresar el auto.");
    }
    $garageBuff = new Garage($razonSocial, $precioPorHora);
    $garageArray = array($garageBuff->GetRazonSocial(), $garageBuff->GetPrecioPorHora());

    if (file_exists('./Files/Garages/garages.csv')) {
      $file = fopen('./Files/Garages/garages.csv', 'a');
      //Acá asume que no debe escribir el header, ya que el archivo ya existe.
    } else {
      $file = fopen('./Files/Garages/garages.csv', 'w');
      //Acá como el archivo no existe, escribe el header.
      fputcsv($file, array('Razon Social', 'Precio Por Hora', 'Autos Ingresados'));
    }
    if (!fputcsv($file, $garageArray)) {
      throw new Exception("No se pudo escribir en el archivo.");
    }
    if (!fclose($file)) {
      throw new Exception("No se pudo cerrar el archivo.");
    }
  }

  public static function LeerGarage($path)
  {
    $garagesBuff = array();
    if ($path != null && is_string($path)) {
      $archivo = fopen($path, "r");
      fgetcsv($archivo); // Lectura del Header
      while (($lineaLeida = fgetcsv($archivo, 1000, ",")) !== false) {
        $garage = new Garage($lineaLeida[0], floatval($lineaLeida[1]));
        array_push($garagesBuff, $garage);
      }
      fclose($archivo);
    }
    return $garagesBuff;
  }

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
      throw new Exception("El garage no tiene autos ingresados.<br>");
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
