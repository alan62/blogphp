<?php
$title = 'Page introuvable';
$metaDescription = "La page que vous souhaitez voir n'existe pas.";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/index.php?action=error';
$ogTitle = 'Page introuvable | Le site officiel de Jean Forteroche';
$ogDescription = "La page que vous souhaitez voir n'existe pas.";
ob_start();
?>

<header id="error-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Oups ! Impossible de trouver cette page</h1>
            </div>
            <div class="col-lg-8 offset-lg-2 text-center text-error mb-5">
                <p id="text-form" class="text-center text-white">Désolé, la page que vous souhaitez voir n'existe pas.<br />
                    Peut-être que vous trouverez ce que vous cherchez sur la <a href="index.php?action=home" title="Revenir à l'accueil">page d'Accueil</a>.
                </p>
            </div>
        </div>
    </div>
</header>

<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require 'Template.php';
?>