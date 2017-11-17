<?php
    require_once("iRenderable.php");
    require_once("iScreen.php");
    
    class Circle implements iRenderable
    {
        private $x;
        private $y;
        private $radius;
        
        public function __construct($x = 0, $y = 0, $radius = 0)
        {
            $this->setPosition($x, $y)->setRadius($radius);
        }
        public function setPosition($x, $y) 
        {
            return $this->setX($x)->setY($y);
        }
        
        public function setX($x)
        {
            $this->x = $x;
            return $this;
        }
        
        public function setY($y)
        {
            $this->y = $y;
            return $this;
        }
        
        public function setRadius($radius)
        {
            $this->radius = $radius;
            return $this;
        }
        
        public function getRadius()
        {
            return $this->radius;
        }
        
        public function getX()
        {
            return $this->x;
        }
        
        public function getY()
        {
            return $this->y;
        }
        
        public function render(iScreen $screen)
        {
            for ($i = 0; $i < 360; $i++) {
                $screen->drawLine($this->getX(), 
                                  $this->getY(),
                                  $this->getX() + $this->getRadius() * cos($i), 
                                  $this->getY() + $this->getRadius() * sin($i));
            }
        }
    }
?>