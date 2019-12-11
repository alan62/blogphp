<?php

$title = "Billet simple pour l'Alaska";
$metaDescription = "Retrouvez l'ensemble des chapitres du nouveau roman de Jean Forteroche, \"Billet simple pour l'Alaska\".";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/index.php?action=billetSimple';
$ogTitle = "Billet simple pour l'Alaska, le nouveau roman de Jean Forteroche en ligne";
$ogDescription = "Retrouvez l'ensemble des chapitres du nouveau roman de Jean Forteroche, \"Billet simple pour l'Alaska\".";
/* début de la variable $content */
ob_start();
?>

<header id="billet-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 main-title text-center text-white d-inline-block position-relative">Billet simple pour l'Alaska</h1>
                <h2 class="text-center text-white">Les Chapitres</h2>
            </div>
        </div>
    </div>
</header>
<?php
$content = ob_get_clean(); // fin du contenu de la variable $content 
// appel du template
require 'template.php';
?>