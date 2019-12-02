<?php
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
$frontend = new frontend();
$backend = new backend();
// conditons puis lancement de la méthode du controller choisi
if (isset($_GET['action']))
{
    // exécute toutes les autres pages
    // FRONTEND
    if ($_GET['action'] == 'home')
    {
        $frontend->home();
    }
    elseif ($_GET['action'] == 'biographie')
    {
        $frontend->biographie();
    }
    elseif ($_GET['action'] == 'billetSimple')
    {
        $frontend->billetSimple();
    }
    elseif ($_GET['action'] == 'contact')
    {
        $frontend->contact();
    }
    elseif ($_GET['action'] == 'login')
    {
        $frontend->login();
    }
    elseif ($_GET['action'] == 'view')
    {
        $frontend->view();
    }
    // BACKEND
    elseif ($_GET['action'] == 'admin')
    {
        $backend->admin();
    }
    elseif ($_GET['action'] == 'newArticle')
    {
        $backend->newArticle();
    }
    elseif ($_GET['action'] == 'updateArticle')
    {
        $backend->updateArticle();
    }
    // page error 404
    else {
        $frontend->error();
    }
}
else
{
    // pas d'action, on exécute la page d'accueil
    $frontend->home();
}