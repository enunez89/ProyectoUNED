<?php

/**
 * Description of Server
 *
 * @author Armando Joaquin C <armand17.10@gmail.com>
 */
class Server {

    public static function SERVERNAME() {
        return filter_input(INPUT_SERVER, 'SERVER_NAME');
    }

    public static function PHPSELF() {
        return filter_input(INPUT_SERVER, 'PHP_SELF');
    }

    public static function URI() {
        return filter_input(INPUT_SERVER, 'REQUEST_URI');
    }

    public static function REMOTEADDR(){
        return filter_input(INPUT_SERVER, 'REMOTE_ADDR');
    }
    
}
