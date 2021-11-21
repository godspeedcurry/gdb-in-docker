<?php
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
    CLASS FLAG {
        private $_flag = 'n1ctf{************************}';
        public function __destruct(){
            echo "FLAG: " . $this->_flag;
        } 
    }

    $filename = './phar.phar';
    var_dump(file_exists('phar://'.$filename));