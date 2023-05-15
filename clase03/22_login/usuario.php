<?php

/******************************************************************************

Aplicación No 22 (Login)

ALONSO NICOLÁS GABRIEL

Aplicación No 22 (Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado, Retorna
un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.

 ******************************************************************************/

class Usuario
{
  // Propiedades (variables de clase)
  private $_nombre;
  private $_clave;
  private $_mail;

  public function __construct($nombre, $clave, $mail)
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
  public static function JsonUserDeserializer($jsonString)
  {
    try {
      if ($jsonString === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("<br>La cadena recibida no es un JSON válido");
      }
      if (!array_key_exists("_nombre", $jsonString) || !array_key_exists("_clave", $jsonString) || !array_key_exists("_mail", $jsonString)) {
        throw new Exception("<br>La cadena recibida no es un Usuario válido");
      }
      $userBuff = new Usuario($jsonString["_nombre"], $jsonString["_clave"], $jsonString["_mail"]);
    } catch (\Exception $e) {
      echo "<br>", $e->getMessage(), "<br>";
    }
    return $userBuff;
  }

  public static function GuardarUsuario($usuario, $path)
  {
    if ($usuario == null) {
      throw new InvalidArgumentException("Se debe recibir un usuario válido.");
    }
    $usuarioArray = array($usuario->GetNombre(), $usuario->GetClave(), $usuario->GetMail());
    if (file_exists($path)) {
      $file = fopen($path, 'a');
      //Acá asume que no debe escribir el header, ya que el archivo ya existe.
    } else {
      $file = fopen($path, 'w');
      //Acá como el archivo no existe, escribe el header.
      fputcsv($file, array('Nombre', 'Clave', 'Mail'));
    }
    try {
      if (!Usuario::ExisteUsuarioCsv($usuario, $path)) {
        if (!fputcsv($file, $usuarioArray)) {
          throw new Exception("No se pudo escribir en el archivo.");
        }
        if (!fclose($file)) {
          throw new Exception("No se pudo cerrar el archivo.");
        }
      }
    } catch (\Exception $e) {
      throw $e;
    }
    return true;
  }

  public static function LeerUsuarios($path)
  {
    $usuariosList = array();
    if ($path != null && is_string($path)) {
      $file = fopen($path, "r");
      fgetcsv($file); // Lectura del Header
      if (feof($file)) {
        throw new Exception("El archivo está vacío");
      }
      while (($lineaLeida = fgetcsv($file, 1000, ",")) !== false) {
        $usuario = new Usuario($lineaLeida[0], $lineaLeida[1], $lineaLeida[2]);
        array_push($usuariosList, $usuario);
      }
      fclose($file);
    }
    return $usuariosList;
  }

  public static function ExisteUsuarioCsv($usuario, $path)
  {
    if ($path != null && is_string($path) && $usuario != null) {
      $archivo = fopen($path, "r");
      fgetcsv($archivo); // Lectura del Header
      while (($lineaLeida = fgetcsv($archivo, 1000, ",")) !== false) {
        if ($usuario->GetNombre() == $lineaLeida[0]) {
          fclose($archivo);
          throw new Exception("El usuario ya existe.");
        }
        if ($usuario->GetMail() == $lineaLeida[2]) {
          fclose($archivo);
          throw new Exception("El correo ya existe.");
        }
      }
    }
    return false;
  }

  public static function VerificarUsuarioCsv($usuario, $path)
  {
    if ($path != null && is_string($path) && $usuario != null) {
      $archivo = fopen($path, "r");
      fgetcsv($archivo); // Lectura del Header
      while (($lineaLeida = fgetcsv($archivo, 1000, ",")) !== false) {
        if ($usuario->GetMail() != $lineaLeida[2]) {
          fclose($archivo);
          throw new Exception("usuario no registrado");
        }
        if ($usuario->GetNombre() == $lineaLeida[0]) {
          if ($usuario->GetClave() == $lineaLeida[1]) {
            fclose($archivo);
            return "verificado";
          } else if($usuario->GetClave() != $lineaLeida[1]){
            fclose($archivo);
            return "error en los datos";
          }
        } else{
          return "nombre de usuario no registrado";
        }
      }
    }
    return false;
  }

  public static function ImprimirLista($arrayUsuarios)
  {
    echo "<br><ul></ul>";
    if ($arrayUsuarios != null) {

      foreach ($arrayUsuarios as $usuario) {
        echo
        "<ul>
          <li>", $usuario->GetNombre(),"</li>
          <li>", $usuario->GetMail(),"</li>
        </ul>";
      }
      return true;
    }
    return false;
  }
}
