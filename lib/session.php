<?php
    class session
    {
        public static function init()
        {
            session_start();
        }
        public function set($key,$val)
        {
            $_SESSION[$key]=$val;
        }
        public function get($key)
        {
            if(isset($_SESSION[$key]))
            {
                return $_SESSION[$key];
            }else{
                return false;
            }
        }
        public static function checksession(){
            self::init();
            if(!((self::get("login_admin"))=="true"))
            {
                self::session_destroy();
                header("Location: login.php");
            }
        }
        public static function session_destroy()
        {
            unset($_SESSION['login_admin']);
            unset($_SESSION['admin_username']);
            unset($_SESSION['admin_role']);
            unset($_SESSION['admin_id']);
            header("Location: login.php");
        }
    }

?>