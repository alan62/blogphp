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

    public function biographie() {
        require ('view/frontend/Biographie.php');
    }

    public function error() {
        require ('view/frontend/Error.php');
    }

    public function inscription()
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