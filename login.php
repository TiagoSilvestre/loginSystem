<?php
    require_once 'core/init.php';

    if(Input::exists()) {
        if(Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array('required' => true),
                'password' => array('required' => true)
            ));
            if($validation->passed()) {
                $user = new User();
                
                $remember = (Input::get('remember') === 'on') ? true : false; 
                var_dump($remember);
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);
                
                echo '<pre>';
                print_r($login);
                echo '</pre>';
                
                if($login) {
                    Session::flash('success', 'Você logou com sucesso!!');
                    Redirect::to('index.php');
                }else {
                    echo '<p>Sorry, loggin in failed.</p>';
                }
            }else {
                foreach($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }

        }
    }

?>



<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off">
    </div>

    <div class="field">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember"> Remeber me
        </label>
    </div>

    
    <input type="hidden" name="token" value="<?= Token::generate(); ?>">
    <input type="submit" value="Log in">
</form>    
