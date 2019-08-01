<?php
require_once 'core/init.php';

$username = Input::get('user');

if (!$username) {
    Redirect::to('index.php'); 
} else {
    $user = new User($username);
    
    if (!$user->exists()) {
        Redirect::to(404); 
    } else {
        $data = $user->data();
    }
?>

<h3><?= escape($data->username); ?></h3>
<p>Full name: <?= escape($data->name); ?></p>


<?php
}
