<?php

/**
 * Description of Date
 */
class Date {

    const DATE_FORMAT1 = 'Y-m-d H:i';
    const DATE_FORMAT2 = 'Y-m-d h:i a';
    const DATE_FORMAT3 = 'd-m-Y H:i';
    const DATE_FORMAT4 = 'd-m-Y h:i a';
    const DATE_FORMAT5 = 'd-m-Y';
    const HOUR = 'h A';
    const TIME24 = 'H:i';
    const TIMEAMPM = 'h:i A';

    private static $DIAS = array(
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo'
    );
    private static $MESES = array(
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Setiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    );

    public static function formatDate($stringFecha, $format = self::DATE_FORMAT1) {
        return date($format, strtotime($stringFecha));
    }

    public static function getFechaTexto($stringFecha, $hora = FALSE) {
        $numeroDiaSemana = date('N', self::getTime($stringFecha));
        $nombreDia = self::$DIAS[$numeroDiaSemana];
        $numeroDia = date('d', self::getTime($stringFecha));
        $numeroMes = date('m', self::getTime($stringFecha));
        $nombreMes = self::$MESES[$numeroMes];
        $anio = date('Y', self::getTime($stringFecha));
        $FECHA = $nombreDia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
        if ($hora) {
            $FECHA .= ", a las " . self::formatDate($stringFecha, self::TIMEAMPM);
        }
        return $FECHA;
    }

    public static function getNow($format = self::DATE_FORMAT1) {
        return date($format, time());
    }

    public static function getTime($stringFecha) {
        return strtotime($stringFecha);
    }

    public static function getTimeNow() {
        return time();
    }

}
