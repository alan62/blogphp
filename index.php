<?php
error_reporting(E_ALL); // rapporte toutes les erreurs php
ini_set("display_errors", 1);
// routeur de notre projet
session_start();
// enregistre l'autoload
spl_autoload_register(function ($class)
{
    $files = array('controller/' . $class . '.php', 'model/' . $class . '.php');
    foreach ($files as $file)
    {
        if (file_exists($file))
        {
            require_once $file;
        }
    }
});
// on instancie les controller
$frontend = new Frontend();
$backend = new Backend();
// conditons puis lancement de la méthode du controller choisi
if (isset($_GET['action']))
{
    // exécute toutes les autres pages
    // FRONTEND
    if ($_GET['action'] == 'home')
    {
        $frontend->Home();
    }
    elseif ($_GET['action'] == 'biographie')
    {
        $frontend->Biographie();
    }
    elseif ($_GET['action'] == 'login')
    {
        $frontend->Login();
    }
    elseif ($_GET['action'] == 'view')
    {
        $frontend->View();
    }
    elseif ($_GET['action'] == 'inscription')
    {
        $frontend->Inscription();
    }
    elseif ($_GET['action'] == 'connect')
    {
        $frontend->Connect();
    }
    elseif ($_GET['action'] == 'disconnect')
    {
        $frontend->Disconnect();
    }
    // BACKEND
    elseif ($_GET['action'] == 'admin')
    {
        $backend->Admin();
    }
    elseif ($_GET['action'] == 'newArticle')
    {
        $backend->NewArticle();
    }
    elseif ($_GET['action'] == 'updateArticle')
    {
        $backend->UpdateArticle();
    }

    // page error 404
    else 
    {
        $frontend->Error();
    }
}
else
{
    // pas d'action, on exécute la page d'accueil
    $frontend->Home();
}