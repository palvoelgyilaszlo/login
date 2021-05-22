<?php

    /**
     * Influences the type checking at the input
     * as well as at the output of functions.
     */
    declare(strict_types = 1);

    namespace Palvoelgyi\Login;

    use Configuration;
    use Exception;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    use Palvoelgyi\Mongo\Mongo;
    use Palvoelgyi\Login\LoginInterface;
    use Palvoelgyi\Helper\Helper;

    include_once "../config/conf.inc.php";

    class Login extends Configuration implements LoginInterface
    {
        /**  @var bool */
        private bool $addNewUser = false;

        public static function loginProof() : void
        {
            /** if user is not available then redirect to login.php */
            if( !isset($_SESSION['userid']) OR empty( $_SESSION['userid'] )) {
                self::redirect('login.php');
            }
        }

        public static function redirect( $url = '/', $permanent = false ) : void
        {
            /** redirect to $url */
            header('Location: ' . $url, true, $permanent ? 301 : 302);

            exit();
        }

        public function login() : void 
        {
            /** if userid does not exist */
            if( !isset($_SESSION['userid']) OR empty( $_SESSION['userid'] )) {
        
                 $error  = '';

                /** if form date is not empty */
                if( isset( $_POST['uname'] ) AND ( !empty( $_POST['uname'] ) AND !empty( $_POST['psw'] ))) {

                    /** if user is present */
                    if( $this->proofUser( $_POST['uname'], $_POST['psw'] )) { self::redirect(); }

                    /** if ad new user is false then $error */
                    if( $this->addNewUser == false ) { $error = "It is not possible to create new users"; }
                    else{

                        try {

                            $mongo      = new Mongo;
                            $db         = $mongo->getClient();
                            $collection = $db->users->user;

                            /** create user */
                            $collection->insertOne([
                            'username' => $_POST['uname'],
                            'pw'       => md5( $_POST['psw'] )
                            ]);
                        }
                        catch(Exception $e){ $error = $e->getMessage(); }
                    } 
                };

                /** ad twig template */
                $loader = new FilesystemLoader( $this->loginTemplatesFolder );
                $twig   = new Environment($loader);

                echo $twig->render( $this->loginTemplate, [ 'error' => $error ]);
            }
        }

        public function proofUser(string $user, string $pw) : bool
        {
            /** if userid is present then return false */
            if( isset($_SESSION['userid']) AND !empty($_SESSION['userid'] )) {
                return false;
            }

            $search = ['username' =>  $_POST['uname'], 'pw' =>  md5($_POST['psw']) ];

            $mongo  = new Mongo( $this->mongoUri );

            /** search users in mongodb */
            $userid = $mongo->setDb('users')
                            ->setTable('user')
                            ->getCollectionTableData( $search );

            /** if user is available add userid */
            if( $userid[0] == 1 ) { $_SESSION['userid'] = $userid[1]['username']; return true; }

            return false;
        }

        public function logout() : void 
        {
            /** remove all session data */
            unset($_SESSION["userid"]);
            session_unset();
            session_destroy();
            self::redirect();
        }

        public function addNewUser(bool $add = false) : void 
        {
            /** change add / not new user */
            $this->addNewUser = $add;
        }

        public function removeUser() : void 
        {

        }

        public function setmongoUri(string $mongoUri) : void
        {
            $this->mongoUri       = $mongoUri; 
            $_SESSION['MONGOURI'] = $mongoUri;
        }
        public function setloginTemplatesFolder(string $loginTemplatesFolder) : void
        {
            $this->loginTemplatesFolder       = $loginTemplatesFolder;
            $_SESSION['LOGINTEMPLATESFOLDER'] = $loginTemplatesFolder;
        }
        public function setloginTemplate(string $loginTemplate) : void
        {
            $this->loginTemplate         = $loginTemplate;
            $_SESSION['LOGINTEMPLATE']   = $loginTemplate;
        }
    }
