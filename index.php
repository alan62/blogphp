<?php
error_reporting(E_ALL); // rapporte toutes les erreurs php
ini_set("display_errors", 1);

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
include('router/Router.php');