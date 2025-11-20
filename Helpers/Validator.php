<?php

namespace PortalDeEmpleo2\Helpers;

class Validator{

    private $errores;

    public function __construct() {
        $this->errores = array();
    }

    public function getErrores(){
        return $this->errores;
    }

    public function requerido($valor, $campo = ""){
        if(!isset($valor) || empty($valor)){
            $this->errores[$campo] = "El campo $campo no puede estar vacio";
            return false;
        }
        return true;
    }

    public function nombre($valor, $campo = ""){
        if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $valor) || $valor !== trim($valor)) {
            $this->errores[$campo] = "El nombre solo puede contener letras y espacios";
            return false;
        }
        return true;
    }

    public function telefono($valor, $campo = "") {
        if (!preg_match("/^[679]\d{8}$/", $valor) || $valor !== trim($valor)) {
            $this->errores[$campo] = "El teléfono no es correcto";
            return false;
        }
        return true;
    }

    public function correo($valor, $campo = ""){
        if(!filter_var($valor, FILTER_VALIDATE_EMAIL) || $valor !== trim($valor)){
            $this->errores[$campo] = "Debe ser un correo valido";
            return false;
        }
        return true;
    }

    public function contrasena($valor, $campo = ""){
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $valor) || $valor !== trim($valor)) {
            $this->errores[$campo] = "La contraseña tiene que tener 6 digitos, numeros y letras";
            return false;
        }
        return true;
    }

    public function foto($valor, $campo = ""){
        $valido = true;

        if (empty($valor) || $valor["error"] === UPLOAD_ERR_NO_FILE) {
            
        } else {

            // viene archivo con error
            if ($valor["error"] !== UPLOAD_ERR_OK) {
                $this->errores[$campo] = "Error al subir la foto";
                $valido = false;
            }
            
            $tiposValidos = ["image/jpeg", "image/png"];
            if ($valido && !in_array($valor["type"], $tiposValidos)) {
                $this->errores[$campo] = "La foto debe ser JPG o PNG";
                $valido = false;
            }
        }

        return $valido;
    }

    public function curriculum($valor, $campo = ""){
        $valido = true;

        if (empty($valor) || $valor["error"] === UPLOAD_ERR_NO_FILE) {
            
        } else {

            // viene archivo con error
            if ($valor["error"] !== UPLOAD_ERR_OK) {
                $this->errores[$campo] = "Error al subir el curriculum";
                $valido = false;
            }

            if ($valido && $valor["type"] !== "application/pdf") {
                $this->errores[$campo] = "El curriculum debe ser un PDF";
                $valido = false;
            }
        }

        return $valido;
    }

}


?>