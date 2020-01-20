<?php
class Backend
{
    public function sessionExists()
    {
        if (empty($_SESSION['id']))
        {
            header('Location: index.php?action=login');
            exit(); // interrompt le reste du code
        }
    }

    public function admin()
    {
        $this->sessionExists();

        if (!empty($_GET['session']) && $_GET['session'] == 'end') {
            // Suppression des variables de session et de la session
            $_SESSION = array();
            session_destroy();
            header('Location: index.php?action=login');
            exit();
        }

        if (empty($_GET['success']))
        {
            $success = false;
        }
        elseif ($_GET['success'] == 'newArticle')
        {
            $success = 'Nouvel article ajouté !';
        }
        elseif ($_GET['success'] == 'updateArticle')
        {
            $success = 'Article mis à jour !';
        }

        $articleManager = new ArticleManager(); // création de l'Article Manager pour centraliser toutes les requêtes
        $commentManager = new CommentManager(); // création du Comment Manager pour centraliser toutes les requêtes

        // supression d'un article
        if (!empty($_GET['article']) && $_GET['event'] == 'delete')
        {
            $article = new Article([
                'id' => $_GET['article']
            ]);

            $articleManager->delete($article);

            if ($articleManager->delete($article))
            {
                $success = 'Article supprimé !';
            }
        }

        // approbation ou supression d'un commentaire
        if (!empty($_GET['comment']) && !empty($_GET['event']))
        {
            if ($_GET['event'] == 'accept')
            {
                $comment = new Comment([
                    'id' => $_GET['comment']
                ]);

                $commentManager->accept($comment);

                if ($commentManager->accept($comment))
                {
                    $success = 'Commentaire accepté !';
                }
            }

            if ($_GET['event'] == 'delete')
            {
                $comment = new Comment([
                    'id' => $_GET['comment']
                ]);

                $commentManager->delete($comment);

                if ($commentManager->delete($comment))
                {
                    $success = 'Commentaire supprimé !';
                }
            }
        }

        // récupère les articles et leurs options, du plus récent au plus daté
        $articles = $articleManager->getAll();
        
        // retourne une valeur true s'il y a des commentaires signalés
        $reported = $commentManager->getReported();

        // récupère les commentaires et leurs options, du plus récent au plus daté, en faisant une jointure pour récupérer le titre de l'article associé
        $comments = $commentManager->getAll();

        require('view/backend/admin.php');
    }
}