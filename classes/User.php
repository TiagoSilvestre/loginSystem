<?php

/** 
 * <b>Classe de Usuario</b>
 * ela manipula varios aspectos, como login, logout
 * @copyright (c) 2019, Tiago Silvestre
 */
class User {
    private $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedIn;
    
    /** @var DB */
    private $_db;
    
    /**
     * Sem parametro: verifica a sessao e se tiver o user seta _isLoggedIn: true  
     * @param type $user Esse usuario pode ser um id ou username
     */
    public function __construct($user = null) 
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');


        if (!$user) {
            if (Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                
                if ($this->find($user)) {
                    $this->_isLoggedIn = true;
                } else {
                    // process logout
                }
                // echo "pegou usuario da sessao";
            } else {
//                echo 'nao tem valor nenhum na sessao e nao foi passado nada no construtor<br>';
//                echo '-- Valor da sessao:';
//                echo '<pre>';
//                print_r($_SESSION);
//                echo '</pre>';
            }
        } else {
            $this->find($user);
        }
    }

    /**
     * Essa é a descrição base do create aqui vamos informar como
     * funciona essa funçao
     * @param array $fields Array com os campos do usuario
     * @throws Exception
     */
    public function create($fields = array()) 
    {
        if (!$this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }
    
    public function update($fields = array(), $id = null)
    {
        if (!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }
        
        if (!$this->_db->update('users', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }

    public function hasPermission($key)
    {
        $group = $this->_db->get('groups', array('id', '=', $this->data()->grupo));
        
        if ($group->count()) {
           $permissions = json_decode($group->first()->permissions, true);
           
           if ($permissions[$key] == true) {
               return true;
           }
        }
        return false;
    }
    
    /**
     * Verifica se o usuario esta no db e insere os valores
     * dele em _data da classe
     * @param type $user Pode ser um id ou username
     * @return boolean
     */
    public function find($user = null) 
    {
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $username pode ser um id ou string
     * @param string $password nao é requerido
     * @return bool
     */
    public function login($username = null, $password = null, $remember = false) 
    {
        if (!$username && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($username);
        
            if ($user) {
                if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
                    Session::put($this->_sessionName, $this->data()->id);
                    
                    if ($remember) {
                        
                        $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

                        if (!$hashCheck->count()) {
                            $hash = Hash::unique();
                            $this->_db->insert('users_session', array(
                               'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
        return false;
    }
    
    
    public function logout() 
    {
        $this->_db->delete('users_session', array('user_id', '=',  $this->data()->id));
        Cookie::delete($this->_cookieName);
        Session::delete($this->_sessionName);
    }    
    /**
     * Verifica se existe algum usuario setado na classe
     * @return boolean
     */
    public function exists() 
    {
        return (!empty($this->_data)) ? true : false;
    }
    
    /**
     * 
     * @return stdClass Object: User Object
     */
    public function data() 
    {
        return $this->_data;
    }

    /**
     * 
     * @return boolean
     */
    public function isLoggedIn() 
    {
        return $this->_isLoggedIn;
    }
}
