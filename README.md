# login

# Installation with Composer

    composer require palvoelgyilaszlo/login

# configuration

    Either in .env file in the project folder 

        MONGOURI='mongodb://127.0.0.1'
        LOGINTEMPLATESFOLDER='../templates'
        LOGINTEMPLATE='login.html.twig'

    or once 

        $login = new Login;

        $login->setmongoUri('mongodb://127.0.0.1');
        $login->setloginTemplatesFolder('../templates');
        $login->setloginTemplate('login.html.twig');

    or standard

        'mongodb://127.0.0.1'
        '../templates'
        'login.html.twig'

# use on every protected page

    use Palvoelgyi\Login\Login;

    Login::loginProof();

# create login.php

    <?php

        require_once '../vendor/autoload.php';

        use Palvoelgyi\Login\Login;

        $login = new Login;

        $login->login();

# create logout.php

    <?php

        require_once '../vendor/autoload.php';

        use Palvoelgyi\Login\Login;

        $login = new Login;

        $login->logout();








