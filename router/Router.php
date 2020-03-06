<?php
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