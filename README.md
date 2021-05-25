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

 # first use

    1) add project_folder
    2) CD project_folder
    3) composer init
    4) composer install
    5) composer require palvoelgyilaszlo/login
    6) copy 
       /vendor/palvoelgyilaszlo/login/config/
       /vendor/palvoelgyilaszlo/login/public/
       /vendor/palvoelgyilaszlo/login/templates/
       to
       project_folder
    7) use /public/index.php


# use on every protected page

    use Palvoelgyi\Login\Login;

    Login::loginProof();

# or create login.php

    <?php

        require_once '../vendor/autoload.php';

        use Palvoelgyi\Login\Login;

        $login = new Login;

        $login->login();

# or create logout.php

    <?php

        require_once '../vendor/autoload.php';

        use Palvoelgyi\Login\Login;

        $login = new Login;

        $login->logout();

# add new user

    $login = new Login;
    $login->addNewUser(true);

    and use login.php formular







