<?php
class Frontend
{
    // chaque page devient une méthode
    public function home() 
    {
        $articleManager = new ArticleManager();
        // récupère les articles publiés, par ordre d'apparition
        $articles = $articleManager->getPosted();
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
    
    public function view()
    {
        $articleManager = new ArticleManager(); // création de l'Article Manager pour centraliser toutes les requêtes
        require('view/frontend/view.php');
    }
}