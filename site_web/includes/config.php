<?php 
    session_start();
    session_destroy();
    //require_once 'variables.php';
    require_once 'fonctions.php';
    //require_once 'classes.php';
    class config{
        // site
        public $site_name = 'Projet_architect';
        public $site_title = 'Projet architect';
        public $site_authors = '';
        public $site_description = '';
        public $site_keywords = '';
        public $site_equiv = 'ie=edge';
        public $site_viewport = 'width=device-width, initial-scale=1.0';
        public $site_lang = 'fr';
        public $site_charset = 'UTF-8';
        // db // ceci est un test sur mon pc en local avec une autre db qui n'a rien a voir avec le projet en cours
        public $db;
        private $db_server = 'mysql:';
        private $db_host = 'host=localhost;'; // url ou ip
        private $db_port = 'port=3306;'; // : 80
        private $db_name = 'dbname=wamp_kc;';
        private $db_charset = 'charset=utf8;';
        private $db_login = 'root';
        private $db_pass = '';
        private $db_options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => TRUE];

        /*public function __construct(){

        }*/
        public function db_connect(){
            try{
                $this->db = new PDO($this->db_server . $this->db_host . $this->db_port . $this->db_name . $this->db_charset, $this->db_login, $this->db_pass, $this->db_options);
                $_SESSION[$this->site_name]['db']['connect'] = true;
                echo('DB IS CONNECTED !');
            }catch(PDOException $e){
                $_SESSION[$this->site_name]['db']['connect'] = false;
                die('ERROR: DB NOT CONNECTED !');
                exit;
            }
        }
    }

    $config = new config();

    $db = $config->db_connect();
?>