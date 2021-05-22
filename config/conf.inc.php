<?php

    session_start();

    use Symfony\Component\Dotenv\Dotenv;
    use Palvoelgyi\Helper\Helper;

    class Configuration
    {
        private Dotenv $dotenv;
        private string $userName;
        
        /** @var string */
        protected $mongoUri;
        protected $loginTemplatesFolder;
        protected $loginTemplate;

        public function __construct()
        {
            $this->dotenv = new Dotenv();

            $this->dotenv->load('../.env');

            /** either $_SESSION or .env file or standard setting  */
            $this->mongoUri =
            ( 
                $_SESSION['MONGOURI'] ?? 
                ($_ENV['MONGOURI']  ?? 'mongodb://127.0.0.1' )
            );

            $this->loginTemplatesFolder =
            (
                $_SESSION['LOGINTEMPLATESFOLDER'] ?? 
                ($_ENV['LOGINTEMPLATESFOLDER']  ?? '../templates' )
            );

            $this->loginTemplate =
            (
                $_SESSION['LOGINTEMPLATE'] ??
                ($_ENV['LOGINTEMPLATE']  ?? 'login.html.twig' )
            );
        }

        public function setUserName(string $userName)
        {
            $this->userName = $userName;
        }
    }