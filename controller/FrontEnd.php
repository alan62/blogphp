<?php
class frontend
{
    
    public function home() // chaque page devient une méthode
    {
        require ('view/frontend/home.php');
    }

    public function billetSimple() {
        require ('view/frontend/billetSimple.php');
    }
    
}