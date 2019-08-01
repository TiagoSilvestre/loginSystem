<?php

class Input {

    public static function exists($type = 'post') {
        switch($type) {
            case 'post':
                return (!empty($_POST)) ? true : false;
            break;

            case 'get':
                return (!empty($_GET)) ? true : false;
            break;

            default:
                return false;
            break;
        }
    }

    /**
     * Retorna o valor de uma variavel $_GET ou $_POST
     * @param type $item
     * @return string
     */
    public static function get($item) {
        if(isset($_POST[$item])) {
            return $_POST[$item];
        }else if(isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }

}