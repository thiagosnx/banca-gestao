<?php 
    // if($_SERVER['SERVER_ADDR'] == 'localhost'){
    // if($_SERVER['SERVER_ADDR']){
    //     return '200';
    // }else{
    //     return '403';
    // }
    define('DB_HOSTNAME', 'localhost');
    define('DB_DATABASE', 'bancagestao');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    



    class Conexao {
        public $server      = [DB_HOSTNAME,'localhost'];
        public $user        = [DB_USERNAME,'root'];
        public $pass        = [DB_PASSWORD,''];
        public $database    = [DB_DATABASE,'bancagestao'];
        public $query       = '';
    }
?>
    