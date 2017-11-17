<?php
    interface iScreen 
    {
        public function render();
        public function drawPixel($x, $y, $pixelSymbol);
        public function getMaxX();
        public function getMaxY();
    }
?>