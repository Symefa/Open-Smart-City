<?php
    /*
     *	Open Smart City Project
     */

    
    class Main
    {
        static protected $conf;

        public static function init()
        {
            self::$conf = require __DIR__.'/../conf/config.php';
        }

        public static function getApi()
        {
            return self::$conf['ApiKey'];
        }

        public static function getTitle()
        {
            return self::$conf['Title'];
        }
    }
    Main::init();

?>