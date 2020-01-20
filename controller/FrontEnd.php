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


    public function Connect()
    {
        if (isset($_POST['pseudo']) && isset($_POST['password']))
        {
            if (strtolower($_POST['pseudo']) == "jean" && password_verify($_POST['password'], '$2y$10$GXK6BiRmUvKTgRiFksf6UudRh65TVet0M5mj8Rq5bu9I3v4FP6brq'))
            {
                $_SESSION['id'] = 1;  
            }
        }
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

    public function Inscription()
    {
        $error = null;
        if (!empty($_POST)) { // si l'utilisateur a posté le formulaire
            $validation = true;
            if (empty($_POST['mail']) || empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['confirmedPassword'])) {
                $validation = false;
                $error = 1; // présence d'un champ vide
            }
            if (strlen($_POST['mail']) > 255 || strlen($_POST['pseudo']) > 100 || strlen($_POST['password']) > 100) {
                $validation = false;
                $error = 2; // valeur erronée d'un champ
            }
            if (($_POST['password'] !== $_POST['confirmedPassword'])) {
                $validation = false;
                $error = 3; // mauvaise confirmation de mpd
            }
            if (!(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))) //afin de vérifier que l'email soit conforme {
                $validation = false;
                $error = 4; // mail non conforme
            }
            if ($validation) {
                // avant d'enregister les identifiants sur la base de données, il faut vérifier s'il n'existe pas un pseudo semblable
                $userManager = new UserManager;
                // si la recherche ne ramène aucun résultat, alors le pseudo est libre
                if (empty($userManager->exists($_POST['pseudo']))) {
                    // hachage du mot de passe saisi
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // création de l'objet Utilisateur
                    $user = new User([
                        'pseudo' => $_POST['pseudo'],
                        'pass' => $hashedPassword,
                        'mail' => $_POST['mail']
                    ]);
                    // envoi des valeurs sur la base de données
                    $userManager->add($user);
                    // redirection vers la page de connexion
                    header('Location: index.php?action=login');
                } else {
                    $error = 5; // pseudo déjà pris
                }
            }
        
        switch ($error) {
            case 1:
                $error = '<p class="text-center text-danger">Une ou plusieurs cases n\'ont pas été remplies</p>';
                break;
            case 2:
                $error = '<p class="text-center text-danger">Valeur(s) incorrecte(s)</p>';
                break;
            case 3:
                $error = '<p class="text-center text-danger">Mauvaise confirmation de mot de passe</p>';
                break;
            case 4:
                $error = '<p class="text-center text-danger">Adresse mail incorrecte</p>';
                break;
            case 5:
                $error = '<p class="text-center text-danger">Pseudo déjà pris !</p>';
                break;
        }
        require('view/frontend/inscription.php');
    }

    public function Login() {

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