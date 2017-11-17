<?php
    class Parameter
    {
        public static function getValue($name, $default = null)
        {
            return !empty($_GET[$name]) ? $_GET[$name] : $default;
        }
    }
?>