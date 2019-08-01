<?php

class Hash {
    /**
     * Gera um hash com o algoritmo sha256
     * A string que é hasheada é o password + salt 
     * @param type password
     * @param type $salt
     * @return string o hash fabricado com o password e o salt
     */
    public static function make($password, $salt = '') {
        return hash('sha256', $password . $salt);
    }

    public static function salt($length) {
        return mcrypt_create_iv($length);
    } 

    public static function unique() {
        return self::make(uniqid());
    }        
}