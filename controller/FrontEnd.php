<?php
class Frontend
{
    // chaque page devient une méthode
    public function Home() 
    {
        $articleManager = new ArticleManager();
        // récupère les articles publiés, par ordre d'apparition
        $articles = $articleManager->getPosted();
        require ('view/frontend/Home.php');
    }

    public function Disconnect()
    {
        session_destroy();
    }

    public function Biographie() {
        require ('view/frontend/Biographie.php');
    }

    public function CheckPseudo()
    {
        require('view/frontend/CheckPseudo.php');
    }

    public function Error() {
        require ('view/frontend/Error.php');
    }

    public function Login() {

        $error = null;
        if (!empty($_POST)) { // si l'utilisateur a envoyé le formulaire
           
            if (isset($_POST['pseudo']) && isset($_POST['password']))
            {   
            if (strtolower($_POST['pseudo']) == "jean" && password_verify($_POST['password'], '$2y$10$GXK6BiRmUvKTgRiFksf6UudRh65TVet0M5mj8Rq5bu9I3v4FP6brq'))
            
            {
                $_SESSION['id'] = 1; 
                header('Location: index.php?action=admin'); 
            }
                else $error = 1;
            }  
                else $error = 1;  
        }
        require ('view/frontend/Login.php');
    }
    
    public function View()
    {   
        $articleManager = new ArticleManager(); // création de l'Article Manager pour centraliser toutes les requêtes
        $commentManager = new CommentManager(); // création du Comment Manager pour centraliser toutes les requêtes
        // s'il y a un commentaire signalé
        if (!empty($_GET['comment']) && !empty($_GET['article']) && $_GET['event'] == 'report') {
            $comment = new Comment([
                'id' => $_GET['comment']
            ]);
            $commentManager->report($comment);

            header('Location: index.php?action=view&id=' . $_GET['article'] . '#comments');
            exit();
        }
        // si l'utilisateur a posté un commentaire
        if (!empty($_POST)) {
            $validation = true;
            if (empty($_POST['form-pseudo']) || empty($_POST['form-comment'])) {
                $validation = false;
            }
            if ($_POST['form-pseudo'] > 255) {
                $validation = false;
            }
            // si les champs sont remplis et conformes
            if ($validation) {
                $comment = new Comment([
                    'id_article' => $_GET['id'],
                    'pseudo' => $_POST['form-pseudo'],
                    'comment' => $_POST['form-comment']
                ]);
                $commentManager->add($comment);
            }
            header('Location: index.php?action=view&id=' . $_GET['id'] . '#comments');
        }
        // on vérifie si l'utilisateur a demandé une id chiffrée et si l'article existe
        $article = $articleManager->exists($_GET['id']);
        if (!$article) {
            header('Location: index.php?action=error');
            exit();
        } else {
            $article = $articleManager->get($_GET['id']);
        }
        // récupère les commentaires postés sur l'article
        $comments = $commentManager->getPosted($_GET['id']);
        require('view/frontend/View.php');
    }
}