<?php
    require_once("iScreen.php");
    interface iRenderable 
    {
        public function render(iScreen $screen);
    }
?>