<?php
/* variables à remplir */
$title = 'Accueil';
$metaDescription = "Bienvenue sur le site web de Jean Forteroche, écrivain. Découvrez son nouveau roman \"Billet simple pour l'Alaska\", publié en ligne.";
$ogUrl = 'https://alanbeaucheron.ovh/projet4/';
/* No more 65 words */
$ogTitle = 'Bienvenue sur le site web de Jean Forteroche';
/* 150-200 words */
$ogDescription = "Découvrez en ligne les chapitres du nouveau roman de Jean Forteroche, \"Billet simple pour l'Alaska\".";
/* début de la variable $content */
ob_start();
?>

<header id="home-header">
    <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
      <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
      <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
    </div>
  </div>
</header>

<section id="home-project-alaska">
    <div class="row mb-2">
    <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0">Chapitres en ligne</h3>
            <p class="card-text mb-auto">Chaque chapitre sera publié en ligne .</p>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="/public/images/roman-en-ligne.jpg">
        </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0">Intéraction</h3>
            <p class="mb-auto">Vous aurez la possibilité de commenter chaque chapitre pour donner votre point de vue sur le déroulement de l'histoire, des personnages...</p>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="/public/images/roman-interactif.jpg">       
            </div>
        </div>
    </div>
  </div>
</section>



<?php
$content = ob_get_clean(); // fin du contenu de la variable $content
// appel du template
require('frontend.php');
?>