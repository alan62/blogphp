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

     public function login() {

        $error = null;
        if (!empty($_POST)) { // si l'utilisateur a envoyé le formulaire
            $validation = true;
            if (empty($_POST['pseudo']) || empty($_POST['password'])) {
                $validation = false;
                $error = 1;
            }
            if (strlen($_POST['pseudo']) > 100 || strlen($_POST['password']) > 100) {
                $validation = false;
                $error = 1;
            }
            if ($validation) {
                // récupération de l'utilisateur et de son mot de passe hâché
                $userManager = new UserManager();
                $user = $userManager->get($_POST['pseudo']);
                if (!$user)
                {
                    // si la recherche de pseudo n'a rien donné
                    $error = 1;
                } 
                else 
                {
                    // si on a trouvé un pseudo associé
                    // comparaison du mot de passe envoyé et du mot de passe stocké
                    $verifiedPassword = password_verify($_POST['password'], $user->getPass());
                    if ($verifiedPassword) {
                        // si les deux mots de passe correspondent
                        $_SESSION['id'] = $user->getId();
                        header('Location: index.php?action=admin');
                    } 
                    else 
                    {
                        // s'il y a un pseudo correspondant, mais un mot de passe éronné
                        $error = 1;
                    }
                }
            }
        }
        require ('view/frontend/Login.php');
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