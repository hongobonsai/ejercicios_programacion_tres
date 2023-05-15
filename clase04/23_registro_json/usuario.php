<?php

/******************************************************************************
Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000). crear un dato con la
fecha de registro , toma todos los datos y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.

ALONSO NICOLÁS GABRIEL
 ********************************************************************************/

class Usuario
{
  // Propiedades (variables de clase)
  private $_nombre;
  private $_clave;
  private $_mail;
  private $_id;
  private $_fechaDeRegistro;

  public function __construct($nombre, $clave, $mail, $id = null, $fechaDeRegistro = null)
  {
    if (preg_match('/\s/', $nombre) || $nombre == null) {
      throw new InvalidArgumentException("El nombre de usuario no debe contener espacios en blanco");
    }
    if (preg_match('/\s/', $clave) || $clave == null) {
      throw new InvalidArgumentException("La contraseña no debe contener espacios en blanco");
    }
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL) || $clave == null) {
      throw new InvalidArgumentException("Formato de mail incorrecto");
    }
    $this->_nombre = $nombre;
    $this->_clave = $clave;
    $this->_mail = $mail;
    if ($id == null) {
      $this->_id = rand(0, 10000);
    } else {
      $this->_id = $id;
    }
    if ($fechaDeRegistro == null) {
      date_default_timezone_set("America/Argentina/Buenos_Aires");
      $this->_fechaDeRegistro = date("d/m/Y");
    } else {
      $this->_fechaDeRegistro = $fechaDeRegistro;
    }
  }

  public function GetNombre()
  {
    return $this->_nombre;
  }
  public function GetClave()
  {
    return $this->_clave;
  }
  public function GetMail()
  {
    return $this->_mail;
  }
  public function GetFechaDeRegistro()
  {
    return $this->_fechaDeRegistro;
  }
  public function GetId()
  {
    return $this->_id;
  }

  public static function JsonUserDeserializer($jsonString)
  {
    try {
      if ($jsonString === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("<br>La cadena recibida no es un JSON válido");
      }
      if (!array_key_exists("_nombre", $jsonString) || !array_key_exists("_clave", $jsonString) || !array_key_exists("_mail", $jsonString)) {
        throw new Exception("<br>La cadena recibida no es un Usuario válido");
      }
      $userBuff = new Usuario($jsonString["_nombre"], $jsonString["_clave"], $jsonString["_mail"], $jsonString["_fechaDeRegistro"], $jsonString["_id"]);
    } catch (\Exception $e) {
      echo "<br>", $e->getMessage(), "<br>";
    }
    return $userBuff;
  }


  public static function JsonToArray($path)
  {
    if ($path == null) {
      throw new InvalidArgumentException("Se debe recibir una ruta válida.");
    }
    try {
      $jsonString = file_get_contents($path);
      if ($jsonString === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("La cadena recibida no es un JSON válido");
      }
      $jsonArray = json_decode($jsonString, true);
    } catch (\Exception $e) {
      echo "<br>", $e->getMessage(), "<br>";
    }
    return $jsonArray;
  }

  public function UsuarioToArray()
  {
    if ($this == null) {
      throw new InvalidArgumentException("Se debe recibir un usuario válido.");
    }
    $usuarioArray = array(
      "_nombre" => $this->GetNombre(),
      "_clave" => $this->GetClave(),
      "_mail" => $this->GetMail(),
      "_fechaDeRegistro" => $this->GetFechaDeRegistro(),
      "_id" => $this->GetId()
    );
    return $usuarioArray;
  }

  public static function GuardarUsuarioJson($usuario, $path)
  {
    if ($usuario == null) {
      throw new InvalidArgumentException("Se debe recibir un usuario válido.");
    }
    if (file_exists($path)) {
      $usuarioArray = $usuario->UsuarioToArray();
      $usuariosArray = Usuario::JsonToArray($path);
      array_push($usuariosArray, $usuarioArray);
      $json = json_encode($usuariosArray);
      $bytes = file_put_contents("Usuario/Usuarios/usuarios.json", $json);
      echo "<br>Se sobrescribió el archivo 'usuarios.json'. Peso actual: $bytes bytes.";
    } else {
      $usuarioArray = $usuario->UsuarioToArray();
      $usuariosArray = array();
      array_push($usuariosArray, $usuarioArray);
      $json = json_encode($usuariosArray);
      $bytes = file_put_contents("Usuario/Usuarios/usuarios.json", $json);
      echo "<br>El archivo de usuarios no existe. Se creo el archivo 'usuarios.json'. Peso actual: $bytes bytes.";
    }
    return true;
  }
}
