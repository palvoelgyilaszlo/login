<?php

    require_once '../vendor/autoload.php';

    use Palvoelgyi\Helper\Helper;
    use Palvoelgyi\Login\Login;

    $login = new Login;

    Login::loginProof();