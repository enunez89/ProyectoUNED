<?php

/**
 * Description of Rol
 *
 */
class Rol {

    const ROL_ADMIN = 1;
    const ROL_SECRETARIA = 2;
    const ROL_AUDITOR = 3;
    const ROL_SOLO_LECTURA = 4;

    public static function getRolID() {
        return Sesion::getAttr("rol");
    }

    public static function getRolName() {
        switch (Sesion::getAttr("rol")) {
            case self::ROL_ADMIN:
                return "Administrador";
            case self::ROL_SECRETARIA:
                return "Secretario(a)";
            case self::ROL_AUDITOR:
                return "Auditor(a)";
            case self::ROL_SOLO_LECTURA:
                return "Usuario solo lectura";
        }
    }

    private static function esTipo($key, $value) {
        return ($key == $value);
    }

    public static function rolAdministrador() {
        return self::esTipo(self::ROL_ADMIN, Sesion::getAttr("rol"));
    }

    public static function rolSecreatria() {
        return self::esTipo(self::ROL_SECRETARIA, Sesion::getAttr("rol"));
    }

    public static function rolAuditor() {
        return self::esTipo(self::ROL_AUDITOR, Sesion::getAttr("rol"));
    }

    public static function rolSoloLectura() {
        $rol = Sesion::getAttr("rol");
        if ($rol == 0) {
            return TRUE;
        }
        return self::esTipo(self::ROL_SOLO_LECTURA, $rol);
    }

}
