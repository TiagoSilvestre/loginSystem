<?php

class Token {
    public static function generate() {
        // gerado o hash do token de sessao
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }

    public static function check($token) {
        $tokenName = Config::get('session/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}