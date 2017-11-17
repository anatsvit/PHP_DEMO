<?php
    require_once("Circle.php");
    require_once("iRenderable.php");
    require_once("iScreen.php");
    require_once("Parameter.php");
    
    class Screen implements iScreen
    {
        const SCREEN_WIDTH   = 128;
        const SCREEN_HEIGHT  = 32;
        
        protected $drawObjects = [];
        protected $drawArea;
        
        public function __construct() 
        {
            $this->addDrawObject(new Circle(Parameter::getValue('x', 0), 
                                            Parameter::getValue('y', 0), 
                                            Parameter::getValue('r', 0)));
        }
        
        public function render()
        {
            $this->clearScreen();
            
            foreach ($this->drawObjects as $drawObject) {
                $drawObject->render($this);
            }
            
            $this->drawScreen();
        }
        
        protected function addDrawObject(iRenderable $drawObject)
        {
            $this->drawObjects[] = $drawObject;
        }
        
        public function clearScreen($clearSymbol = '_')
        {
            for ($i = 0; $i < self::SCREEN_HEIGHT; $i++) {
                for ($j = 0; $j < self::SCREEN_WIDTH; $j++) {
                    $this->drawArea[$i][$j] = $clearSymbol;
                }
            }
        }
        
        protected function drawScreen()
        {
            for ($i = 0; $i < self::SCREEN_HEIGHT; $i++) {
                for ($j = 0; $j < self::SCREEN_WIDTH; $j++) {
                    echo $this->drawArea[$i][$j];
                }
                echo '<br />';
            }
        }
        
        public function getDrawArea()
        {
            return $this->drawArea;
        }
        
        public function setDrawArea($drawArea)
        {
            $this->drawArea = $drawArea;
        }
        
        public function drawPixel($x, $y, $pixelSymbol = 'x')
        {
            $this->drawArea[$x][$y] = $pixelSymbol;
        }
        
        public function getMaxX()
        {
            return self::SCREEN_WIDTH;
        }
        
        public function getMaxY()
        {
            return self::SCREEN_HEIGHT;
        }
        
        private function sign($x) 
        {
            return ($x > 0) ? 1 : (($x < 0) ? -1 : 0);
        }
     
        /**
        Эта функция взята отсюда:
        https://ru.wikibooks.org/wiki/Реализации_алгоритмов/Алгоритм_Брезенхэма
        **/
        public function drawLine($xStart, $yStart, $xEnd, $yEnd) 
        {
            $dx = $xEnd - $xStart;
            $dy = $yEnd - $yStart;
            $incx = $this->sign($dx);
            $incy = $this->sign($dy);
            
            if ($dx < 0) {
                $dx = -$dx;
            }
            
            if ($dy < 0) {
                $dy = -$dy;
            }
            
            if ($dx > $dy) {
                $pdx = $incx;	
                $pdy = 0;
                $es = $dy;	
                $el = $dx;
            } else {
                $pdx = 0;	
                $pdy = $incy;
                $es = $dx;	
                $el = $dy;
            }
            
            $x = $xStart;
            $y = $yStart;
            $err = $el/2;
            
            $this->drawPixel($y, $x);
            
            for ($i = 0; $i < $el; $i++)
            {
                $err -= $es;
                if ($err < 0) {
                    $err += $el;
                    $x += $incx;
                    $y += $incy;
                } else {
                    $x += $pdx;
                    $y += $pdy;
                }

                $this->drawPixel($y, $x);
            }
        }
    }
?>