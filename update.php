<?php
require_once 'core/init.php';

$user = new User();
if(!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if (Input::exists()) {
    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
            )
        ));
        if ($validation->passed()) {
            try {
                $user->update(array(
                    'name' => Input::get('name')
                ));
                Session::flash('success', 'Your details have been updated');
                Redirect::to('index.php');

            } catch (Exception $ex) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error.'<br>';
            }            
        }
        
    }
}

?>

<form action="" method="post">
    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= escape($user->data()->name); ?>">
    </div>

    <input type="hidden" name="token" value="<?= Token::generate(); ?>">
    <input type="submit" value="Update">
</form>