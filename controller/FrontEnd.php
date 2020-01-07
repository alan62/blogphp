<?php
class Frontend
{
    // chaque page devient une méthode
    public function home() 
    {
        $articleManager = new ArticleManager();
        // récupère les articles publiés, par ordre d'apparition
        $articles = $articleManager->getPosted();
        require ('view/frontend/Home.php');
    }

    public function billetSimple() {
        require ('view/frontend/BilletSimple.php');
    }

    public function biographie() {
        require ('view/frontend/Biographie.php');
    }

    public function contact() {
        require ('view/frontend/Contact.php');
    }
    
    public function view()
    {   
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $articleManager = new ArticleManager(); // création de l'Article Manager pour centraliser toutes les requêtes
            $commentManager = new CommentManager(); // création du Comment Manager pour centraliser toutes les requêtes
            if ($articleManager->exists($_GET['id']))
            {   
                $article = $articleManager->get($_GET['id']);
                $comments = $commentManager->getPosted($_GET['id']);
                require('view/frontend/View.php');
            }
            else {
                home();
            }
        }
        else {
            home();
        }
    }
}