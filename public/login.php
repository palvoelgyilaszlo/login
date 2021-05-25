<?php

    require_once '../vendor/autoload.php';

    use Palvoelgyi\Helper\Helper;
    use Palvoelgyi\Login\Login;
 
    $login = new Login;

    $login->setmongoUri('mongodb://127.0.0.1');
    $login->setloginTemplatesFolder('../templates');
    $login->setloginTemplate('login.html.twig');


    $login->login();
    Helper::getClasses();

exit;

   
    
    

    Helper::e($_POST);
exit;
    Helper::e('exit');



    $login->setUserName('Tiger');

    Helper::e(Login::loginProof());