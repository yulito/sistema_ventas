<?php

namespace App\Helpers;

class Msg{
    //register
    const EMPTY_FIELD   = "Debes rellenar los campos obligatorios.";
    const ALL_FIELDS    = "Debes rellenar todos los campos.";
    const FILE_DATA     = "Tipo de archivo incorrecto.";
    const PASS_LENGTH   = "La contraseña no cumple con los requisitos.";
    const PASS_INVALID  = "Contraseña invalida.";
    //login
    const MSG_SUCCESS   = "Operación realizada correctamente!.";
    const TYPE_INCORRECT   = "Tipo de usuario INCORRECTO.";
    const NAME_EXIST    = "Este nombre ya esta registrado.";
    const AUTH_ERROR    = "Idenficación fallida!!.";
    //recovery
    const PASS_NOTMATCH = "Las contraseñas no coinciden";
    const FAILED_OPERATION = "La operación a fallado!.";
    //http
    const HTTP_200 = "Operación exitosa!";
    const ERROR_404 = "ERROR 404. la página no se encuentra";    
}