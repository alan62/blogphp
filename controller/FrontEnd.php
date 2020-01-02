<?php
class Frontend
{
    
    public function home() // chaque page devient une méthode
    {
        require ('view/frontend/home.php');
    }

    public function billetSimple() {
        require ('view/frontend/billetSimple.php');
    }

    public function biographie() {
        require ('view/frontend/biographie.php');
    }

    public function contact() {
        require ('view/frontend/contact.php');
    }
    
}