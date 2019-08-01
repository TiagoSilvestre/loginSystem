<?php
require_once 'core/init.php';

if (Session::exists('success')) {
    echo Session::flash('success');
}

$user = new User();

if ($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="profile.php?user=<?= escape($user->data()->username); ?>"><?= escape($user->data()->username); ?></a>!</p>
    <ul>
        <li><a href="update.php">Update details</a></li>
        <li><a href="changepassword.php">Change password</a></li>
        <li><a href="logout.php">Log out!</a></li>

    </ul>
    <?php

    
if ($user->hasPermission('admin')) {
    echo '<p>You are an admin</p>';
}else { 
    echo 'nada';
}
    
    
} else {
    echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}



// if($users->count()) {
//     foreach($users as $user) {
//         echo $user->username;
//     }
// }

// $user = DB::getInstance()->query('SELECT * FROM users WHERE username = ?', array('tiago'));

//print_r(DB::getInstance());
 //$user = DB::getInstance()->get('users', array('username', '=', 'tiago'));
// if(!$user->count()) {
//     echo 'no user';
// }else {
//     echo $user->first()->username;
// }

// $user = DB::getInstance()->insert('users', array(
//      'username' => 'Lekis',
//      'password' => 'vfj4938i',
//      'salt' => 'Esse eh oSalt',
// ));

// $user = DB::getInstance()->update('users', 3, array(
//     "password" => "passtest",
//     'name' => 'Daçle Bale'
// ));